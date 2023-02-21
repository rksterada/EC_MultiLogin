<x-tests.app>
    <x-slot name="header">
        header1
    </x-slot>

    <!-- 属性でデータの受け渡し -->
    <!-- 変数でデータの受け渡し :message -->
    <x-tests.card title="タイトル" content="本文" :message="$message" />

    <!-- 属性や変数の設定している値が少ない場合 -->
    <x-tests.card title="タイトル2" />


    <x-tests.card title="CSSの変更" class="bg-red-300" />

</x-tests.app>
