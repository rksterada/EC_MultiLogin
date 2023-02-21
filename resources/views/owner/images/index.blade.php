<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            画像一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- フラッシュメッセージ -->
                    <x-flash-message status=session('status') />

                    <div class="flex justify-end mr-5">
                        <button onclick=location.href='{{ route('owner.images.create') }}' class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">新規登録</button>
                    </div>
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-5 mx-auto">
                            <div class="flex flex-wrap -m-4">
                                @foreach($images as $image)
                                <div class="xl:w-1/4 md:w-1/2 p-4">
                                    <a href="{{ route('owner.images.edit', ['image' => $image->id ]) }}">
                                        <div class="bg-gray-100 p-6 rounded-lg">
                                            <div class="w-full object-cover object-center">
                                                <x-sumbnail :filename="$image->filename" type="products" />
                                            </div>
                                            <h3 class="tracking-widest text-green-500 text-xs font-medium title-font my-2">TITLE</h3>
                                            <h2 class="text-lg text-gray-900 font-medium title-font">{{ $image->title }}</h2>
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                    <div class="mt-8">
                        {{ $images->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
