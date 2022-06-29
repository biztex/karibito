<x-layout>
    <article>
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　<a href="service.html">サービスを探す</a>　>　
                <a href="#">@if(!is_null($product->category_id)){{$product->mProductChildCategory->mProductCategory->name}} @endif</a>　>　
                <a href="#">@if(!is_null($product->category_id)){{$product->mProductChildCategory->name}} @endif</a>　>　<span>{{$product->title}}</span>
            </div>
        </div><!-- /.breadcrumb -->
        <div id="contents" class="detailStyle">
            <div class="inner02 ">
                <div class="clearfix">
                    <div id="main">
                        <div class="title">
                            <div class="fun">
                                <div class="single">
                                    <a href="#" tabindex="0">@if(!is_null($product->is_online)) {{App\Models\Product::IS_ONLINE[$product->is_online]}}@endif</a>
                                </div>
                                <!-- <a href="#" class="favorite">お気に入り(11)</a> -->
                            </div>
                            <div class="datas">
                                <span class="data">電話相談の受付：@if(!is_null($product->is_call)) {{ App\Models\Product::IS_CALL[$product->is_call] }} @endif</span>
                                <!-- <span class="data">閲覧：1000</span> -->
                                <span class="data">エリア：@if(!is_null($product->prefecture_id)) {{ App\Models\Prefecture::find($product->prefecture_id)->name }} @endif</span>
                                <span class="data">販売数：@if(!is_null($product->number_of_sale)){{App\Models\Product::NUMBER_OF_SALE[$product->number_of_sale]}}@endif</span>
                            </div>
                            <h2><span>{{$product->title}}</span></h2>
                        </div>
                        <div class="slider">
                            <div class="big">
                                @foreach($product->productImage as $val)
                                    <div class="item"><img src="{{ asset('storage/'.$val->path) }}" style="aspect-ratio:16/9; object-fit:cover;"></div>
                                @endforeach
                                                       <!-- srcset="img/service/img_slider_small01.jpg 1x, img/service/img_slider_small01.jpg 2x"
                                                       alt=""></div> -->
                                <!-- <div class="item"><img src="/img/service/img_slider_small02.jpg"
                                                       srcset="img/service/img_slider_small02.jpg 1x, img/service/img_slider_small02.jpg 2x"
                                                       alt=""></div>
                                <div class="item"><img src="/img/service/img_slider_big.jpg"
                                                       srcset="img/service/img_slider_big.jpg 1x, img/service/img_slider_big@2x.jpg 2x"
                                                       alt=""></div>
                                <div class="item"><img src="/img/service/img_slider_big.jpg"
                                                       srcset="img/service/img_slider_big.jpg 1x, img/service/img_slider_big@2x.jpg 2x"
                                                       alt=""></div>
                                <div class="item"><img src="/img/service/img_slider_big.jpg"
                                                       srcset="img/service/img_slider_big.jpg 1x, img/service/img_slider_big@2x.jpg 2x"
                                                       alt=""></div>
                                <div class="item"><img src="/img/service/img_slider_big.jpg"
                                                       srcset="img/service/img_slider_big.jpg 1x, img/service/img_slider_big@2x.jpg 2x"
                                                       alt=""></div> -->
                            </div>
                            <div class="small">
                                @foreach($product->productImage as $val)
                                    <div class="item"><img src="{{ asset('storage/'.$val->path) }}" style="aspect-ratio:16/9; object-fit:cover;"></div>
                                @endforeach
                                <!-- <div class="item"><img src="/img/service/img_slider_small01.jpg" alt=""></div>
                                <div class="item"><img src="/img/service/img_slider_small02.jpg" alt=""></div>
                                <div class="item"><img src="/img/service/img_slider_small.jpg" alt=""></div>
                                <div class="item"><img src="/img/service/img_slider_small.jpg" alt=""></div>
                                <div class="item"><img src="/img/service/img_slider_small.jpg" alt=""></div>
                                <div class="item"><img src="/img/service/img_slider_small.jpg" alt=""></div> -->
                            </div>
                        </div>
                        <div class="content">
                            <h2 class="hdM">サービス内容</h2>
                            <p style="overflow-wrap: break-word;">{{$product->content}}</p>
                        </div>
                        <div class="optional">
                            <h2 class="hdM">オプション追加料金</h2>
                            <ul>
                                @foreach($product->additionalOptions as $additional_option)
                                    <li>
                                        <span class="add">＋ {{$additional_option->name}}</span>
                                        <span class="price">￥@if(!is_null($additional_option->price)){{ App\Models\AdditionalOption::OPTION_PRICE[$additional_option->price]}}@endif</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="optional faq">
                            <h2 class="hdM">よくあるご質問</h2>
                            <ul class="toggleWrapPC">
                                @foreach($product->productQuestions as $product_question)
                                    <li>
                                        <p class="quest toggleBtn"><span>{{$product_question->title}}</span><span class="more">回答を見る</span></p>
                                        <p class="answer toggleBox">{{$product_question->answer}}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{--					<div class="clientEvaluate">--}}
                        {{--						<h2 class="hdM">依頼者からの評価</h2>--}}
                        {{--						<div class="box">--}}
                        {{--							<div class="ftBox">--}}
                        {{--								<li>--}}
                        {{--									<div class="img">--}}
                        {{--										<p class="head"><img src="/img/service/ico_head.png" alt=""></p>--}}
                        {{--										<p class="evaluate eva01"></p>--}}
                        {{--									</div>--}}
                        {{--									<div class="info">--}}
                        {{--										<p>クリエイター名<span class="date">2021年7月26日</span></p>--}}
                        {{--										<p>センスの良いものを提供して頂きました。<br>また機会があれば宜しくお願い致します。</p>--}}
                        {{--									</div>--}}
                        {{--								</li>--}}
                        {{--								<li>--}}
                        {{--									<div class="img">--}}
                        {{--										<p class="head"><img src="/img/service/ico_head.png" alt=""></p>--}}
                        {{--										<p class="evaluate eva01"></p>--}}
                        {{--									</div>--}}
                        {{--									<div class="info">--}}
                        {{--										<p>クリエイター名<span class="date">2021年7月26日</span></p>--}}
                        {{--										<p>感想入ります感想入ります感想入ります感想入ります感想入ります<br>感想入ります感想入ります</p>--}}
                        {{--									</div>--}}
                        {{--								</li>--}}
                        {{--								<li>--}}
                        {{--									<div class="img">--}}
                        {{--										<p class="head"><img src="/img/service/ico_head.png" alt=""></p>--}}
                        {{--										<p class="evaluate eva02"></p>--}}
                        {{--									</div>--}}
                        {{--									<div class="info">--}}
                        {{--										<p>クリエイター名<span class="date">2021年7月26日</span></p>--}}
                        {{--										<p>感想入ります感想入ります感想入ります感想入ります感想入ります<br>感想入ります感想入ります</p>--}}
                        {{--									</div>--}}
                        {{--								</li>--}}
                        {{--								<li>--}}
                        {{--									<div class="img">--}}
                        {{--										<p class="head"><img src="/img/service/ico_head.png" alt=""></p>--}}
                        {{--										<p class="evaluate eva03"></p>--}}
                        {{--									</div>--}}
                        {{--									<div class="info">--}}
                        {{--										<p>クリエイター名<span class="date">2021年7月26日</span></p>--}}
                        {{--										<p>感想入ります感想入ります感想入ります感想入ります感想入ります<br>感想入ります感想入ります</p>--}}
                        {{--									</div>--}}
                        {{--								</li>--}}
                        {{--								<li>--}}
                        {{--									<div class="img">--}}
                        {{--										<p class="head"><img src="/img/service/ico_head.png" alt=""></p>--}}
                        {{--										<p class="evaluate eva01"></p>--}}
                        {{--									</div>--}}
                        {{--									<div class="info">--}}
                        {{--										<p>クリエイター名<span class="date">2021年7月26日</span></p>--}}
                        {{--										<p>センスの良いものを提供して頂きました。<br>また機会があれば宜しくお願い致します。</p>--}}
                        {{--									</div>--}}
                        {{--								</li>--}}
                        {{--								<li>--}}
                        {{--									<div class="img">--}}
                        {{--										<p class="head"><img src="/img/service/ico_head.png" alt=""></p>--}}
                        {{--										<p class="evaluate eva01"></p>--}}
                        {{--									</div>--}}
                        {{--									<div class="info">--}}
                        {{--										<p>クリエイター名<span class="date">2021年7月26日</span></p>--}}
                        {{--										<p>感想入ります感想入ります感想入ります感想入ります感想入ります<br>感想入ります感想入ります</p>--}}
                        {{--									</div>--}}
                        {{--								</li>--}}
                        {{--								<li>--}}
                        {{--									<div class="img">--}}
                        {{--										<p class="head"><img src="/img/service/ico_head.png" alt=""></p>--}}
                        {{--										<p class="evaluate eva02"></p>--}}
                        {{--									</div>--}}
                        {{--									<div class="info">--}}
                        {{--										<p>クリエイター名<span class="date">2021年7月26日</span></p>--}}
                        {{--										<p>感想入ります感想入ります感想入ります感想入ります感想入ります<br>感想入ります感想入ります</p>--}}
                        {{--									</div>--}}
                        {{--								</li>--}}
                        {{--								<li>--}}
                        {{--									<div class="img">--}}
                        {{--										<p class="head"><img src="/img/service/ico_head.png" alt=""></p>--}}
                        {{--										<p class="evaluate eva03"></p>--}}
                        {{--									</div>--}}
                        {{--									<div class="info">--}}
                        {{--										<p>クリエイター名<span class="date">2021年7月26日</span></p>--}}
                        {{--										<p>感想入ります感想入ります感想入ります感想入ります感想入ります<br>感想入ります感想入ります</p>--}}
                        {{--									</div>--}}
                        {{--								</li>--}}
                        {{--								<li>--}}
                        {{--									<div class="img">--}}
                        {{--										<p class="head"><img src="/img/service/ico_head.png" alt=""></p>--}}
                        {{--										<p class="evaluate eva01"></p>--}}
                        {{--									</div>--}}
                        {{--									<div class="info">--}}
                        {{--										<p>クリエイター名<span class="date">2021年7月26日</span></p>--}}
                        {{--										<p>センスの良いものを提供して頂きました。<br>また機会があれば宜しくお願い致します。</p>--}}
                        {{--									</div>--}}
                        {{--								</li>--}}
                        {{--								<li>--}}
                        {{--									<div class="img">--}}
                        {{--										<p class="head"><img src="/img/service/ico_head.png" alt=""></p>--}}
                        {{--										<p class="evaluate eva01"></p>--}}
                        {{--									</div>--}}
                        {{--									<div class="info">--}}
                        {{--										<p>クリエイター名<span class="date">2021年7月26日</span></p>--}}
                        {{--										<p>感想入ります感想入ります感想入ります感想入ります感想入ります<br>感想入ります感想入ります</p>--}}
                        {{--									</div>--}}
                        {{--								</li>--}}
                        {{--								<li>--}}
                        {{--									<div class="img">--}}
                        {{--										<p class="head"><img src="/img/service/ico_head.png" alt=""></p>--}}
                        {{--										<p class="evaluate eva02"></p>--}}
                        {{--									</div>--}}
                        {{--									<div class="info">--}}
                        {{--										<p>クリエイター名<span class="date">2021年7月26日</span></p>--}}
                        {{--										<p>感想入ります感想入ります感想入ります感想入ります感想入ります<br>感想入ります感想入ります</p>--}}
                        {{--									</div>--}}
                        {{--								</li>--}}
                        {{--								<li>--}}
                        {{--									<div class="img">--}}
                        {{--										<p class="head"><img src="/img/service/ico_head.png" alt=""></p>--}}
                        {{--										<p class="evaluate eva03"></p>--}}
                        {{--									</div>--}}
                        {{--									<div class="info">--}}
                        {{--										<p>クリエイター名<span class="date">2021年7月26日</span></p>--}}
                        {{--										<p>感想入ります感想入ります感想入ります感想入ります感想入ります<br>感想入ります感想入ります</p>--}}
                        {{--									</div>--}}
                        {{--								</li>--}}
                        {{--							</div>--}}
                        {{--							<ul>Data loading, please wait...</ul>--}}
                        {{--							<div class="go"><a href="javascript:;" onClick="moreload.loadMore();" class="more">もっと見る</a></div>--}}
                        {{--						</div>--}}
                        {{--					</div>--}}
                    </div>
                    <aside id="side" class="pc">
                        <div class="box reservate">
                            <h3>{{$product->price}}円</h3>
                            <p class="status">所用期間</p>
                            <p class="date">{{$product->number_of_day}}日</p>
{{--                            <div class="calendar"><div id="datepicker"></div></div>--}}
                        </div>
                        <div>
                            <div class="peace">
                                <h3>カリビト安心への取り組み</h3>
                                <p>報酬は取引前に事務局に支払われ、評価・完了後に振り込まれます。利用規約違反や少しでも不審な内容のサービスやリクエストやユーザーがあった場合は通報してください。</p>
                            </div>
                            <div class="functeBtns">
                                @if($product->user_id === Auth::id() )
                                    <div class="functeBtns">
                                        <a href="{{ route('product.edit', $product->id)}}" class="orange full">編集</a>
                                    </div>
                                    <form method="post" action="{{ route('product.destroy', $product->id ) }}">
                                        @csrf @method('delete')
                                        <div class="functeBtns">
                                            <input type="submit" class="full" style="box-shadow: 0 6px 0 #999999;height: 55px;font-size: 1.8rem;color:white;max-width: 100%;border-radius: 4px;font-weight:700;" value="削除">
                                        </div>
                                    </form>
                                @endif
                            </div>
                            <p class="specialtyBtn"><span>この情報をシェアする</span></p>
                        </div>
                        <div class="box seller">
                            <h3>スキル出品者</h3>
                                @if(empty($user->userProfile->icon))
									<a href="#" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
								@else
                                    <a href="#" class="head"><img src={{asset('/storage/'.$user->userProfile->icon) }} alt=""></a>
                                @endif
                            <!-- <p class="login">最終ログイン：8時間前</p> -->
                            <p class="introd"><a href="#" class="name">{{$user->name}}</a><br>({{App\Models\UserProfile::GENDER[$user->userProfile->gender]}} / {{$age}}/ {{$user->userProfile->prefecture->name}})</p>
                            <!-- <div class="evaluate three"></div> -->
                            @if($user->userProfile->is_identify = 1)
                                <p class="check"><a href="#">本人確認済み</a></p>
                            @endif
                        </div>
                    </aside>
                </div>
{{--                <div id="">--}}
{{--                    <div class="recommendList style2">--}}
{{--                        <h2 class="hdM">{{$product->productUser->name}}さんのその他の出品</h2>--}}
{{--                        <div class="list sliderSP">--}}
{{--                            @foreach($all_products as $all_product)--}}
{{--                                <div class="item">--}}
{{--                                    <a href="#" class="img imgBox" data-img="img/common/img_work01@2x.jpg">--}}
{{--                                        <img src="/img/common/img_270x160.png" alt="">--}}
{{--                                        <button class="favorite">お気に入り</button>--}}
{{--                                    </a>--}}
{{--                                    <div class="info">--}}
{{--                                        <div class="breadcrumb"><a href="#">@if(!is_null($all_product->category_id)){{$all_product->mProductChildCategory->mProductCategory->name}} @endif</a>&emsp;＞&emsp;<span>@if(!is_null($all_product->category_id)){{$all_product->mProductChildCategory->name}}@endif</span></div>--}}
{{--                                        <div class="draw">--}}
{{--                                            <p class="ico"><img src="/img/service/ico_color.png" alt=""></p>--}}
{{--                                            <p class="price"><font>{{$all_product->title}}</font><br>{{$all_product->price}}円</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="single">--}}
{{--                                            <span>単発リクエスト</span>--}}
{{--                                            <a href="#">{{App\Models\Product::IS_ONLINE[$all_product->is_online]}}</a>--}}
{{--                                        </div>--}}
{{--                                        <div class="aboutUser">--}}
{{--                                            <div class="user">--}}
{{--                                                <p class="ico"><img src="/img/common/ico_head.png" alt=""></p>--}}
{{--                                                <div class="introd">--}}
{{--                                                    <p class="name">{{$all_product->productUser->name}}</p>--}}
{{--                                                    <p>({{App\Models\UserProfile::GENDER[$all_product->productUser->userProfile->gender]}}/ {{$age}}/ {{$product->productUser->userProfile->prefecture->name}})</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="evaluates">--}}
{{--                                                <span class="good">0</span>--}}
{{--                                                <span class="usually">0</span>--}}
{{--                                                <span class="pity">0</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div><!--inner-->--}}
    </article>
</x-layout>
<script type="text/javascript">
    $(function () {
        $("#datepicker").datepicker();
    });

    var _content = [];
    var moreload = {
        _default: 5, // 初期化により5つのメッセージが表示されます
        _loading: 3, // 一度にさらに3つのアイテムを表示する
        init: function () {
            var lis = $(".clientEvaluate .ftBox li");
            $(".clientEvaluate ul").html("");
            for (var n = 0; n < moreload._default; n++) {
                lis.eq(n).appendTo(".clientEvaluate ul");
            }
            for (var i = moreload._default; i < lis.length; i++) {
                _content.push(lis.eq(i));
            }
            $(".clientEvaluate .ftBox").html("");
        },
        loadMore: function () {
            var mLis = $(".clientEvaluate li").length;
            for (var i = 0; i < moreload._loading; i++) {
                var target = _content.shift();
                if (!target) {
                    $('.clientEvaluate .more').html("").addClass('load');
                    break;
                }
                $(".clientEvaluate ul").append(target);
            }
        }
    }
    moreload.init();
</script>
