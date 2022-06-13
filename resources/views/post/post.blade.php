<x-layout>
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>サービスを提供する</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div class="btnFixed"><a href="{{ route('product.index') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>

		<div id="contents">
			<div class="cancelWrap">
				<div class="inner inner05">
					<h2 class="subPagesHd">投稿</h2>
					<div class="postLinks mb50">
						<a href="{{ route('product.create') }}" class="fun camera">サービスを提供する</a>
						<a href="{{ route('service_request') }}" class="fun note">サービスをリクエストする</a>
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
									<div class="breadcrumb"><a href="#" tabindex="0">{{$product->category_id}}</a> ＞ <span>その他デザイン</span></div>
									<div class="draw">
										<p class="price"><font>似顔絵イラスト描きます</font><br>{{$product->price}}</p>
									</div>
									<div class="single">
										<span>単発リクエスト</span>
										<a href="#" tabindex="0">対面</a>
									</div>
									<p class="link"><a href="#">詳細見る</a></p>
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
