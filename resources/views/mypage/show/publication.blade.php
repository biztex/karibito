<div class="mypageSec03">
    <p class="mypageHd02">出品サービス<br>
        @if (!is_null($products[0]))<a href="{{ route('publication') }}" class="more">出品サービスを編集する</a>@endif
    </p>
    <div class="mypageBox">
        <ul class="favoriteUl01">
            @if (is_null($products[0]))
                <div class="box">
                    <p class="title">出品サービス</p>
                    <p class="txt">カリビトは、知識・スキル・経験を売り買いできるオンラインマーケットです。<br>あなたの ”得意” や ”経験”
                        を必要としている人がきっといます。<br>カリビトで出品してみませんか？</p>
                    <p class=""><a href="{{route('post')}}" class="more">追加する</a></p>
                </div>
            @else
                @foreach ($products as $product)
                    <li>
                        <div class="cont01">
                            <a href="{{ route('product.show',$product->id) }}">
                                @if(isset($product->productImage[0]))
                                    <p class="img"><img src="{{ asset('/storage/'.$product->productImage[0]->path)}}" alt=""></p>
                                @else
                                    <p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>
                                @endif
                            </a>
                            <div class="info">
                                <div class="breadcrumb">
                                    <a href="{{ route('product.category.index',$product->mProductChildCategory->mProductCategory->id) }}">
                                        {{ $product->mProductChildCategory->mProductCategory->name}}
                                    </a>&emsp;＞&emsp;
                                    <a href="{{ route('product.category.index.show',$product->mProductChildCategory->id)}}">
                                        {{ $product->mProductChildCategory->name }}
                                    </a>
                                </div>
                                <a href="{{ route('product.show',$product->id) }}">
                                    <div class="draw">
                                        <p class="price">
                                            <font>{{ $product->title }}</font><br>{{ number_format($product->price) }}
                                        </p>
                                    </div>
                                    <div class="single">
                                        @if ($product->is_draft == App\Models\Product::NOT_DRAFT || $product->is_online !== null)
                                            <span>{{App\Models\Product::IS_ONLINE[$product->is_online]}}</span>
                                        @endif
                                    </div>
                                </a>
                                <p class="link"><a href="{{ route('product.show',$product->id) }}">詳細見る</a></p>
                            </div>
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>
