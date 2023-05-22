<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\MProductCategory;
use App\Services\AdminMProductCategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class MProductCategoryController extends Controller
{
    private $category_service;

    public function __construct(AdminMProductCategoryService $category_service)
    {
        $this->category_service = $category_service;
    }

    /**
     * カテゴリ一覧取得
     *
     * @return View
     */
    public function index(): View
    {
        $categories = $this->category_service->getMProductCategory();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * カテゴリ登録画面表示
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.category.create');
    }

    /**
     * カテゴリ登録
     *
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $this->category_service->createMProductCategory($request);
        return redirect()->route('admin.categories.index')->with('flash_msg', 'カテゴリを登録しました');
    }

    /**
     * カテゴリー編集画面表示
     *
     * @param MProductCategory $category
     * @return View
     */
    public function edit(MProductCategory $category): View
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * カテゴリー更新
     *
     * @param UpdateRequest $request
     * @param MProductCategory $category
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, MProductCategory $category): RedirectResponse
    {
        $this->category_service->updateMProductCategory($request, $category);
        return redirect()->route('admin.categories.index')->with('flash_msg', 'カテゴリを編集しました');
    }

    /**
     * カテゴリー削除
     *
     * @param MProductCategory $category
     * @return RedirectResponse
     */
    public function destroy(MProductCategory $category): RedirectResponse
    {
        $this->category_service->destroyMProductCategory($category);
        return redirect()->route('admin.categories.index')->with('flash_msg', 'カテゴリを削除しました');
    }

    /**
     * カテゴリー検索
     */
    public function search(Request $request)
    {
        $categories = $this->category_service->search($request);

        return  view('admin.category.index', compact('categories', 'request'));
    }
}
