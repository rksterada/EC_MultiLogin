<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            商品更新
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- フラッシュメッセージ -->
                    <x-flash-message status=session('status') />

                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                <form id="delete_{{$product->id}}" method="post" action="{{ route('owner.products.destroy', ['product' => $product->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <div class="flex justify-end">
                                        <a href="#" data-id="{{ $product->id }}" onclick=deletePost(this) class="text-white bg-red-400 border-0 py-2 px-6  focus:outline-none hover:bg-red-500 rounded">
                                            削除
                                        </a>
                                    </div>
                                </form>

                                <form method="post" action="{{ route('owner.products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="-m-2">
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="name" class="leading-7 text-sm text-gray-600">商品名 ※必須</label>
                                                <input type="text" id="name" name="name" value="{{ $product->name }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="information" class="leading-7 text-sm text-gray-600">商品情報 ※必須</label>
                                                <textarea id="information" name="information" rows="10" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $product->information }}</textarea>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="price" class="leading-7 text-sm text-gray-600">価格 ※必須</label>
                                                <input type="number" id="price" name="price" value="{{ $product->price }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="current_quantity" class="leading-7 text-sm text-gray-600">在庫</label>
                                                <input type="hidden" id="current_quantity" name="current_quantity" value="{{ $quantity }}" required>
                                                <div class="w-full bg-gray-100 bg-opacity-50 rounded text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    {{ $quantity }}
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="quantity" class="leading-7 text-sm text-gray-600">在庫の追加 (0〜99の範囲で入力してください)</label>
                                                <input type="number" id="quantity" name="quantity" value="0" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative flex justify-center">
                                                <div class="mx-5 md:mx-10">
                                                    <input type="radio" id="add" name="type" value="{{ \Constant::PRODUCT_LIST['add'] }}" class="mr-2" checked>
                                                    <label for="add">追加</label>
                                                </div>
                                                <div class="mx-5 md:mx-10">
                                                    <input type="radio" id="reduce" name="type" value="{{ \Constant::PRODUCT_LIST['reduce'] }}" class="mr-2">
                                                    <label for="reduce">削減</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="sort_order" class="leading-7 text-sm text-gray-600">表示順</label>
                                                <input type="number" id="sort_order" name="sort_order" value="{{ $product->sort_order }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="shop_id" class="leading-7 text-sm text-gray-600">販売する店舗</label>
                                                <select id="shop_id" name="shop_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @foreach($shops as $shop)
                                                    <option value="{{ $shop->id }}" @if($shop->id === $product->shop_id) selected @endif>{{ $shop->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="category" class="leading-7 text-sm text-gray-600">カテゴリー</label>
                                                <select id="category" name="category" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @foreach($categories as $category)
                                                    <optgroup label="{{ $category->name }}">
                                                        @foreach($category->secondary as $secondary)
                                                        <option value="{{ $secondary->id}}" @if($secondary->id === $product->secondary_category_id) selected @endif>
                                                            {{ $secondary->name }}
                                                        </option>
                                                        @endforeach
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="p-2 w-full my-5">
                                            <div class="relative">
                                                <label class="leading-7 text-sm text-gray-600">添付画像</label>
                                                <div class="flex flex-wrap">
                                                    <x-select-image :images="$images" name="image1" currentId="{{$product->image1}}" currentImage="{{$product->imageFirst->filename ?? ''}}" />
                                                    <x-select-image :images="$images" name="image2" currentId="{{$product->image2}}" currentImage="{{$product->imageSecond->filename ?? ''}}" />
                                                    <x-select-image :images="$images" name="image3" currentId="{{$product->image3}}" currentImage="{{$product->imageThird->filename ?? ''}}" />
                                                    <x-select-image :images="$images" name="image4" currentId="{{$product->image4}}" currentImage="{{$product->imageFourth->filename ?? ''}}" />
                                                </div>

                                            </div>
                                        </div>

                                        <div class="p-2 w-full my-5">
                                            <div class="relative flex justify-center">
                                                <div class="mx-5 md:mx-10">
                                                    <input type="radio" id="sell" name="is_selling" value="1" class="mr-2" @if($product->is_selling === 1){ checked } @endif>
                                                    <label for="sell">販売中</label>
                                                </div>
                                                <div class="mx-5 md:mx-10">
                                                    <input type="radio" id="stop" name="is_selling" value="0" class="mr-2" @if($product->is_selling === 0){ checked } @endif>
                                                    <label for="stop">停止中</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="flex justify-around w-full p-2 mt-4">
                                            <button class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">更新</button>
                                            <button type="button" onclick=location.href="{{ route('owner.products.index')}}" class="text-white bg-gray-400 border-0 py-2 px-8 focus:outline-none hover:bg-gray-500 rounded text-lg">戻る</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <script>
        'use strict'
        const images = document.querySelectorAll('.image') //全てのimageタグを取得 
        images.forEach(image => { // 1つずつ繰り返す
            image.addEventListener('click', function(e) { // クリックしたら
                const imageName = e.target.dataset.id.substr(0, 6) //data-idの6文字
                const imageId = e.target.dataset.id.replace(imageName + '_', '') // 6文字カット 
                const imageFile = e.target.dataset.file
                const imagePath = e.target.dataset.path
                const modal = e.target.dataset.modal
                // サムネイルと input type=hiddenのvalueに設定
                document.getElementById(imageName + '_thumbnail').src = imagePath + '/' + imageFile
                document.getElementById(imageName + '_hidden').value = imageId
                MicroModal.close(modal); //モーダルを閉じる
            })
        })

        function deletePost(e) {
            'use strict';
            if (confirm('本当に削除してもいいですか?')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>
</x-app-layout>
