<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            画像更新
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <section class="text-gray-600 body-font relative">
                        <div class="container px-5 mx-auto">

                            <div class="lg:w-1/2 md:w-2/3 mx-auto">

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                <form id="delete_{{$image->id}}" method="post" action="{{ route('owner.images.destroy', ['image' => $image->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <div class="flex justify-end">
                                        <a href="#" data-id="{{ $image->id }}" onclick=deletePost(this) class="text-white bg-red-400 border-0 py-2 px-6  focus:outline-none hover:bg-red-500 rounded">
                                            削除
                                        </a>
                                    </div>
                                </form>

                                <form method="post" action="{{ route('owner.images.update', ['image' => $image->id ]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="-m-2">

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="title" class="leading-7 text-sm text-gray-600">タイトル</label>
                                                <input type="text" id="title" name="title" value="{{ $image->title }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-1/2 mx-auto">
                                            <div class=" relative">
                                                <x-sumbnail :filename="$image->filename" type="products" />
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="image" class="leading-7 text-sm text-gray-600">画像</label>
                                                <input type="file" id="image" name="imageFile" accept=“image/png,image/jpeg,image/jpg” class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="flex justify-around w-full p-2 mt-4">
                                            <button class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">更新</button>
                                            <button type="button" onclick=location.href="{{ route('owner.images.index')}}" class="text-white bg-gray-400 border-0 py-2 px-8 focus:outline-none hover:bg-gray-500 rounded text-lg">戻る</button>
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
        function deletePost(e) {
            'use strict';
            if (confirm('本当に削除してもいいですか?')) {
                document.getElementById('delete_' + e.dataset.id).submit();
            }
        }
    </script>

</x-app-layout>
