<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            店舗更新
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

                                <form method="post" action="{{ route('owner.shops.update', ['shop' => $shop->id ]) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="-m-2">
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="name" class="leading-7 text-sm text-gray-600">店舗名 ※必須</label>
                                                <input type="text" id="name" name="name" value="{{ $shop->name }}" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="information" class="leading-7 text-sm text-gray-600">店舗情報 ※必須</label>
                                                <textarea id="information" name="information" rows="10" required class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $shop->information }}</textarea>
                                            </div>
                                        </div>

                                        <div class="p-2 w-1/2 mx-auto">
                                            <div class=" relative">
                                                <x-sumbnail :filename="$shop->filename" type="shops" />
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="image" class="leading-7 text-sm text-gray-600">画像</label>
                                                <input type="file" id="image" name="image" accept=“image/png,image/jpeg,image/jpg” class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            </div>
                                        </div>

                                        <div class="p-2 w-full my-5">
                                            <div class="relative flex justify-center">
                                                <div class="mx-5 md:mx-10"><input type="radio" name="is_selling" value="1" class="mr-2" @if($shop->is_selling === 1){ checked } @endif>販売中</div>
                                                <div class="mx-5 md:mx-10"><input type="radio" name="is_selling" value="0" class="mr-2" @if($shop->is_selling === 0){ checked } @endif>停止中</div>
                                            </div>
                                        </div>

                                        <div class="flex justify-around w-full p-2 mt-4">
                                            <button class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">登録</button>
                                            <button type="button" onclick=location.href="{{ route('owner.shops.index')}}" class="text-white bg-gray-400 border-0 py-2 px-8 focus:outline-none hover:bg-gray-500 rounded text-lg">戻る</button>
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
</x-app-layout>
