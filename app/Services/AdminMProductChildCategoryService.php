<?php

namespace App\Services;

use App\Models\MProductCategory;
use App\Models\MProductChildCategory;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            MProductChildCategory::create($request->substitutable());
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
            $category->fill($request->substitutable())->save();
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
}
