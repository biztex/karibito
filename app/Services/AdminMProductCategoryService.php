<?php

namespace App\Services;

use App\Models\MProductCategory;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminMProductCategoryService
{
    /**
     * カテゴリの取得
     * 
     * @return Paginator
     */
    public function getMProductCategory(): Paginator
    {
        return MProductCategory::paginate(50);
    }

    /**
     * カテゴリの取得
     * 
     * @param Request $request
     * @return void
     */
    public function createMProductCategory(Request $request)
    {
        DB::transaction(function () use ($request) {
            // 画像取得
            $banner_image = $request->file('banner_image_path');
            $top_image = $request->file('top_image_path');
            $other_image = $request->file('other_image_path');
            // 画像アップロード・ファイルパス取得
            $banner_image_path = empty($banner_image) ? $banner_image : Storage::putFile('public/banner_image_path', $banner_image, 'public');
            $top_image_path = empty($top_image) ? $top_image : Storage::putFile('public/top_image_path', $top_image, 'public');
            $other_image_path = empty($other_image) ? $other_image : Storage::putFile('public/other_image_path', $other_image, 'public');
            MProductCategory::create([
                'name' => $request->input('name'),
                'content' => $request->input('content'),
                'banner_image_path' => $banner_image_path,
                'top_image_path' => $top_image_path,
                'other_image_path' => $other_image_path,
            ]);
        });
    }

    /**
     * カテゴリの更新
     *
     * @param Request $request
     * @param MProductCategory $category
     * @return void
     */
    public static function updateMProductCategory(Request $request, MProductCategory $category)
    {
        DB::transaction(function () use ($request, $category) {
            // 画像取得
            $banner_image = $request->file('banner_image_path');
            $top_image = $request->file('top_image_path');
            $other_image = $request->file('other_image_path');
            // 画像アップロード・ファイルパス取得
            $banner_image_path = empty($banner_image) ? $banner_image : Storage::putFile('public/banner_image_path', $banner_image, 'public');
            $top_image_path = empty($top_image) ? $top_image : Storage::putFile('public/top_image_path', $top_image, 'public');
            $other_image_path = empty($other_image) ? $other_image : Storage::putFile('public/other_image_path', $other_image, 'public');
            $category->fill([
                'name' => $request->input('name'),
                'content' => $request->input('content'),
                'banner_image_path' => $banner_image_path,
                'top_image_path' => $top_image_path,
                'other_image_path' => $other_image_path,
            ])->save();
        });
    }

    /**
     * カテゴリの削除
     *
     * @param MProductCategory $category
     * @return void
     */
    public static function destroyMProductCategory(MProductCategory $category)
    {
        DB::transaction(function () use ($category) {
            $category->delete();
        });
    }
}
