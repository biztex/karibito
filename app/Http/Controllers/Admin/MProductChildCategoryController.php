<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChildCategory\StoreRequest;
use App\Http\Requests\Admin\ChildCategory\UpdateRequest;
use App\Models\MProductChildCategory;
use App\Services\AdminMProductChildCategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class MProductChildCategoryController extends Controller
{
    private $child_category_service;

    public function __construct(AdminMProductChildCategoryService $child_category_service)
    {
        $this->child_category_service = $child_category_service;
    }

    /**
     * カテゴリ一覧取得
     *
     * @return View
     */
    public function index(): View
    {
        $child_categories = $this->child_category_service->getMProductChildCategory();
        return view('admin.child_category.index', compact('child_categories'));
    }

    /**
     * カテゴリ登録画面表示
     *
     * @return View
     */
    public function create(): View
    {
        $categories = $this->child_category_service->getMProductCategory();
        return view('admin.child_category.create', compact('categories'));
    }

    /**
     * カテゴリ登録
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->child_category_service->createMProductChildCategory($request);
        return redirect()->route('admin.child_categories.index')->with('flash_msg', 'カテゴリを登録しました');
    }

    /**
     * カテゴリー編集画面表示
     *
     * @param MProductChildCategory $child_category
     * @return View
     */
    public function edit(MProductChildCategory $child_category): View
    {
        $categories = $this->child_category_service->getMProductCategory();
        return view('admin.child_category.edit', compact('categories', 'child_category'));
    }

    /**
     * カテゴリー更新
     *
     * @param UpdateRequest $request
     * @param MProductChildCategory $category
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, MProductChildCategory $child_category): RedirectResponse
    {
        $this->child_category_service->updateMProductChildCategory($request, $child_category);
        return redirect()->route('admin.child_categories.index')->with('flash_msg', 'カテゴリを編集しました');
    }

    /**
     * カテゴリー削除
     *
     * @param MProductChildCategory $category
     * @return RedirectResponse
     */
    public function destroy(MProductChildCategory $child_category): RedirectResponse
    {
        $this->child_category_service->destroyMProductChildCategory($child_category);
        return redirect()->route('admin.child_categories.index')->with('flash_msg', 'カテゴリを削除しました');
    }

    /**
     * カテゴリー検索
     */
    public function search(Request $request)
    {
        $child_categories = $this->child_category_service->search($request);

        return  view('admin.child_category.index', compact('child_categories', 'request'));
    }
}
