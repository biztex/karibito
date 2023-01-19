<?php

namespace App\Services;

use App\Models\BlogImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogImageService
{
    /**
     * 画像登録
     * 
     * @param Request $request
     * @return string
     */
    public function uploadImage(Request $request): string
    {
        // 画像のアップロード
        $uploadFile = $request->file;
        $name = $uploadFile->getClientOriginalName();
        $path = Storage::putFile('public/blog_images', $uploadFile, 'public');
        $url = Storage::url($path);

        // DBへ画像情報保存
        DB::transaction(function () use ($name, $path, $url) {
            BlogImage::create([
                'name' => $name,
                'path' => $path,
                'url' => $url,
            ]);
        });

        return $url;
    }
}
