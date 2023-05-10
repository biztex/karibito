<?php

namespace App\Services;

use App\Models\MProductCategory;
use App\Models\MProductChildCategory;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminMProductChildCategoryService
{
    /**
     * カテゴリの取得
     * 
     * @return Paginator
     */
    public function getMProductChildCategory(): Paginator
    {
        return MProductChildCategory::paginate(50);
    }

    /**
     * 親カテゴリの取得
     * 
     * @return Collection
     */
    public function getMProductCategory(): Collection
    {
        return MProductCategory::all();
    }

    /**
     * カテゴリの登録
     * 
     * @param Request $request
     * @return void
     */
    public function createMProductChildCategory(Request $request)
    {
        DB::transaction(function () use ($request) {
            // 画像取得
            $index_image_path = $request->file('index_image_path');
            // 画像アップロード・ファイルパス取得
            $index_image_path = empty($index_image_path) ? $index_image_path : Storage::putFile('public/index_image_path', $index_image_path, 'public');
            MProductChildCategory::create([
                'parent_category_id' => $request->input('parent_category_id'),
                'name' => $request->input('name'),
                'index_image_path' => $index_image_path
            ]);
        });
    }

    /**
     * カテゴリの更新
     *
     * @param Request $request
     * @param MProductChildCategory $category
     * @return void
     */
    public static function updateMProductChildCategory(Request $request, MProductChildCategory $category)
    {
        DB::transaction(function () use ($request, $category) {
            // 画像取得
            $index_image_path = $request->file('index_image_path');
            // 画像アップロード・ファイルパス取得
            $index_image_path = empty($index_image_path) ? $category->index_image_path : Storage::putFile('public/index_image_path', $index_image_path, 'public');
            $category->fill([
                'parent_category_id' => $request->input('parent_category_id'),
                'name' => $request->input('name'),
                'index_image_path' => $index_image_path
            ])->save();
        });
    }

    /**
     * カテゴリの削除
     *
     * @param MProductChildCategory $category
     * @return void
     */
    public static function destroyMProductChildCategory(MProductChildCategory $category)
    {
        DB::transaction(function () use ($category) {
            $category->delete();
        });
    }

    public function search($request)
    {
        $sql = MProductChildCategory::orderBy('id', 'asc');
        $sql->where('name', 'LIKE', "%$request->search%");

        return $sql->paginate(50)->appends($request->query());
    }
}
