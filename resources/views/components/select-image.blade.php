<?php
if ($name === 'image1') {
    $modal = "modal-1";
}
if ($name === 'image2') {
    $modal = "modal-2";
}
if ($name === 'image3') {
    $modal = "modal-3";
}
if ($name === 'image4') {
    $modal = "modal-4";
}
$cImage = $currentImage ?? '';
$cId = $currentId ?? '';
?>

<div class="modal micromodal-slide" id={{ $modal }} aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="{{ $modal }}-title">
            <header class="modal__header">
                <h2 class="modal__title" id="{{ $modal }}-title">
                    ファイルを選択してください
                </h2>
                <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="{{ $modal }}-content">
                <div class="flex flex-wrap -m-4">
                    @foreach($images as $image)
                    <div class="xl:w-1/4 md:w-1/2 p-4">

                        <div class="bg-gray-100 p-6 rounded-lg">
                            <div class="w-full object-cover object-center">
                                <img class="image" data-id="{{ $name }}_{{ $image->id }}" data-file="{{ $image->filename }}" data-path="{{ asset('storage/products/') }}" data-modal="{{ $modal }}" src="{{ asset('storage/products/' . $image->filename) }}">
                            </div>
                        </div>

                    </div>
                    @endforeach
                </div>
            </main>
            <footer class="modal__footer">
                <button type="button" class="modal__btn" data-micromodal-close aria-label="閉じる">閉じる</button>
            </footer>
        </div>
    </div>
</div>


<div class="w-1/2 md:w-1/4 mb-4">
    <a href="#" data-micromodal-trigger="{{ $modal }}" class="flex w-full bg-gray-300 border-0 md:py-2 md:px-4 focus:outline-none hover:bg-gray-400 rounded mb-2">ファイル選択</a>
    <div>
        <img id="{{ $name }}_thumbnail" @if($cImage) src="{{ asset('storage/products/' . $cImage)}}" @else src="" @endif>
    </div>
</div>
<input id="{{ $name }}_hidden" type="hidden" name="{{ $name }}" value="{{ $cId }}" />
