<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;

class ShopController extends Controller
{
    // コントローラー側でも認証判定を行う
    public function __construct()
    {
        $this->middleware('auth:owners');

        // editで他のオーナー情報を閲覧できないようにする処理
        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('shop'); //shopのid取得

            if (!is_null($id)) { // null判定
                $shopsOwnerId = Shop::findOrFail($id)->owner->id;

                // 文字列→数値に型変換
                $shopId = (int)$shopsOwnerId;
                $ownerId = Auth::id();

                // 同じでなかったら404画面表示
                if ($shopId !== $ownerId) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::where('owner_id', Auth::id())->get();

        return view('owner.shops.index', compact('shops'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shop = Shop::findOrFail($id);

        return view('owner.shops.edit', compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadImageRequest $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'information' => 'required|string|max:1000',
            'is_selling' => 'required',
        ]);

        $imageFile = $request->image; //一時保存 
        if (!is_null($imageFile) && $imageFile->isValid()) {
            // リサイズ無しの場合
            // Storage::putFile('public/shops', $imageFile); 

            // リサイズありの場合
            $fileNameStore = ImageService::upload($imageFile, 'shops');
        }

        $shop = Shop::findOrFail($id);
        $shop->name = $request->name;
        $shop->information = $request->information;
        $shop->is_selling = $request->is_selling;
        if (!is_null($imageFile) && $imageFile->isValid()) {
            $shop->filename = $fileNameStore;
        }
        $shop->save();

        return redirect()
        ->route('owner.shops.index')
        ->with([
            'message' => '店舗情報を更新しました。',
            'status' => 'info'
        ]);
    }
}
