<x-other-user.layout>
	<article>
		<div class="otherNav">
			<div class="inner">
				<ul>
					<li><a href="{{ route('user.mypage', $user->id) }}">ホーム</a></li>
					<li><a href="{{ route('user.evaluation', $user->id) }}">評価</a></li>
					<li><a href="{{ route('user.skills', $user->id) }}">スキル・経歴</a></li>
					<li><a href="{{ route('user.portfolio', $user->id) }}">ポートフォリオ</a></li>
					<li><a href="#" class="is_active">出品サービス</a></li>
					<li><a href="#">ブログ</a></li>
				</ul>
			</div>
		</div>

		<x-parts.post-button/>
        <x-parts.flash-msg/>

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap">
						<h2 class="subPagesHd">出品サービス</h2>
						<div class="subPagesTab tabWrap">
						<ul class="tabLink">
							<li><a href="#tab_box01" class="is_active">提供</a></li>
							<li><a href="#tab_box02" id="box02">リクエスト</a></li>
						</ul>
							<!---------------- 提供 ------------------>
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
												@if(isset($product->productImage[0]))
													<p class="img"><img src="{{ asset('/storage/'.$product->productImage[0]->path)}}" alt="" style="width: 120px;height: 100px;object-fit: cover;"></p>
												@else
													<p class="img"><img src="/img/common/img_work01@2x.jpg" alt="" style="width: 120px;height: 100px;object-fit: cover;"></p>
												@endif
												<div class="info">
													<div class="breadcrumb"><a href="{{ route('product.category.index', $product->mProductChildCategory->mProductCategory->id)}}" tabindex="0">{{ $product->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<a href="{{ route('product.category.index.show', $product->mProductChildCategory->id)}}">{{ $product->mProductChildCategory->name }}</a></div>
													<div class="draw">
														<p class="price"><font>{{ $product->title }}</font><br>{{ number_format($product->price) }}円</p>
													</div>
													<div class="single">
														<span tabindex="0">{{ App\Models\Product::IS_ONLINE[$product->is_online] }}</span>
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

							<!---------------- リクエスト ------------------>
							<div class="tabBox" id="tab_box02">
								<ul class="favoriteUl01">
									@if($job_requests->isEmpty())
										<li>
											<div class="cont01">
												<p>投稿がありません。</p>
											</div>
										</li>
									@else
										@foreach($job_requests as $job_request)
										<li>
											<div class="cont01">
												<p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
												<div class="info">
													<div class="breadcrumb"><a href="{{ route('job_request.category.index', $job_request->mProductChildCategory->mProductCategory->id)}}" tabindex="0">{{ $job_request->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<a href="{{ route('job_request.category.index.show', $job_request->mProductChildCategory->id)}}">{{ $job_request->mProductChildCategory->name }}</a></div>
													<div class="draw">
														<p class="price"><font>{{ $job_request->title }}</font><br>{{ number_format($job_request->price) }}円</p>
													</div>
													<div class="single">
														<span tabindex="0">{{ App\Models\Product::IS_ONLINE[$job_request->is_online] }}</span>
													</div>
													<p class="link"><a href="{{ route('job_request.show',$job_request->id) }}">詳細見る</a></p>
												</div>
											</div>
										</li>
										@endforeach
									@endif
								</ul>
								{{ $job_requests->fragment('job-request')->links() }}
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				@include('other-user.parts.side')
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-other-user.layout>