<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            カート
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(count($products) > 0)
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-5 mx-auto">
                            <div class="flex flex-wrap -m-4">
                                @foreach($products as $product)
                                <div class="p-4 md:w-1/2">
                                    <div class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left p-2 bg-gray-100 border  border-opacity-60 rounded-lg overflow-hidden">
                                        @if($product->imageFirst->filename !== null)
                                        <img src="{{ asset('storage/products/' . $product->imageFirst->filename )}}" class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4">
                                        @else
                                        <img src="">
                                        @endif
                                        <div class="flex-grow sm:pl-8">
                                            <h2 class="title-font font-medium text-lg text-gray-900">
                                                <span class="text-sm text-gray-700">商品:</span>
                                                {{ $product->name }}
                                            </h2>
                                            <p class="mb-4 title-font font-medium text-lg text-gray-900">
                                                <span class="text-sm text-gray-700">数量:</span>
                                                {{ $product->pivot->quantity}}個
                                            </p>
                                            <h2 class="tracking-widest text-xs title-font font-medium text-gray-700 mb-1">小計</h2>
                                            <p class="mb-4 title-font font-medium text-lg text-gray-900">
                                                {{ number_format($product->pivot->quantity * $product->price )}}
                                                <span class="text-sm text-gray-700">円(税込)</span>
                                            </p>
                                            <span class="inline-flex">
                                                <form method="post" action="{{ route('user.cart.delete', ['item' => $product->id]) }}">
                                                    @csrf
                                                    <button>
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                    <section class="text-gray-600 body-font">
                        <div class="container px-5 py-10 mx-auto">
                            <div class="xl:w-1/2 lg:w-3/4 w-full mx-auto text-center">

                                <span class="inline-block h-1 w-10 rounded bg-blue-500 mt-8 mb-6"></span>
                                <p class="text-gray-500">合計金額</p>
                                <h2 class="text-gray-900 font-medium title-font tracking-wider text-xl md:text-2xl">
                                    {{ number_format($totalPrice) }}
                                    <span class="text-sm text-gray-700">円(税込)</span>
                                </h2>
                            </div>
                        </div>
                    </section>
                    <div class="text-center">
                        <button onclick=location.href='{{ route('user.cart.checkout') }}' class="text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded">
                            購入する
                        </button>
                    </div>
                    @else
                    <p>カートに商品が入っていません</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
