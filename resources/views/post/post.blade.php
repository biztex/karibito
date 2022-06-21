<x-layout>
    <article>
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　<span>サービスを提供する</span>
            </div>
        </div><!-- /.breadcrumb -->
        <div class="btnFixed"><a href="{{ route('product.index') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a>
        </div>

        <div id="contents">
            <div class="cancelWrap">
                <div class="inner inner05">
                    <h2 class="subPagesHd">投稿</h2>
                    <div class="postLinks mb50">
                        <a href="{{ route('product.create') }}" class="fun camera">サービスを提供する</a>
                        <a href="{{ route('job_request.create') }}" class="fun note">サービスをリクエストする</a>
                        <div class="common">
                            <a href="{{ route('draft') }}">下書きを見る</a>
                            <a href="#" class="st2">ブログを投稿する</a>
                            <a href="#" class="st2">ポートフォリオを投稿する</a>
                        </div>
                    </div>
                    <p class="casesOffer"><span>提供中のサービス</span></p>
                    <ul class="favoriteUl01">
                        @foreach($products as $product)
                            <li>
                                <div class="cont01">
                                    <p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>
                                    <div class="info">
                                        <div class="breadcrumb">
                                            <a href="#" tabindex="0">@if(!is_null($product->category_id)){{$product->mProductChildCategory->mProductCategory->name}} @endif</a> ＞ 
                                            <span>@if(!is_null($product->category_id)){{$product->mProductChildCategory->name}}@endif</span>
                                        </div>
                                        <div class="draw">
                                            <p class="price"><font>{{$product->title}}</font><br>{{$product->price}}円</p>
                                        </div>
                                        <div class="single">
                                            <span>単発リクエスト</span>
                                            @if($product->is_online == 0)
                                                <a href="#" tabindex="0">対面</a>
                                            @elseif($product->is_online == 1)
                                                <a href="#" tabindex="1">非対面</a>
                                            @endif
                                        </div>
{{--                                        <p class="link"><a href="{{ route('product.show', ["id" => $product->id]) }}">詳細見る</a>--}}
                                            <p class="link"><a href="{{ route('product.show', ["product" => $product->id]) }}">詳細見る</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                        {{--						<li>--}}
                        {{--							<div class="cont01">--}}
                        {{--								<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>--}}
                        {{--								<div class="info">--}}
                        {{--									<div class="breadcrumb"><a href="#" tabindex="0">デザイン</a> ＞ <span>その他デザイン</span></div>--}}
                        {{--									<div class="draw">--}}
                        {{--										<p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>--}}
                        {{--									</div>--}}
                        {{--									<div class="single">--}}
                        {{--										<span>単発リクエスト</span>--}}
                        {{--										<a href="#" tabindex="0">対面</a>--}}
                        {{--									</div>--}}
                        {{--									<p class="link"><a href="#">詳細見る</a></p>--}}
                        {{--								</div>--}}
                        {{--							</div>--}}
                        {{--						</li>--}}
                        {{--						<li>--}}
                        {{--							<div class="cont01">--}}
                        {{--								<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>--}}
                        {{--								<div class="info">--}}
                        {{--									<div class="breadcrumb"><a href="#" tabindex="0">デザイン</a> ＞ <span>その他デザイン</span></div>--}}
                        {{--									<div class="draw">--}}
                        {{--										<p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>--}}
                        {{--									</div>--}}
                        {{--									<div class="single">--}}
                        {{--										<span>単発リクエスト</span>--}}
                        {{--										<a href="#" tabindex="0">対面</a>--}}
                        {{--									</div>--}}
                        {{--									<p class="link"><a href="#">詳細見る</a></p>--}}
                        {{--								</div>--}}
                        {{--							</div>--}}
                        {{--						</li>--}}
                        {{--						<li>--}}
                        {{--							<div class="cont01">--}}
                        {{--								<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>--}}
                        {{--								<div class="info">--}}
                        {{--									<div class="breadcrumb"><a href="#" tabindex="0">デザイン</a> ＞ <span>その他デザイン</span></div>--}}
                        {{--									<div class="draw">--}}
                        {{--										<p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>--}}
                        {{--									</div>--}}
                        {{--									<div class="single">--}}
                        {{--										<span>単発リクエスト</span>--}}
                        {{--										<a href="#" tabindex="0">対面</a>--}}
                        {{--									</div>--}}
                        {{--									<p class="link"><a href="#">詳細見る</a></p>--}}
                        {{--								</div>--}}
                        {{--							</div>--}}
                        {{--						</li>--}}
                        {{--						<li>--}}
                        {{--							<div class="cont01">--}}
                        {{--								<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>--}}
                        {{--								<div class="info">--}}
                        {{--									<div class="breadcrumb"><a href="#" tabindex="0">デザイン</a> ＞ <span>その他デザイン</span></div>--}}
                        {{--									<div class="draw">--}}
                        {{--										<p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>--}}
                        {{--									</div>--}}
                        {{--									<div class="single">--}}
                        {{--										<span>単発リクエスト</span>--}}
                        {{--										<a href="#" tabindex="0">対面</a>--}}
                        {{--									</div>--}}
                        {{--									<p class="link"><a href="#">詳細見る</a></p>--}}
                        {{--								</div>--}}
                        {{--							</div>--}}
                        {{--						</li>--}}
                        {{--						<li>--}}
                        {{--							<div class="cont01">--}}
                        {{--								<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>--}}
                        {{--								<div class="info">--}}
                        {{--									<div class="breadcrumb"><a href="#" tabindex="0">デザイン</a> ＞ <span>その他デザイン</span></div>--}}
                        {{--									<div class="draw">--}}
                        {{--										<p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>--}}
                        {{--									</div>--}}
                        {{--									<div class="single">--}}
                        {{--										<span>単発リクエスト</span>--}}
                        {{--										<a href="#" tabindex="0">対面</a>--}}
                        {{--									</div>--}}
                        {{--									<p class="link"><a href="#">詳細見る</a></p>--}}
                        {{--								</div>--}}
                        {{--							</div>--}}
                        {{--						</li>--}}
                        {{--						<li>--}}
                        {{--							<div class="cont01">--}}
                        {{--								<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>--}}
                        {{--								<div class="info">--}}
                        {{--									<div class="breadcrumb"><a href="#" tabindex="0">デザイン</a> ＞ <span>その他デザイン</span></div>--}}
                        {{--									<div class="draw">--}}
                        {{--										<p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>--}}
                        {{--									</div>--}}
                        {{--									<div class="single">--}}
                        {{--										<span>単発リクエスト</span>--}}
                        {{--										<a href="#" tabindex="0">対面</a>--}}
                        {{--									</div>--}}
                        {{--									<p class="link"><a href="#">詳細見る</a></p>--}}
                        {{--								</div>--}}
                        {{--							</div>--}}
                        {{--						</li>--}}
                        {{--						<li>--}}
                        {{--							<div class="cont01">--}}
                        {{--								<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>--}}
                        {{--								<div class="info">--}}
                        {{--									<div class="breadcrumb"><a href="#" tabindex="0">デザイン</a> ＞ <span>その他デザイン</span></div>--}}
                        {{--									<div class="draw">--}}
                        {{--										<p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>--}}
                        {{--									</div>--}}
                        {{--									<div class="single">--}}
                        {{--										<span>単発リクエスト</span>--}}
                        {{--										<a href="#" tabindex="0">対面</a>--}}
                        {{--									</div>--}}
                        {{--									<p class="link"><a href="#">詳細見る</a></p>--}}
                        {{--								</div>--}}
                        {{--							</div>--}}
                        {{--						</li>--}}
                        {{--						<li>--}}
                        {{--							<div class="cont01">--}}
                        {{--								<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>--}}
                        {{--								<div class="info">--}}
                        {{--									<div class="breadcrumb"><a href="#" tabindex="0">デザイン</a> ＞ <span>その他デザイン</span></div>--}}
                        {{--									<div class="draw">--}}
                        {{--										<p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>--}}
                        {{--									</div>--}}
                        {{--									<div class="single">--}}
                        {{--										<span>単発リクエスト</span>--}}
                        {{--										<a href="#" tabindex="0">対面</a>--}}
                        {{--									</div>--}}
                        {{--									<p class="link"><a href="#">詳細見る</a></p>--}}
                        {{--								</div>--}}
                        {{--							</div>--}}
                        {{--						</li>--}}
                        {{--						<li>--}}
                        {{--							<div class="cont01">--}}
                        {{--								<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>--}}
                        {{--								<div class="info">--}}
                        {{--									<div class="breadcrumb"><a href="#" tabindex="0">デザイン</a> ＞ <span>その他デザイン</span></div>--}}
                        {{--									<div class="draw">--}}
                        {{--										<p class="price"><font>似顔絵イラスト描きます</font><br>0,000円</p>--}}
                        {{--									</div>--}}
                        {{--									<div class="single">--}}
                        {{--										<span>単発リクエスト</span>--}}
                        {{--										<a href="#" tabindex="0">対面</a>--}}
                        {{--									</div>--}}
                        {{--									<p class="link"><a href="#">詳細見る</a></p>--}}
                        {{--								</div>--}}
                        {{--							</div>--}}
                        {{--						</li>--}}
                    </ul>
                </div><!--inner-->
            </div>
        </div><!-- /#contents -->
    </article>
</x-layout>
<script>
	// product画像 localStrageリセット
    $(function(){
        for (let i = 0; i < 10; i++){
            localStorage.removeItem("pic"+i);
        }
    });
</script>