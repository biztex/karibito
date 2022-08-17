<?php

namespace App\Services;

use App\Models\AdditionalOption;
use App\Models\JobRequest;
use App\Models\MProductChildCategory;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductQuestion;
use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Traits\ProductSearchTrait;


class ProductService
{
    use ProductSearchTrait;

    /**
     * 新規商品投稿
     */
    public function storeProduct(array $params):Product
    {
        $columns = ['category_id', 'prefecture_id', 'title', 'content', 'price', 'is_online', 'number_of_day',  'is_call', 'number_of_sale', 'status'];

        $product = new Product;
        $product->user_id = \Auth::id();
        foreach($columns as $column){
            $product->$column = $params[$column];
        }
        $product->is_draft = Product::NOT_DRAFT;
        $product->save();

        return $product;
    }

    /**
     * 新規有料オプション追加
     */
    public function storeAdditionalOption(array $request, $id)
    {
        if (isset($request['option_name'])) {
            foreach ($request['option_name'] as $index => $value) {
                if (null !== ($request['option_name'][$index])) {
                    $options = [
                        'name' => $request['option_name'][$index],
                        'price' => $request['option_price'][$index],
                        'is_public' => $request['option_is_public'][$index]
                    ];
                    $product = Product::find($id);
                    $product->additionalOption()->create($options);
                }
            }
        }
    }

    /**
     * 新規よくある質問追加
     */
    public function storeProductQuestion(array $request, $id)
    {
        if (isset($request['question_title'])) {
            foreach ($request['question_title'] as $index => $value) {
                if ($request['question_title'][$index]){
                    $questions = [
                        'title' => $request['question_title'][$index],
                        'answer' => $request['answer'][$index],
                    ];
                    $product = Product::find($id);
                    $product->productQuestion()->create($questions);
                }
            }
        }
    }

    /**
     * 新規動画追加
     */
    public function storeProductLink(array $request, $id)
    {
        if (isset($request['youtube_link'])) {
            foreach ($request['youtube_link'] as $index => $value) {
                if ($request['youtube_link'][$index]){
                    $links = [
                        'youtube_link' => $request['youtube_link'][$index],
                    ];
                    $product = Product::find($id);
                    $product->productLink()->create($links);
                }
            }
        }
    }


    /**
     * 商品編集
     */
    public function updateProduct(array $params, $product):Product
    {
        $columns = ['category_id', 'prefecture_id', 'title', 'content', 'price', 'is_online', 'number_of_day',  'is_call', 'number_of_sale', 'status'];

        foreach($columns as $column){
            $product->$column = $params[$column];
        }
        $product->is_draft = Product::NOT_DRAFT;
        $product->save();
        return $product;
    }


    /**
     * 有料オプション編集
     */
    public function updateAdditionalOption(array $request, $product)
    {
        $product->additionalOption()->delete();
        if (isset($request['option_name'])) {
            foreach ($request['option_name'] as $index => $value) {
                if (null !== ($request['option_name'][$index])) {
                    $options = [
                        'name' => $request['option_name'][$index],
                        'price' => $request['option_price'][$index],
                        'is_public' => $request['option_is_public'][$index]
                    ];
                    $product = Product::find($product->id);
                    $product->additionalOption()->create($options);
                }
            }
        }
    }


    /**
     * よくある質問編集
     */
    public function updateProductQuestion(array $request, $product)
    {
        $product->productQuestion()->delete();
        if (isset($request['question_title'])) {
            if ($request['question_title'] !== null) {
                foreach ($request['question_title'] as $index => $value) {
                    if ($request['question_title'][$index]) {
                        $questions = [
                            'title' => $request['question_title'][$index],
                            'answer' => $request['answer'][$index],
                        ];
                        $product = Product::find($product->id);
                        $product->productQuestion()->create($questions);
                    }
                }
            }
        }
    }


    /**
     * よくある質問編集
     */
    public function updateProductLink(array $request, $product)
    {
        $product->productLink()->delete();
        if (isset($request['youtube_link'])) {
            if ($request['youtube_link'] !== null) {
                foreach ($request['youtube_link'] as $index => $value) {
                    if ($request['youtube_link'][$index]) {
                        $links = [
                            'youtube_link' => $request['youtube_link'][$index],
                        ];
                        $product = Product::find($product->id);
                        $product->productLink()->create($links);
                    }
                }
            }
        }
    }


    /**
     * Base64エンコードされたデータをファイルに変換
     */
    public function changeUploadFile($base64)
    {
        $storage = 'public';
        $dir = 'product_paths';

        // 拡張子を取得
        preg_match('/data:image\/(\w+);base64,/', $base64, $matches);
        $extension = $matches[1];

        // base64にエンコードされたデータをデコード
        $img = preg_replace('/^data:image.*base64,/', '', $base64);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);

        // pathを整形
        $dir = rtrim($dir, '/').'/';
        $fileName = md5($img);
        $path = $dir.$fileName.'.'.$extension;

        \Storage::disk($storage)->put($path, $fileData);

        return $path;
    }


    /**
     * 提供画像登登録
     */
    public function storeImage($request, $id)
    {
        // input:fileでわたってきているとき
        if ($request->paths !== null) {
            $paths = $request->paths;
            foreach ($paths as $path) {
                if ($path !== null){
                    $product_image = new ProductImage();
                    $product_image->path = $path->store('product_paths', 'public');
                    $product_image->product_id = $id;
                    $product_image->save();
                }
            }
        } else {
            // input:fileでわたってこないとき
            foreach ($request->base64_text as $path) {
                if ($path !== null){
                    $product_image = new ProductImage();
                    $product_image->path = self::changeUploadFile($path);
                    $product_image->product_id = $id;
                    $product_image->save();
                }
            }
        }
    }


    /**
     * 提供画像編集（画像変更）
     * 編集：登録されているものを一度削除して入れなおす
     */
    public function updateImage($request, $id)
    {
        // 登録済の画像を配列で取得
        $old_images = ProductImage::where('product_id',$id)->get();
        // $image_status = json_decode($request->image_status,true);

        // 追加・変更・削除があれば実行
        // if (isset($image_status)) {
            for($i=0; $i<10; $i++){
                $image_status = $request['image_status'.$i];

                if(isset($image_status) && $image_status === "delete"){
                    // 削除されたら何もしない

                }elseif(isset($image_status) && $image_status === "insert"){
                    // 挿入されたらリクエストをDBに登録
                    if($request->paths !== null && $request['paths'.$i] !== null) {
                        // input:fileでわたってきているとき
                        $product_image = new ProductImage();
                        $product_image->path = $request->paths['paths'.$i]->store('product_paths', 'public');
                        $product_image->product_id = $id;
                        $product_image->save();

                    } else {
                        // input:fileでわたってきてこないとき
                        $product_image = new ProductImage();
                        $product_image->path = self::changeUploadFile($request->base64_text[$i]);
                        $product_image->product_id = $id;
                        $product_image->save();
                    }


                }elseif(isset($old_images[$i])){
                    // 変更なければ元のpathをDBに登録しなおす
                    $new_images[] = $old_images[$i];
                    $product_image = new ProductImage();
                    $product_image->path = $old_images[$i]->path;
                    $product_image->product_id = $id;
                    $product_image->save();
                }
            }

            // 登録済のものをDBからすべて削除
            foreach($old_images as $val){
                $val->delete();
            }
        // }
    }


    /**
     * 新規リクエスト下書き保存
     */
    public function storeDraftProduct(array $params):Product
    {
        $columns = ['category_id', 'prefecture_id', 'title', 'content', 'price', 'is_online', 'number_of_day',  'is_call', 'number_of_sale', 'status'];

        $product = new Product;
        $product->user_id = \Auth::id();
        foreach($columns as $column){
            $product->$column = $params[$column];
        }
        $product->is_draft = Product::IS_DRAFT;
        $product->save();

        return $product;
    }


    /**
     * 未使用
     * 新規有料オプション下書き保存
     */
    public function storeDraftAdditionalOption(array $request, $id)
    {
        for ($i = 0; $i < 3; $i++) {
            if (isset($request['option_name'][$i])) {
                $additional_option = new AdditionalOption;
                $additional_option->create([
                    'name' => $request['option_name'][$i],
                    'price' => $request['option_price'][$i],
                    'is_public' => $request['option_is_public'][$i],
                    'product_id' => $id
                ]);
            }
        }
    }


    /**
     * 未使用
     * 新規よくある質問下書き保存
     */
    public function storeDraftProductQuestion(array $request, $id)
    {
        for ($i = 0; $i < 3; $i++) {
            if (isset($request['question_title'][$i])) {
                $question = new ProductQuestion;
                $question->create([
                    'title' => $request['question_title'][$i],
                    'answer' => $request['answer'][$i],
                    'product_id' => $id
                ]);
            }
        }
    }

    public function searchProducts(object $request)
    {
        $prefecture_id = $request->prefecture_id;
        $low_price = $request->low_price;
        $high_price = $request->high_price;
        $is_online = $request->is_online;
        $age_period = $request->age_period;
        $sort = $request->sort;
        $keyword = $request->keyword;
        $parent_category_id = $request->parent_category_id;
        $child_category_id = $request->child_category_id;

        $query = Product::publish();

        if ($keyword) {
            $query = $this->searchByKeyword($query, $keyword);
        }

        if (!is_null($age_period)) {
            $query = $this->searchByAgePeriod($query, $age_period);
        }

        if(isset($request->parent_category_flg)) { //子カテゴリ、または親カテゴリから検索した場合
            if($request->parent_category_flg === '1') {
                $query = $this->searchByParentCategory($query, $request->parent_category_id);
            } elseif($request->parent_category_flg === '0') {
                $query = $this->searchByChildCategory($query, $request->child_category_id);
            }
        } else { //キーワード検索の時、または検索してから再度検索した時
            if(isset($parent_category_id)) {
                $query = $this->searchByParentCategory($query, $request->parent_category_id);
            } elseif(isset($child_category_id)) {
                $query = $this->searchByChildCategory($query, $request->child_category_id);
            }
        }

        if (!empty($prefecture_id)) {
            $query->where('prefecture_id', $prefecture_id);
        }

        if (!empty($low_price)) {
            $query->where('price', '>=', $low_price);
        }

        if (!empty($high_price)) {
            $query->where('price', '<=', $high_price);
        }

        if ($is_online === '0') {
            $query->where('is_online', $is_online);
        } elseif ($is_online === '1') {
            $query->where('is_online', $is_online);
        }

        if (!empty($sort)) {
            if ($sort == 1) { //ランキングの高い順
                $query->orderBy('created_at','desc'); //とりあえず新着で入れています。
            } elseif ($sort == 2) { //お気に入りの多い順
                $query->orderBy('created_at','desc'); //とりあえず新着で入れています。
            } elseif ($sort == 3) { //新着順
                $query->orderBy('created_at','desc');
            }
        } else {
            $query->latest();
        }

        return $query->paginate(40);
    }

    public function getURL($id)
    {
        $base_url = config('app.url');
        $url = "$base_url/product/$id";

        return $url;
    }
}
