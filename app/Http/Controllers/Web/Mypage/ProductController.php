<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequestController\PreviewRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductController\StoreRequest;
use App\Libraries\Age;
use App\Models\AdditionalOption;
use App\Models\MProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('post.post', compact('products'));
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
            'is_draft' => Product::NOT_DRAFT
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
        return redirect()->route('service_thanks');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show(Product $product)
    {
        $all_products = Product::all();
        $birthday = (int)str_replace("-", "", $product->productUser->userProfile->birthday);
        $age = Age::group($birthday);
        return view('product.show', compact('product', 'age', 'all_products'));
//        return view('product.show', compact('product', 'age', 'all_products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit(Product $product)
    {
        $categories = MProductCategory::all();
        return view('product.edit', compact("product", 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
//        $product = Product::find($id);
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
            'is_draft' => Product::NOT_DRAFT
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
        return redirect()->route('service_thanks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function preview(PreviewRequest $request)
    {
        $user = \Auth::user();

        $birthday = (int)str_replace("-","",$user->userProfile->birthday);
        $age = Age::group($birthday);

        return view('product.preview',compact('request','user','age'));
    }
}
