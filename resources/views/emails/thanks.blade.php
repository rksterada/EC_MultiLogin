<p class="mb-4">{{ $user->name }}様</p>

<p class="mb-4">ご注文ありがとうございました。</p>

ご注文内容
@foreach($products as $product)
<ul>
    <li>商品名:{{ $product['name'] }}</li>
    <li>商品額:{{  number_format($product['price']) }}円</li>
    <li>商品数:{{  $product['quantity'] }}</li>
    <li>合計金額:{{  number_format($product['price'] * $product['quantity']) }}円</li>
</ul>
@endforeach
