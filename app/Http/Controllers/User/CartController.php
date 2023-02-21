<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\User;
use App\Models\Stock;
use App\Services\CartService;
use App\Jobs\SendThanksMail;
use App\Jobs\SendOrderedMail;

class CartController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        // user_idと相対関係にある商品取得(中間テーブルを通して)
        $products = $user->products;
        $totalPrice = 0;

        foreach ($products as $product) {
            $totalPrice += $product->price * $product->pivot->quantity;
        }

        return view('user.cart', compact('products', 'totalPrice'));
    }

    public function add(Request $request)
    {
        //カートに商品があるか確認
        $itemInCart = Cart::where('product_id', $request->product_id)
            ->where('user_id', Auth::id())->first();

        if ($itemInCart) {
            $itemInCart->quantity += $request->quantity;
            $itemInCart->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return redirect()
            ->route('user.cart.index');
    }

    public function delete($id)
    {
        Cart::where('product_id', $id)
            ->where('user_id', Auth::id())->delete();

        return redirect()
            ->route('user.cart.index');
    }

    // 決済処理
    public function checkout()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;

        $lineItems = [];
        // 商品情報の取得(パラメータはStripe規定のもの、ドキュメント参照)
        foreach ($products as $product) {
            // 購入時の在庫確認と商品情報の取得
            $quantity = '';
            $quantity = Stock::where('product_id', $product->id)->sum('quantity');
            if ($product->pivot->quantity > $quantity) {
                return redirect()->route('user.cart.index');
            } else {
                $lineItem = [
                    'price_data' => [
                        'unit_amount' => $product->price,
                        'currency' => 'JPY',
                        'product_data' => [
                            'name' => $product->name,
                            'description' => $product->information,
                        ]
                    ],
                    'quantity' => $product->pivot->quantity,
                ];
                array_push($lineItems, $lineItem);
            }
        }

        // 在庫を減らす
        foreach ($products as $product) {
            Stock::create([
                'product_id' => $product->id,
                'type' => \Constant::PRODUCT_LIST['reduce'],
                'quantity' => $product->pivot->quantity * -1,
            ]);
        }

        // Stripe docs参照
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('user.cart.success'),
            'cancel_url' => route('user.cart.cancel'),
        ]);
        $publicKey = env('STRIPE_PUBLIC_KEY');

        return view('user.checkout', compact('session', 'publicKey'));
    }

    // カート内削除
    public function success()
    {
        /// メール送信
        $items = Cart::where('user_id', Auth::id())->get();
        $products = CartService::getItemsInCart($items);
        $user = User::findOrFail(Auth::id());

        // 同期的にメール送信
        // Mail::to('test@example.com') //受信者の指定 
        // ->send(new TestMail()); //Mailableクラス

        // 非同期にメール送信
        // php artisan queue:workで起爆が必要

        //ユーザー用
        SendThanksMail::dispatch($products, $user);
        // オーナー用
        foreach ($products as $product) {
            SendOrderedMail::dispatch($product, $user);
        }
        ///

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('user.items.index');
    }

    // 決済キャンセル時の在庫処理
    public function cancel()
    {
        $user = User::findOrFail(Auth::id());

        foreach ($user->products as $product) {
            Stock::create([
                'product_id' => $product->id,
                'type' => \Constant::PRODUCT_LIST['add'],
                'quantity' => $product->pivot->quantity,
            ]);
        }
        return redirect()->route('user.cart.index');
    }
}
