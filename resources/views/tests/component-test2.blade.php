<x-tests.app>
    <x-slot name="header">
        header2
    </x-slot>

    <!-- 属性でデータの受け渡し -->
    <x-tests.card title="aaa" content="bbb" />

    <!-- クラス名の指定 -->
    <x-test-class-base classBaseMessage='beseメッセージ' />
    
    <div class="mb-4"></div>

    <!-- ここで値を設定するとclass側で設定した初期値が変更される -->
    <x-test-class-base classBaseMessage='beseメッセージ' defaultMessage='初期値から変更' />
</x-tests.app>
