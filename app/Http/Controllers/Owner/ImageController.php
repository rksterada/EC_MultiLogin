<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UploadImageRequest;
use App\Services\ImageService;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    // コントローラー側でも認証判定を行う
    public function __construct()
    {
        $this->middleware('auth:owners');

        // editで他のオーナー情報を閲覧できないようにする処理
        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('image');

            if (!is_null($id)) {
                $imagesOwnerId = Image::findOrFail($id)->owner->id;

                $imageId = (int)$imagesOwnerId;
                $ownerId = Auth::id();

                if ($imageId !== $ownerId) {
                    abort(404);
                }
            }
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::Where('owner_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->paginate(16);

        return view('owner.images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('owner.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadImageRequest $request)
    {
        //
        $imageFiles = $request->file('files');
        if (!is_null($imageFiles)) {
            foreach ($imageFiles as $imageFile) {
                $fileNameStore = ImageService::upload($imageFile, 'products');
                Image::create([
                    'owner_id' => Auth::id(),
                    'filename' => $fileNameStore,
                    'title' => $request->title,
                ]);
            }
        }

        return redirect()
            ->route('owner.images.index')
            ->with([
                'message' => '画像を登録しました。',
                'status' => 'info'
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $image = Image::findOrFail($id);
        return view('owner.images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UploadImageRequest $request, $id)
    {
        //
        $request->validate([
            'title' => 'string|max:50',
        ]);

        $imageFile = $request->imageFile;
        if (!is_null($imageFile) && $imageFile->isValid()) {
            // 更新時、前の画像を削除
            $image = Image::findOrFail($id);
            $filePath = 'public/products/' . $image->filename;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            $fileNameStore = ImageService::upload($imageFile, 'products');
        }

        $image = Image::findOrFail($id);
        $image->title = $request->title;
        if (!is_null($imageFile) && $imageFile->isValid()) {
            $image->filename = $fileNameStore;
        }
        $image->save();

        return redirect()
            ->route('owner.images.index')
            ->with([
                'message' => '画像情報を更新しました。',
                'status' => 'info'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ストレージも削除
        $image = Image::findOrFail($id);

        $imageInProducts = Product::where('image1', $image->id)
            ->orWhere('image2', $image->id)
            ->orWhere('image3', $image->id)
            ->orWhere('image4', $image->id)
            ->get();

        if ($imageInProducts) {
            $imageInProducts->each(function ($product) use ($image) {
                if ($product->image1 === $image->id) {
                    $product->image1 = null;
                    $product->save();
                }
                if ($product->image2 === $image->id) {
                    $product->image2 = null;
                    $product->save();
                }
                if ($product->image3 === $image->id) {
                    $product->image3 = null;
                    $product->save();
                }
                if ($product->image4 === $image->id) {
                    $product->image4 = null;
                    $product->save();
                }
            });
        }

        $filePath = 'public/products/' . $image->filename;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        Image::findOrFail($id)->delete();

        return redirect()
            ->route('owner.images.index')
            ->with([
                'message' => '画像を削除しました。',
                'status' => 'alert'
            ]);
    }
}
