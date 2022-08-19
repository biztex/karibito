<div class="title">
    <div class="fun">
        <div class="single">
            <a tabindex="0">@if(!is_null($product->is_online)) {{App\Models\Product::IS_ONLINE[$product->is_online]}}@endif</a>
        </div>
        <!-- <a href="#" class="favorite">お気に入り(11)</a> -->
    </div>
    <div class="datas">
        <span class="data">電話相談の受付：@if(!is_null($product->is_call)) {{ App\Models\Product::IS_CALL[$product->is_call] }} @endif</span>
        <!-- <span class="data">閲覧：1000</span> -->
        @if(!is_null($product->prefecture_id))
        <span class ="data">エリア： {{ App\Models\Prefecture::find($product->prefecture_id)->name }} </span>
        @endif
        <span class="data">販売数：@if(!is_null($product->number_of_sale)){{App\Models\Product::NUMBER_OF_SALE[$product->number_of_sale]}}@endif</span>
        <span class="data">投稿日：{{$product->created_at->diffForHumans()}}
    </div>
    <h2><span>{{$product->title}}</span></h2>
</div>

<div class="slider">
    <div class="big">
        @foreach($product->productImage as $val)
            <div class="item"><img src="{{ asset('storage/'.$val->path) }}" style="aspect-ratio:16/9; object-fit:cover;"></div>
        @endforeach
    </div>
    <div class="small">
        @foreach($product->productImage as $val)
            <div class="item"><img src="{{ asset('storage/'.$val->path) }}" style="aspect-ratio:16/9; object-fit:cover;"></div>
        @endforeach
    </div>
</div>

<div class="content">
    <h2 class="hdM">サービス内容</h2>
    <p style="overflow-wrap: break-word;">{{$product->content}}</p>
</div>

@if($additional_options->isNotEmpty())
    <div class="content">
        <div class="optional">
            <h2 class="hdM">オプション追加料金</h2>
            <ul>
                @foreach($additional_options as $additional_option)
                    <li>
                        <span class="add">＋ {{$additional_option->name}}</span>
                        <span class="price">￥@if(!is_null($additional_option->price)){{ number_format(App\Models\AdditionalOption::OPTION_PRICE[$additional_option->price])}}@endif</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@if($product->productQuestion->isNotEmpty())
    <div class="content">
        <div class="optional faq">
            <h2 class="hdM">よくあるご質問</h2>
            <ul class="toggleWrapPC">
                @foreach($product->productQuestion as $product_question)
                    <li>
                        <p class="quest toggleBtn"><span>{{$product_question->title}}</span><span class="more">回答を見る</span></p>
                        <p class="answer toggleBox" style="width:100%;">{{$product_question->answer}}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@if ($product->productLink->isNotEmpty()) {{--YouTubeの動画--}}
    <div class="content">
        <div class="optional">
            <h2 class="hdM">参考動画</h2>
            @foreach($product->productLink as $product_link)
                <iframe class="" height="400" width="100%" src="{{ $product_link->iframe_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            @endforeach
        </div>
    </div>
@endif