<x-layout>
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>掲載内容</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div class="btnFixed"><a href="{{ route('post') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
		
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap">
						<h2 class="subPagesHd">掲載内容</h2>
						<div class="subPagesTab tabWrap">
							<ul class="tabLink">
								<li><a href="#tab_box01" class="is_active">提供</a></li>
								<li><a href="#tab_box02">リクエスト</a></li>
							</ul>
							<!---------------- 提供 ------------------>
							<div class="tabBox is_active" id="tab_box01">
								<ul class="favoriteUl01">
									@if(!empty($my_publish_products))
									@foreach($my_publish_products as $product)
									<li>
										<div class="cont01">
											<p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
											<div class="info">
												<div class="breadcrumb"><a href="#" tabindex="0">{{ $product->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<span>{{ $product->mProductChildCategory->name }}</span></div>
												<div class="draw">
													<p class="price"><font>{{ $product->title }}</font><br>{{ number_format($product->price) }}円</p>
												</div>
												<div class="single">
													<span>単発リクエスト</span>
													<a href="#" tabindex="0">{{ App\Models\Product::IS_ONLINE[$product->is_online] }}</a>
												</div>
												<p class="link"><a href="{{ route('product.show',$product->id) }}">詳細見る</a></p>
											</div>
										</div>
									</li>
									@endforeach
									@endif
								</ul>
							</div>

							<!---------------- リクエスト ------------------>
							<div class="tabBox" id="tab_box02">
								<ul class="favoriteUl01">
									@if(!empty($my_publish_products))
									@foreach($my_publish_job_requests as $job_request)
									<li>
										<div class="cont01">
											<p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
											<div class="info">
												<div class="breadcrumb"><a href="#" tabindex="0">{{ $job_request->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<span>{{ $job_request->mProductChildCategory->name }}</span></div>
												<div class="draw">
													<p class="price"><font>{{ $job_request->title }}</font><br>{{ number_format($job_request->price) }}円</p>
												</div>
												<div class="single">
													<span>単発リクエスト</span>
													<a href="#" tabindex="0">{{ App\Models\JobRequest::IS_ONLINE[$job_request->is_online] }}</a>
												</div>
												<p class="link"><a href="{{ route('job_request.show',$job_request->id) }}">詳細見る</a></p>
											</div>
										</div>
									</li>
									@endforeach
									@endif
								</ul>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-layout>