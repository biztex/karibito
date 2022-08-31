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
use App\Models\Chatroom;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\EvaluationService;

class ProductController extends Controller
{
    private $product_service;
    private $evaluation_service;

    public function __construct(ProductService $product_service, EvaluationService $evaluation_service)
    {
        $this->product_service = $product_service;
        $this->evaluation_service = $evaluation_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function post()
    {
        $products = Product::loginUsers()->notDraft()->orderBy('created_at','desc')->paginate(5);
        $job_requests = JobRequest::loginUsers()->notDraft()->orderBy('created_at','desc')->paginate(5);

        return view('post', compact('products','job_requests'));
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
        // バリデーションかかれば入力画面に戻す
        $validator = $request->getValidator();
        if ($validator->fails()) {
            return redirect()->route("product.create")->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request) {
            $product = $this->product_service->storeProduct($request->all());
            $this->product_service->storeAdditionalOption($request->all(), $product->id);
            $this->product_service->storeProductQuestion($request->all(), $product->id);
            $this->product_service->storeProductLink($request->all(), $product->id);
            $this->product_service->storeImage($request, $product->id);
        });

        $product = Product::orderBy('created_at', 'desc')->where('user_id', \Auth::id())->first();
        $url = $this->product_service->getURL($product->id);

        return redirect()->route('product.thanks')->with(['url' => $url, 'product_title' => $product->title, 'name' => $product->user->name]);
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
        $all_products = Product::getUser($product->user_id)->orderBy('created_at', 'desc')->get();

        $additional_options = $product->additionalOption->where('is_public',AdditionalOption::STATUS_PUBLISH);

        $evaluations = $this->evaluation_service->getProductEvaluations($product);

        $evaluation_counts = $this->evaluation_service->countEvaluations($product->user_id);

        // $chatroom_status = Chatroom::where('reference_id', $product->id)->pluck('status')->first();

        $number_of_sold = Chatroom::numberOfSold($product->id);

        return view('product.show', compact('product', 'all_products', 'additional_options', 'evaluations', 'evaluation_counts', /* 'chatroom_status',  */'number_of_sold'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     *
     *@return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit(Request $request, Product $product)
    {
        return view('product.edit', compact('product','request'));
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
       // バリデーションかかれば入力画面に戻す
        $validator = $request->getValidator();
        if ($validator->fails()) {
            return redirect()->route("product.edit", $request->id)->withErrors($validator)->withInput();
        }

        \DB::transaction(function () use ($request, $product) {
            $this->product_service->updateProduct($request->all(), $product);
            $this->product_service->updateAdditionalOption($request->all(), $product);
            $this->product_service->updateProductQuestion($request->all(), $product);
            $this->product_service->updateProductLink($request->all(), $product);
            $this->product_service->updateImage($request,$product->id);
        });

        $product = Product::orderBy('created_at', 'desc')->where('user_id', \Auth::id())->first();
        $url = $this->product_service->getURL($product->id);

        return redirect()->route('product.thanks')->with(['url' => $url, 'product_title' => $product->title, 'name' => $product->user->name]);
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
        // バリデーションかかれば入力画面に戻す
        $validator = $request->getValidator();
        if ($validator->fails()) {
            return redirect()->route("product.create")->withErrors($validator)->withInput();
        }

        $user = \Auth::user();

        return view('product.preview',compact('request','user'));
    }

    public function postCreate(Request $request)
    {
        $user = \Auth::user();

        return view('product.create',compact('request','user'));
    }

    // 編集⇒プレビュー⇒編集
    public function postEdit(Request $request, Product $product)
    {
        $user = \Auth::user();
        $product = $request;
        return view('product.edit', compact('product','user'));
    }

    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function editPreview(StoreRequest $request, Product $product)
    {
        // バリデーションかかれば入力画面に戻す
        $validator = $request->getValidator();
        if ($validator->fails()) {
            return redirect()->route("product.edit", $request->id)->withErrors($validator)->withInput();
        }

        $user = \Auth::user();

        return view('product.update_preview',compact('request','user', 'product'));
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

        $product = Product::orderBy('created_at', 'desc')->where('user_id', \Auth::id())->first();
        $url = $this->product_service->getURL($product->id);

        return redirect()->route('product.thanks')->with(['url' => $url, 'product_title' => $product->title, 'name' => $product->user->name]);
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

        $product = Product::orderBy('created_at', 'desc')->where('user_id', \Auth::id())->first();
        $url = $this->product_service->getURL($product->id);

        return redirect()->route('product.thanks')->with(['url' => $url, 'product_title' => $product->title, 'name' => $product->user->name]);
    }
}
