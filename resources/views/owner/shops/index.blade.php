<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            店舗一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- フラッシュメッセージ -->
                    <x-flash-message status=session('status') />

                    @foreach($shops as $shop)
                    <a href="{{ route('owner.shops.edit', ['shop' => $shop->id ]) }}">
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 md:px-0 py-10 md:py-0 mx-auto flex flex-wrap border-2 border-gray-200 justify-end">
                                <div class="flex flex-wrap -mx-4 mt-auto mb-auto lg:w-1/2 sm:w-2/3 content-start sm:pr-10">
                                    <div class="w-full sm:p-4 px-4 mb-6">
                                        <h1 class="title-font font-medium text-xl mb-2 text-gray-900">{{ $shop->name }}</h1>
                                        <div class="leading-relaxed">{{ $shop->information }}</div>
                                    </div>
                                    <div class="p-4 sm:w-1/2 lg:w-1/4 w-1/2 flex items-center">
                                        <div>
                                            @if($shop->is_selling)
                                            <span class="border p-2 rounded-md bg-blue-400 text-white">販売中</span>
                                            @else
                                            <span class="border p-2 rounded-md bg-red-400 text-white">停止中</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="p-4 sm:w-1/2 lg:w-1/4 w-1/2">
                                        <h2 class="title-font font-medium text-3xl text-gray-900">1.8K</h2>
                                        <p class="leading-relaxed">Users</p>
                                    </div>
                                    <div class="p-4 sm:w-1/2 lg:w-1/4 w-1/2">
                                        <h2 class="title-font font-medium text-3xl text-gray-900">35</h2>
                                        <p class="leading-relaxed">Images</p>
                                    </div>
                                    <div class="p-4 sm:w-1/2 lg:w-1/4 w-1/2">
                                        <h2 class="title-font font-medium text-3xl text-gray-900">4</h2>
                                        <p class="leading-relaxed">Products</p>
                                    </div>
                                </div>
                                <div class="lg:w-1/2 sm:w-1/3 w-full rounded-lg overflow-hidden mt-6 sm:mt-0">
                                    <x-sumbnail :filename="$shop->filename" type="shops" />
                                </div>
                            </div>
                        </section>
                    </a>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
