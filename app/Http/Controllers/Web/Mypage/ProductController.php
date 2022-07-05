<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductController\StoreRequest;
use App\Http\Requests\ProductController\DraftRequest;
use App\Libraries\Age;
use App\Models\User;
use App\Models\Product;
use App\Models\JobRequest;
use App\Models\AdditionalOption;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    private $product_service;

    public function __construct(ProductService $product_service)
    {
        $this->product_service = $product_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $products = Product::loginUsers()->notDraft()->orderBy('created_at','desc')->paginate(5);
        $job_requests = JobRequest::loginUsers()->notDraft()->orderBy('created_at','desc')->paginate(5);

        return view('post.post', compact('products','job_requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(Request $request)
    {
        return view('product.create', compact('request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        \DB::transaction(function () use ($request) {
          $product = $this->product_service->storeProduct($request->all());
          $this->product_service->storeAdditionalOption($request->all(), $product->id);
          $this->product_service->storeProductQuestion($request->all(), $product->id);
          $this->product_service->storeImage($request, $product->id);
        });

        return redirect()->route('service_thanks');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show(Product $product)
    {
        $user = User::find($product->user_id);

        $all_products = Product::all();
        if ($product->productUser->userProfile->birthday !== NULL){
            $age = Age::group($product->productUser->userProfile->birthday);
        } else {
            $age = '不明';
        }
        $additional_options = $product->additionalOptions->where('is_public',AdditionalOption::STATUS_PUBLISH);
        return view('product.show', compact('user','product', 'age', 'all_products','additional_options'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     *
     *@return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreRequest $request
     * @param \App\Models\Product $product
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(StoreRequest $request, Product $product)
    {
        \DB::transaction(function () use ($request, $product) {
            $this->product_service->updateProduct($request->all(), $product);
            $this->product_service->updateAdditionalOption($request->all(), $product);
            $this->product_service->updateProductQuestion($request->all(), $product);
            $this->product_service->updateImage($request,$product->id);
        });

        return redirect()->route('service_thanks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete(); // データ論理削除
        \Session::put('flash_msg','提供商品を削除しました');
        if ($product->is_draft == Product::NOT_DRAFT) {
            return redirect()->route('publication');
        } else {
            return redirect()->route('draft');
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeDraft(DraftRequest $request)
    {
        \DB::transaction(function () use ($request) {
            $product = $this->product_service->storeDraftProduct($request->all());
            $this->product_service->storeAdditionalOption($request->all(), $product->id);
            $this->product_service->storeProductQuestion($request->all(), $product->id);
            $this->product_service->storeImage($request, $product->id);
        });

        return redirect()->route('draft')->with('flash_msg', '下書きに保存しました！');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateDraft(DraftRequest $request, Product $product)
    {
        \DB::transaction(function () use ($request, $product) {
            $product->fill([
                'category_id' => $request->category_id,
                'prefecture_id' => $request->prefecture,
                'title' => $request->title,
                'content' => $request->input('content'),
                'price' => $request->price,
                'is_online' => $request->is_online,
                'number_of_day' => $request->number_of_day,
                'is_call' => $request->is_call,
                'number_of_sale' => $request->number_of_sale,
                'status' => $request->status,
                'is_draft' => Product::IS_DRAFT
            ]);
            $product->save();

            $this->product_service->updateAdditionalOption($request->all(), $product);
            $this->product_service->updateProductQuestion($request->all(), $product);
            $this->product_service->updateImage($request,$product->id);
        });

        return redirect()->route('draft')->with('flash_msg','下書きに保存しました！');
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function preview(StoreRequest $request)
    {
        $user = \Auth::user();
        $age = Age::group($user->userProfile->birthday);

        return view('product.preview',compact('request','user','age'));
    }

    public function postCreate(Request $request)
    {
        $user = \Auth::user();
        $age = Age::group($user->userProfile->birthday);

        return view('product.create',compact('request','user','age'));
    }

    public function postEdit(Request $request)
    {
        $user = \Auth::user();
        $age = Age::group($user->userProfile->birthday);
        $product = $request;
        return view('product.edit', compact('product','user','age'));
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editPreview(StoreRequest $request, Product $product)
    {
        $user = \Auth::user();
        $age = Age::group($user->userProfile->birthday);

        return view('product.update_preview',compact('request','user','age', 'product'));
    }

    /**
     * プレビュー画面から投稿
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePreview(Request $request)
    {
        \DB::transaction(function () use ($request) {
            $product = $this->product_service->storeProduct($request->all());
            $this->product_service->storeAdditionalOption($request->all(), $product->id);
            $this->product_service->storeProductQuestion($request->all(), $product->id);
            $this->product_service->storeImage($request, $product->id);
        });

        return redirect()->route('service_thanks');
    }

    /**
     * プレビュー画面から投稿
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePreview(StoreRequest $request, Product $product)
    {
        // バリデーション通れば通常通り登録
        \DB::transaction(function () use ($request, $product) {
            $this->product_service->updateProduct($request->all(), $product);
            $this->product_service->updateAdditionalOption($request->all(), $product);
            $this->product_service->updateProductQuestion($request->all(), $product);
            $this->product_service->updateImage($request,$product->id);
        });

        return redirect()->route('service_thanks');
    }
}
