<x-layout>
<x-parts.flash-msg/>
<x-parts.post-button/>{{--投稿ボタンの読み込み--}}
	<article>
		<div id="mainVisual">
			<div class="main">
				<div class="inner">
					<p class="logo"><img src="/img/common/logo_title.svg" alt="LOGO"></p>
					<p class="sub">知識・スキル・経験を商品化<br class="sp">マッチングプラットフォーム！</p>
					<p class="cv"><img src="/img/top/main_cv.svg" alt=""></p>
				</div>
			</div>
			<div class="slider">
				<div class="item"><a href="#"><img src="/img/top/ico_slider01.png" srcset="/img/top/ico_slider01.png 1x, /img/top/ico_slider01@2x.png 2x" alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/ico_slider02.png" srcset="/img/top/ico_slider02.png 1x, /img/top/ico_slider02@2x.png 2x" alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/ico_slider03.png" srcset="/img/top/ico_slider03.png 1x, /img/top/ico_slider03@2x.png 2x" alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/ico_slider01.png" srcset="/img/top/ico_slider01.png 1x, /img/top/ico_slider01@2x.png 2x" alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/ico_slider02.png" srcset="/img/top/ico_slider02.png 1x, /img/top/ico_slider02@2x.png 2x" alt="写真"></a></div>
				<div class="item"><a href="#"><img src="/img/top/ico_slider03.png" srcset="/img/top/ico_slider03.png 1x, /img/top/ico_slider03@2x.png 2x" alt="写真"></a></div>
			</div>
		</div><!-- /.mainVisual -->

		<div id="contents">
			<div class="seaServices">
				<div class="inner">
					<h2 class="hdM"><img class="ico" src="/img/common/ico_folder.svg" alt="">条件からサービスを探す</h2>
					{{-- <div class="cate">
						<a href="#" class="cate cate01">カテゴリーから探す</a>
						<a href="#" class="cate cate02">エリアから探す</a>
						<a href="#" class="cate cate03">日付から探す</a>
						<a href="#" class="cate cate04">金額から探す</a>
					</div> --}}
					{{-- <div class="search">
						<input type="text" placeholder="サービス名・エリア名など"><input type="submit" class="btn" value="">
					</div> --}}
					<form method="get">
						<div class="search">
							<input type="text" name="keyword" @if(isset($keyword)) value="{{$keyword}}" @endif placeholder="キーワードを入力して検索">
							<input type="submit" class="btn" formaction="{{ route('product.search') }}" value="">
						</div>
					</form>
					{{-- <div class="recommend pc">
						<span>おすすめ：</span>
						<a href="#">画像・写真加工</a>
						<a href="#">インテリアデザイン</a>
						<a href="#">資料・企画書作成</a>
						<a href="#">画像・写真加工</a>
						<a href="#">インテリアデザイン</a>
						<a href="#">資料・企画書作成</a>
					</div> --}}
				</div>
			</div>
			<div class="indexNotice">
				<div class="inner">
					<div class="box newsList">
						<h2 class="hd">運営からのお知らせ</h2>
						@if(empty($important_news_list[0]))
							<div>運営からのお知らせは現在ありません。</div>
						@else
							@foreach ($important_news_list as $important_news)
								<dl>
									<dt>{{$important_news->created_at->format('Y/m/d')}}</dt>
									<dd><a href="{{ route('news.show', $important_news->id) }}">{{$important_news->title}}</a></dd>
								</dl>
							@endforeach
						@endif
					</div>
				</div>
			</div>
			<div class="indexTab tabWrap">
				<div class="inner">
					<ul class="tabLink">
						<li><a class="is_active" href="#tab_box01">提供</a></li>
						<li><a href="#tab_box02">リクエスト</a></li>
					</ul>
					<div class="tabBox is_active" id="tab_box01">
						<div class="clearfix">
							<div id="main">
								<div class="beginGuide">
									<h2 class="hdM">初めての方へ</h2>
									<ul>
										<li><a href="{{ route('support') }}"><img src="/img/common/img_guide01.png" srcset="/img/common/img_guide01.png 1x, /img/common/img_guide01@2x.png 2x" alt=""></a></li>
										<li><a href="#"><img src="/img/common/img_guide02.png" srcset="/img/common/img_guide02.png 1x, /img/common/img_guide02@2x.png 2x" alt=""></a></li>
									</ul>
								</div>
								<div class="recommendCates">
									<h2 class="hdM">おすすめのカテゴリー</h2>
									<ul>
										{{-- 後でやる --}}
										<li><a href="{{route('product.category.index', 1) }}" class="cate01">家事</a></li>
										<li><a href="{{route('product.category.index', 2) }}" class="cate02">修理組み立て</a></li>
										<li><a href="{{route('product.category.index', 16) }}" class="cate03">料理</a></li>
										<li><a href="{{route('product.category.index', 3) }}" class="cate04">ペット</a></li>
										<li><a href="{{route('product.category.index', 5) }}" class="cate05">乗り物</a></li>
										<li><a href="{{route('product.category.index', 6) }}" class="cate06">引越し</a></li>
										<li><a href="{{route('product.category.index', 8) }}" class="cate07">美容</a></li>
										<li><a href="{{route('product.category.index', 12) }}" class="cate08">デザイン</a></li>
									</ul>
								</div>
								<div class="recommendList style2">
									<h2 class="hdM">おすすめのお仕事</h2>
									<div class="list sliderSP">
										@if (!isset($products))
											<h2>現在、おすすめのお仕事は登録されていません。</h2>
										@else
											@foreach($products as $product)
												<div class="item">
													<a href="{{ route('product.show',$product->id) }}" class="img imgBox">
														@if(isset($product->productImage[0]))
															<p class="img"><img src="{{ asset('/storage/'.$product->productImage[0]->path) }}" alt="" style="width: 192px;height: 160px;object-fit: cover;"></p>
															<button class="favorite">お気に入り</button>
														@else
															<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>
															<button class="favorite">お気に入り</button>
														@endif
													</a>
													<div class="infoTop">
														<div>
															<div class="breadcrumb"><a href="#">{{ $product->mProductChildCategory->mProductCategory->name}}</a>&emsp;＞&emsp;<a href="">{{ $product->mProductChildCategory->name }}</a></div> {{-- 親カテゴリだけaタグなのか--}}
															<div class="draw">
																<p class="price" style="width:100%"><font>{{ $product->title }}</font><br>{{ number_format($product->price) }}円</p>
															</div>
															<div class="single">
																@if($product->is_online == App\Models\Product::OFFLINE)
																	<a href="">対面</a>
																@else
																	<a>非対面</a>
																@endif
															</div>
														</div>
														<div class="aboutUser">
															<div class="user">
																@if(empty($product->user->userProfile->icon))
																	<p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
																@else
																	<p class="ico"><img src="{{asset('/storage/'.$product->user->userProfile->icon) }}" alt="" style="border-radius:50%;width:35px;height: 35px;object-fit: cover;"></p>
																@endif
																<div class="introd">
																	<p class="name">{{ $product->user->name }}</p>
																	<p>({{ App\Models\UserProfile::GENDER[$product->user->userProfile->gender] }}/{{ $product->user->userProfile->birthday }} / {{ $product->user->userProfile->prefecture->name }})</p>
																</div>
															</div>
															<div class="evaluate three"><img src="/img/common/evaluate.svg" alt=""></div>
														</div>
													</div>
												</div>
											@endforeach
										@endif
									</div>
								</div>
								<div class="recommendList style2">
									<h2 class="hdM">カテゴリ別ランキング</h2>
									@if (!isset($product_category_ranks))
										<h2>現在、カテゴリ別ランキングはありません。</h2>
									@else
										@foreach($product_category_ranks as  $val)
											<div class="js-hide_product_categories @if ($loop->index >= 10) hide @endif"> {{-- div追加した（岩上）よくなかったら消します。 --}}
												<h3 class="cateTit"><span>{{ $val->name }}</span><a href="{{route('product.category.index', $val->id) }}" class="more">{{ $val->name }}から探す</a></h3>
												<div class="list sliderSP">
													@foreach($products as $product)
														@if( $product->mProductChildCategory->mProductCategory->name === $val->name)
															<div class="item">
																<a href="{{route('product.show',$product->id)}}" class="img imgBox">
																	@if(isset($product->productImage[0]))
																		<p class="img"><img src="{{ asset('/storage/'.$product->productImage[0]->path) }}" alt="" style="width: 192px;height: 160px;object-fit: cover;"></p>
																		<button class="favorite">お気に入り</button>
																	@else
																		<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>
																		<button class="favorite">お気に入り</button>
																	@endif
																</a>
																<div class="infoTop">
																	<div>
																		<div class="breadcrumb"><a href="#">{{ $product->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<span>{{ $product->mProductChildCategory->name }}</span></div>{{-- 親カテゴリだけaタグなのか--}}
																		<div class="draw">
																			<p class="price" style="width:100%"><font>{{ $product->title }}</font><br>{{ number_format($product->price) }}円</p>
																		</div>
																		<div class="single">
																			@if($product->is_online == App\Models\Product::OFFLINE)
																				<a>対面</a>
																			@else
																				<a>非対面</a>
																			@endif
																		</div>
																	</div>
																	<div class="aboutUser">
																		<div class="user">
																			@if(empty($product->user->userProfile->icon))
																			<p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
																			@else
																			<p class="ico"><img src="{{asset('/storage/'.$product->user->userProfile->icon) }}" alt="" style="border-radius:50%;width:35px;height: 35px;object-fit: cover;"></p>
																			@endif
																			<div class="introd">
																				<p class="name">{{ $product->user->name }}</p>
																				<p>({{ App\Models\UserProfile::GENDER[$product->user->userProfile->gender] }}/{{ $product->user->userProfile->birthday }} / {{ $product->user->userProfile->prefecture->name }})</p>
																			</div>
																		</div>
																		<div class="evaluate three"><img src="/img/common/evaluate.svg" alt=""></div>
																	</div>
																</div>
															</div>
														@endif
													@endforeach
												</div>
											</div>
										@endforeach
									@endif
								</div>
								<div class="otherBtn"><a href="javascript:;" class="js-productOtherBtn">その他カテゴリ別ランキングをみる</a></div>
								<div class="newsList mt60">
									<h2 class="hdM">カリビトからのお知らせ<a href="{{ route('news.index') }}" class="more">お知らせをもっと見る</a></h2>
									<div class=box>
                                        @if(empty($news_list[0]))
                                            <div>カリビトからのお知らせがありません。</div>
                                        @else
                                            @foreach($news_list as $news)
                                                <dl>
                                                    <dt>{{$news->created_at->format('Y/m/d')}}</dt>
                                                    <dd><a href="{{ route('news.show', $news->id) }}">{{$news->title}}</a></dd>
                                                </dl>
                                            @endforeach
                                        @endif
									</div>
								</div>
							</div><!-- /#main -->
							<aside id="side" class="pc">
								<h2>サービス一覧</h2>
								<ul class="links">
								@foreach($categories as $category)
									<li><a href="{{route('product.category.index', $category->id) }}">{{ $category->name }}</a></li>
								@endforeach
								</ul>
								<h2>ガイド</h2>
								<ul class="links">
									<li><a href="{{ route('support') }}">ご利用ガイド</a></li>
									<li><a href="#">よくある質問</a></li>
									<li><a href="{{ route('privacy-policy') }}">プライバシーポリシー</a></li>
									<li><a href="{{ route('contact') }}">お問い合わせ</a></li>
								</ul>
							</aside><!-- /#side -->
						</div>
					</div>
					<div class="tabBox" id="tab_box02">
						<div class="clearfix">
							<div id="main">
								<div class="beginGuide">
									<h2 class="hdM">初めての方へ</h2>
									<ul>
										<li><a href="{{ route('support') }}"><img src="/img/common/img_guide01.png" srcset="/img/common/img_guide01.png 1x, /img/common/img_guide01@2x.png 2x" alt=""></a></li>
										<li><a href="#"><img src="/img/common/img_guide02.png" srcset="/img/common/img_guide02.png 1x, /img/common/img_guide02@2x.png 2x" alt=""></a></li>
									</ul>
								</div>
								<div class="recommendCates">
									<h2 class="hdM">おすすめのカテゴリー</h2>
									<ul>
										<li><a href="{{route('job_request.category.index', 1) }}" class="cate01">家事</a></li>
										<li><a href="{{route('job_request.category.index', 2) }}" class="cate02">修理組み立て</a></li>
										<li><a href="{{route('job_request.category.index', 16) }}" class="cate03">料理</a></li>
										<li><a href="{{route('job_request.category.index', 3) }}" class="cate04">ペット</a></li>
										<li><a href="{{route('job_request.category.index', 5) }}" class="cate05">乗り物</a></li>
										<li><a href="{{route('job_request.category.index', 6) }}" class="cate06">引越し</a></li>
										<li><a href="{{route('job_request.category.index', 8) }}" class="cate07">美容</a></li>
										<li><a href="{{route('job_request.category.index', 12) }}" class="cate08">デザイン</a></li>
									</ul>
								</div>
								<div class="recommendList style2">
									<h2 class="hdM">おすすめのお仕事</h2>
									<div class="list sliderSP">
										@if (!isset($job_requests))
											<h2>現在、おすすめのお仕事は登録されていません。</h2>
										@else
											@foreach($job_requests as $job_request)
											<div class="item">
												<p class="level"></p>
												<div class="info">
													<div class="breadcrumb"><a href="#">{{ $job_request->mProductChildCategory->mProductCategory->name}}</a>&emsp;＞&emsp;<span>{{ $job_request->mProductChildCategory->name }}</span></div>
													<a href="{{ route('job_request.show',$job_request->id)}}">
														<div class="draw">
															<p class="price">{{ $job_request->title }}</font></p>
														</div>
														<div class="aboutInfo">
															<dl>
																<dt><span>予算</span></dt>
																<dd>{{ number_format($job_request->price) }}円〜</dd>
															</dl>
															<dl>
																<dt><span>提案数</span></dt>
																<dd>0</dd>
															</dl>
															<dl>
																<dt><span>募集期限</span></dt>
																<dd>{{ $job_request->deadline_day }}日と{{ $job_request->deadline_hour }}時間</dd>
															</dl>
														</div>
													</a>
													<div class="aboutUser">
														<div class="user">
															@if(empty($job_request->user->userProfile->icon))
															<p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
															@else
															<p class="ico"><img src="{{asset('/storage/'.$job_request->user->userProfile->icon) }}" alt="" style="border-radius:50%;width:35px;height: 35px;object-fit: cover;"></p>
															@endif
															<div class="introd">
																<p class="name">{{ $job_request->user->name }}</p>
																<p>({{ App\Models\UserProfile::GENDER[$job_request->user->userProfile->gender] }}/{{ $job_request->user->userProfile->birthday }} / {{ $job_request->user->userProfile->prefecture->name }})</p>
															</div>
														</div>
														<div class="evaluate three"><img src="/img/common/evaluate.svg" alt=""></div>
													</div>
												</div>
											</div>
											@endforeach
										@endif
									</div>
								</div>
								<div class="recommendList style2">
									<h2 class="hdM">カテゴリ別ランキング</h2>
									{{-- @dd($job_category_ranks) --}}
									@if (!isset($job_category_ranks))
										<h2>現在、カテゴリ別ランキングはありません。</h2>
									@else
										@foreach($job_category_ranks as  $val)
											<div class="js-hide_job_request_categories @if ($loop->index >= 10) hide @endif"> {{-- div追加した（岩上）よくなかったら消します。 --}}
												<h3 class="cateTit"><span>{{ $val->name }}</span><a href="{{route('job_request.category.index', $val->id) }}" class="more">{{ $val->name }}から探す</a></h3>
												<div class="list sliderSP">
													@foreach($job_requests as $job_request)
														@if($job_request->mProductChildCategory->mProductCategory->name === $val->name)
															<div class="item">
																<p class="level"></p>
																<div class="info">
																	<div class="breadcrumb"><a href="#">{{ $job_request->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<span>{{ $job_request->mProductChildCategory->name }}</span></div>
																	<div class="draw">
																		<p class="price"><font>{{ $job_request->title }}</font></p>
																	</div>
																	<div class="aboutInfo">
																		<dl>
																			<dt><span>予算</span></dt>
																			<dd>{{ number_format($job_request->price) }}円〜</dd>
																		</dl>
																		<dl>
																			<dt><span>提案数</span></dt>
																			<dd>0</dd>
																		</dl>
																		<dl>
																			<dt><span>募集期限</span></dt>
																			<dd>{{ $job_request->deadline_day }}日と{{ $job_request->deadline_hour }}時間</dd>
																		</dl>
																	</div>
																	<div class="aboutUser">
																		<div class="user">
																			@if(empty($job_request->user->userProfile->icon))
																				<p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
																			@else
																				<p class="ico"><img src="{{asset('/storage/'.$job_request->user->userProfile->icon) }}" alt="" style="border-radius:50%;width:35px;height: 35px;object-fit: cover;"></p>
																			@endif
																			<div class="introd">
																				<p class="name">{{ $job_request->user->name }}</p>
																				<p>({{ App\Models\UserProfile::GENDER[$job_request->user->userProfile->gender] }}/{{ $job_request->user->userProfile->birthday }} / {{ $job_request->user->userProfile->prefecture->name }})</p>
																			</div>
																		</div>
																		<div class="evaluate three"><img src="/img/common/evaluate.svg" alt=""></div>
																	</div>
																</div>
															</div>
														@endif
													@endforeach
												</div>
											</div>
										@endforeach
									@endif
									<div class="otherBtn"><a href="javascript:;" class="js-jobRequestOtherBtn">その他カテゴリ別ランキングをみる</a></div>
								</div>
								<div class="newsList mt60">
									<h2 class="hdM">カリビトからのお知らせ<a href="{{ route('news.index') }}" class="more">お知らせをもっと見る</a></h2>
									<div class=box>
                                        @if(empty($news_list[0]))
                                            <div>カリビトからのお知らせがありません。</div>
                                        @else
                                            @foreach($news_list as $news)
                                                <dl>
                                                    <dt>{{$news->created_at->format('Y/m/d')}}</dt>
                                                    <dd><a href="{{ route('news.show', $news->id) }}">{{$news->title}}</a></dd>
                                                </dl>
                                            @endforeach
                                        @endif
									</div>
								</div>
							</div><!-- /#main -->
							<aside id="side" class="pc">
								<h2>サービス一覧</h2>
								<ul class="links">
									@foreach($categories as $category)
										<li><a href="{{route('product.category.index', $category->id) }}">{{ $category->name }}</a></li>
									@endforeach
								</ul>
								<h2>ガイド</h2>
								<ul class="links">
									<li><a href="{{ route('support') }}">ご利用ガイド</a></li>
									<li><a href="#">よくある質問</a></li>
									<li><a href="{{ route('privacy-policy') }}">プライバシーポリシー</a></li>
									<li><a href="{{ route('contact') }}">お問い合わせ</a></li>
								</ul>
							</aside><!-- /#side -->
						</div>
					</div>
				</div>
			</div>
		</div><!-- /#contents -->
	</article>
</x-layout>
<script type="text/javascript">
	$(function(){
		showProductRank();
		showJobRequestRank();
	})

	function showProductRank(){
		$('.js-productOtherBtn').on('click', function () {
			$(".js-hide_product_categories").removeClass('hide');
		}
	)}

	function showJobRequestRank(){
		$('.js-jobRequestOtherBtn').on('click', function () {
			$(".js-hide_job_request_categories").removeClass('hide');
		}
	)}
</script>