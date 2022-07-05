<x-other-user.layout>
	<div class="otherNav">
		<div class="inner">
			<ul>
				<li><a href="#">ホーム</a></li>
				<li><a href="#">評価</a></li>
				<li><a href="#">スキル・経歴</a></li>
				<li><a href="#">ポートフォリオ</a></li>
				<li><a href="#" class="is_active">出品サービス</a></li>
				<li><a href="#">ブログ</a></li>
			</ul>
		</div>
	</div>
	<x-parts.post-button/>
	<article>
        <x-parts.flash-msg/>
			<div id="contents" class="otherPage">
				<div class="inner02 clearfix">
					<div id="main">
						<div class="subPagesWrap">
							<h2 class="subPagesHd">出品サービス</h2>
							<div class="subPagesTab tabWrap">
								<div class="tabBox is_active" id="tab_box01">
									<ul class="favoriteUl01">
										@if($products->isEmpty())
											<li>
												<div class="cont01">
													<p>投稿がありません。</p>
												</div>
											</li>
										@else
											@foreach($products as $product)
											<li>
												<div class="cont01">
													<!-- 画像1枚必須なため、ここのif分いらない。現段階で画像登録機能完了してないため入れてます -->
													@if(isset($product->productImage[0]))
														<p class="img"><img src="{{ asset('/storage/'.$product->productImage[0]->path)}}" alt="" style="width: 120px;height: 100px;object-fit: cover;"></p>
													@else
														<p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
													@endif
													<div class="info">
														<div class="breadcrumb"><a href="#" tabindex="0">{{ $product->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<span>{{ $product->mProductChildCategory->name }}</span></div>
														<div class="draw">
															<p class="price"><font>{{ $product->title }}</font><br>{{ number_format($product->price) }}円</p>
														</div>
														<div class="single">
															<a href="#" tabindex="0">{{ App\Models\Product::IS_ONLINE[$product->is_online] }}</a>
														</div>
														<p class="link"><a href="{{ route('product.show',$product->id) }}">詳細見る</a></p>
													</div>
												</div>
											</li>
											@endforeach
										@endif
									</ul>
									{{ $products->links() }}
								</div>
							</div>
						</div>
					</div><!-- /#main -->
					<aside id="side" class="">
						<div class="box seller">
							<h3>スキル出品者</h3>
							@if(null !== $user->userProfile->icon)
								<a href="#" class="head"><img src="{{ asset('/storage/'.$user->userProfile->icon) }}" alt="" style="width: 120px;height: 120px;object-fit: cover;"></a>
							@else
								<a href="#" class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 120px;height: 120px;object-fit: cover;"></a>
							@endif
							<!-- <p class="login">最終ログイン：8時間前</p> -->
							<p class="introd"><span>{{$user->userProfile->name}}</span><br>({{\App\Models\UserProfile::GENDER[$user->userProfile->gender]}}/ {{$age}}/ {{$user->userProfile->prefecture->name}})</p>
							<!-- <div class="evaluate three"></div> -->
							<p class="check"><a href="#">本人確認済み</a></p>
							<!-- <p class="check"><a href="#">機密保持契約(NDA) 可能</a></p> -->
							<div class="blogDtOtherBtn">
								<a href="#" class="followA">フォローする</a>
								<a href="#">メッセージを送る</a>
							</div>
						</div>
					</aside>
				</div><!--inner-->
			</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-other-user.layout>