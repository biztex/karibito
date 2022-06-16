<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductController\ProductRequest;
use App\Http\Requests\ProductController\StoreRequest;
use App\Libraries\Age;
use App\Models\AddtionalOptions;
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
            'category_id' => $request->child_category_id,
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


        for ($i = 0; $i < 3; $i++) {
            if (!is_null($request->option_name[$i])) {
                $product->additionalOption()->create([
                    'price' => $request->option_price[$i],
                    'name' => $request->option_name[$i],
                    'is_public' => $request->option_is_public[$i]
                ]);
            }
        }

        for ($i = 0; $i < 3; $i++) {
            if (!is_null($request->question_title[$i])) {
                $product->productQuestion()->create([
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
        function show($id)
        {
            $product = Product::find($id);
            $all_products = Product::all();
            $birthday = (int)str_replace("-", "", $product->productUser->userProfile->birthday);
            $age = Age::group($birthday);
            return view('product.show', compact('product', 'age', 'all_products'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function edit($id)
        {
            $product = Product::find($id);
            $categories = MProductCategory::all();
            return view('post.service_edit', compact('categories', 'product'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function update(Request $request, $id)
        {
            $product->fill([
                'category_id' => $request->category_id,
                'prefecture_id' => $request->prefecture,
                'title' => $request->title,
                'content' => $request->content,
                'price' => $request->price,
                'is_online' => $request->is_online,
                'number_of_day' => $request->number_of_day,
                'is_call' => $request->is_call,
                'number_of_sale' => $request->number_of_sale,
                'is_draft' => $request->is_draft,
                'status' => $request->status,
            ]);
            return $product->save();
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public
        function destroy($id)
        {
            //
        }
    }
