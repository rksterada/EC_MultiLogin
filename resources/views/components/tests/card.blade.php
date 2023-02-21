<!-- 属性や変数の設定している値が少ない場合に必要 -->
@props([
'title',
'content' => '初期値。',
'message' => '初期値。',
])

<!-- 親と子にCSSを充てるためには -->
<div {{$attributes->merge([
    'class' => 'border-2 shadow-md w-1/4 p-2'
    ])
}}>
    <div>{{ $title }}</div>
    <div>画像</div>
    <div>{{ $content }}</div>
    <div>{{ $message }}</div>
</div>
