<?php

namespace App\Services;

use App\Models\MProductCategory;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            MProductCategory::create($request->substitutable());
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
            $category->fill($request->substitutable())->save();
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
