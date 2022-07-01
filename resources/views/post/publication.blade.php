<x-layout>
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>掲載内容一覧</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div class="btnFixed"><a href="{{ route('product.index') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap">
						<h2 class="subPagesHd">掲載内容一覧</h2>
						<div class="subPagesTab tabWrap">
							<ul class="tabLink">
								<li><a href="#tab_box01" class="is_active">提供</a></li>
								<li><a href="#tab_box02" id="box02">リクエスト</a></li>
							</ul>
							<!---------------- 提供 ------------------>
							<div class="tabBox is_active" id="tab_box01">
								<ul class="favoriteUl01">
									@if(empty($products[0]))
									<li><div>投稿がありません。</div></li>
									@else
									@foreach($products as $val)
									<li>
										<div class="cont01">
											<!-- 画像1枚必須なため、ここのif分いらない。現段階で画像登録機能完了してないため入れてます -->
											@if(isset($val->productImage[0]))
											<p class="img"><img src="{{ asset('/storage/'.$val->productImage[0]->path)}}" alt="" style="width: 120px;height: 100px;object-fit: cover;"></p>
											@else
											<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>
											@endif
											<div class="info">
												<div class="breadcrumb"><a href="#" tabindex="0">{{ $val->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<span>{{ $val->mProductChildCategory->name }}</span></div>
												<div class="draw">
													<p class="price"><font>{{ $val->title }}</font><br>{{ number_format($val->price) }}円</p>
												</div>
												<div class="single">
													<a href="#" tabindex="0">{{ App\Models\Product::IS_ONLINE[$val->is_online] }}</a>
												</div>
											</div>
											<p class="link"><a href="{{ route('product.show',$val->id) }}">詳細見る</a></p>
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
									@if(empty($job_requests[0]))
									<li><div>投稿がありません。</div></li>
									@else
									@foreach($job_requests as $val)
									<li>
										<div class="cont01">
											<!-- <p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p> -->
											<div class="info">
												<div class="breadcrumb"><a href="#" tabindex="0">{{ $val->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<span>{{ $val->mProductChildCategory->name }}</span></div>
												<div class="draw">
													<p class="price"><font>{{ $val->title }}</font><br>{{ number_format($val->price) }}円</p>
												</div>
												<div class="single">
													<a href="#" tabindex="0">{{ App\Models\JobRequest::IS_ONLINE[$val->is_online] }}</a>
												</div>
											</div>
											<p class="link"><a href="{{ route('job_request.show',$val->id) }}">詳細見る</a></p>
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
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-layout>
