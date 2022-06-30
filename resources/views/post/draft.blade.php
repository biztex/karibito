<x-layout>
	<article>
		<div id="breadcrumb">
			<div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　&gt;　
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                <a href="{{ route('draft') }}">下書き一覧</a>
			</div>
		</div><!-- /.breadcrumb -->
		<div class="btnFixed"><a href="{{ route('product.index') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>

		<x-parts.flash-msg />

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap">
						<h2 class="subPagesHd">下書き一覧</h2>
						<div class="subPagesTab tabWrap">
							<ul class="tabLink">
								<li><a href="#tab_box01" class="is_active">提供の下書き</a></li>
								<li><a href="#tab_box02" id="box02">依頼の下書き</a></li>
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
													@if(!empty($val->category_id))
													<div class="breadcrumb"><a href="#" tabindex="0">{{ $val->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<span>{{ $val->mProductChildCategory->name }}</span></div>
													@else
													<div class="breadcrumb"><a href="#" tabindex="0">カテゴリ未選択</a></div>
													@endif
													<div class="draw">
														<p class="price">
															<font>@if(!empty($val->title)){{ $val->title }}@else商品名未定@endif</font><br>{{ number_format($val->price) }}円
														</p>
													</div>
													<div class="single">
														@if(!empty($val->is_online))
														<a href="#" tabindex="0">{{ App\Models\JobRequest::IS_ONLINE[$val->is_online] }}</a>
														@endif
													</div>
												</div>
												<p class="link"><a href="{{ route('product.edit',$val->id) }}">編集する</a></p>

											</div>
										</li>
										@endforeach
									@endif
								</ul>
								{{ $products->links() }}
							</div><!-- 提供-->

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
													@if(!empty($val->category_id))
													<div class="breadcrumb"><a href="#" tabindex="0">{{ $val->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<span>{{ $val->mProductChildCategory->name }}</span></div>
													@else
													<div class="breadcrumb"><a href="#" tabindex="0">カテゴリ未選択</a></div>
													@endif
													<div class="draw">
														<p class="price">
															<font>@if(!empty($val->title)){{ $val->title }}@else商品名未定@endif</font><br>{{ number_format($val->price) }}円
														</p>
													</div>
													<div class="single">
														@if(!empty($val->is_online))
														<a href="#" tabindex="0">{{ App\Models\JobRequest::IS_ONLINE[$val->is_online] }}</a>
														@endif
													</div>
												</div>
												<p class="link"><a href="{{ route('job_request.edit',$val->id) }}">編集する</a></p>
											</div>
										</li>
										@endforeach
									@endif
								</ul>
								{{ $job_requests->fragment('job-request')->links() }}
							</div><!-- リクエスト-->

						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu />
			</div>
			<!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal />
	</article>
</x-layout>
