<x-app-layout>
    <x-slot name="header">
        <form method="get" action="{{ route('user.items.index') }}">
            <div class="lg:flex lg:justify-between">
                <div class="lg:flex items-center">
                    <select name="category" class="rounded border appearance-none border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-500 text-base">
                        <option value="0" @if(\Request::get('category')==='0' ) selected @endif>全て</option>
                        @foreach($categories as $category)
                        <optgroup label="{{ $category->name }}">
                            @foreach($category->secondary as $secondary)
                            <option value="{{ $secondary->id}}" @if(\Request::get('category')==$secondary->id) selected @endif>
                                {{ $secondary->name }}
                            </option>
                            @endforeach
                            @endforeach
                    </select>
                    <div class="flex my-3 md:my-0">
                        <div class="mx-5">
                            <input name="keyword" placeholder="キーワードを入力" class="bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                        <div>
                            <button class="text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded">検索</button>
                        </div>
                    </div>
                </div>
                <div class="flex">
                    <select name="sort" id="sort" class="rounded border appearance-none border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-200 focus:border-blue-500 text-base">
                        <option value="{{ \Constant::SORT_ORDER['recommend'] }}" @if(\Request::get('sort')===\Constant::SORT_ORDER['recommend'] ) selected @endif>
                            おすすめ順
                        </option>
                        <option value="{{ \Constant::SORT_ORDER['higherPrice'] }}" @if(\Request::get('sort')===\Constant::SORT_ORDER['higherPrice'] ) selected @endif>
                            高価格順
                        </option>
                        <option value="{{ \Constant::SORT_ORDER['lowerPrice'] }}" @if(\Request::get('sort')===\Constant::SORT_ORDER['lowerPrice'] ) selected @endif>
                            低価格順
                        </option>
                        <option value="{{ \Constant::SORT_ORDER['later'] }}" @if(\Request::get('sort')===\Constant::SORT_ORDER['later'] ) selected @endif>
                            新規順
                        </option>
                        <option value="{{ \Constant::SORT_ORDER['older'] }}" @if(\Request::get('sort')===\Constant::SORT_ORDER['older'] ) selected @endif>
                            古い順
                        </option>
                    </select>
                </div>
            </div>
        </form>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-5 mx-auto">
                            <div class="flex flex-wrap -m-4">
                                @foreach($products as $product)
                                <div class="lg:w-1/4 md:w-1/2 p-4 w-full">
                                    <a href="{{ route('user.items.show', ['item' => $product->id ]) }}">
                                        <div class="bg-gray-100 p-6 rounded-lg">
                                            <div class="block relative rounded overflow-hidden">
                                                <x-sumbnail filename="{{ $product->filename ?? '' }}" type="products" />
                                            </div>
                                            <div class="mt-4">
                                                <h3 class="text-gray-500 text-xs tracking-widest title-font mb-1">{{ $product->category }}</h3>
                                                <h2 class="text-gray-900 title-font text-lg font-medium">{{ $product->name }}</h2>
                                                <p class="mt-2">
                                                    {{ number_format($product->price) }}
                                                    <span class="text-sm text-gray-700">円（税込）</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>

    <script>
        const select = document.getElementById('sort')
        select.addEventListener('change', function() {
            this.form.submit()
        })
    </script>
</x-app-layout>
