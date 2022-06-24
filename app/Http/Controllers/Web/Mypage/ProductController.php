<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
//use App\Http\Requests\JobRequestController\PreviewRequest;
use App\Http\Requests\ProductController\StoreRequest;
use App\Http\Requests\ProductController\DraftRequest;
use App\Http\Requests\ProductController\PreviewRequest;
use App\Libraries\Age;
use App\Models\AdditionalOption;
use App\Models\MProductCategory;
use App\Models\User;
use App\Models\Product;
use App\Models\JobRequest;
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('user_id',\Auth::id())
                            ->where('status',Product::STATUS_PUBLISH)
                            ->where('is_draft',Product::NOT_DRAFT)
                            ->orderBy('updated_at','desc')
                            ->paginate(5);

        $job_requests = JobRequest::where('user_id',\Auth::id())
                                    ->where('status',JobRequest::STATUS_PUBLISH)
                                    ->where('is_draft',JobRequest::NOT_DRAFT)
                                    ->orderBy('updated_at','desc')
                                    ->paginate(5);

        return view('post.post', compact('products','job_requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $user = User::find($product->user_id);

        $all_products = Product::all();
        $birthday = (int)str_replace("-", "", $product->productUser->userProfile->birthday);
        $age = Age::group($birthday);
        return view('product.show', compact('user','product', 'age', 'all_products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
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
     * @param \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        $product->delete(); // データ論理削除
        \Session::put('flash_msg','提供商品を削除しました');

        return redirect()->route('mypage');
    }

    public function storeDraft(DraftRequest $request)
    {
        \DB::transaction(function () use ($request) {
                $product = Product::create([
                'user_id' => \Auth::id(),
                'category_id' => $request->category_id,
                'prefecture_id' => $request->prefecture_id,
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

            for ($i = 0; $i < 3; $i++) {
                if (!is_null($request->option_name[$i])) {
                    $product->additionalOptions()->create([
                        'name' => $request->option_name[$i],
                        'price' => $request->option_price[$i],
                        'is_public' => $request->option_is_public[$i]
                    ]);
                }
            }

            for ($i = 0; $i < 3; $i++) {
                if (!is_null($request->question_title[$i])) {
                    $product->productQuestions()->create([
                        'title' => $request->question_title[$i],
                        'answer' => $request->answer[$i]
                    ]);
                }
            }

            $this->product_service->storeImage($request, $product->id);
        });

        return redirect()->route('draft')->with('flash_msg', '下書きに保存しました！');
    }

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

            $product->additionalOptions()->delete();

            if ($request->option_name) {
                foreach ($request->option_name as $index => $option) {//indexに回した数が入る、0から
                    $product->additionalOptions()->create([
                        'name' => $option,
                        'price' => $request->option_price[$index],
                        'is_public' => $request->option_is_public[$index]
                    ]);
                }
            }

            $product->productQuestions()->delete();

            if ($request->question_title) {
                foreach ($request->question_title as $index =>$title){
                    $product->productQuestions()->create([
                        'title' => $request->question_title[$index],
                        'answer' => $request->answer[$index]
                    ]);
                }
            }

            $product->save();
            $this->product_service->updateImage($request,$product->id);
        });

        return redirect()->route('draft')->with('flash_msg','下書きに保存しました！');
    }


    public function preview(PreviewRequest $request)
    {

        $user = \Auth::user();
        $birthday = (int)str_replace("-","",$user->userProfile->birthday);
        $age = Age::group($birthday);

        return view('product.preview',compact('request','user','age'));
    }

    /**
     * 既存リクエスト、編集からプレビュー表示
     */
    public function editPreview(PreviewRequest $request, Product $product)
    {

        $user = \Auth::user();
        $birthday = (int)str_replace("-","",$user->userProfile->birthday);
        $age = Age::group($birthday);

        return view('product.preview',compact('request','user','age', 'product'));
    }
}
