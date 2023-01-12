<x-layout>
	<article>
	<body id="draft">
		<div id="breadcrumb">
			<div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　&gt;　
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                <span>下書き一覧</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.ban-msg/>
		<x-parts.post-button/>
		<x-parts.flash-msg />

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap">
						<h2 class="subPagesHd">下書き一覧</h2>
						<div class="subPagesTab tabWrap">
							<ul class="tabLink">
								<li><a href="#tab_box01" class="is_active">提供の下書き</a></li>
								<li><a href="#tab_box02" id="box02">リクエストの下書き</a></li>
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
												@if(isset($val->productImage[0]))
													<a href="{{ route('product.edit',$val->id) }}">
														<p class="img"><img src="{{ asset('/storage/'.$val->productImage[0]->path)}}" alt=""></p>
													</a>
												@else
													<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>
												@endif
												<div class="info">
													@if(!empty($val->category_id))
														<div class="breadcrumb"><a href="{{ route('product.category.index',$val->mProductChildCategory->mProductCategory->id) }}" tabindex="0">{{ $val->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<a href="{{ route('product.category.index.show',$val->mProductChildCategory->id)}}">{{ $val->mProductChildCategory->name }}</a></div>
													@else
														<div class="breadcrumb"><a href="#" tabindex="0">カテゴリ未選択</a></div>
													@endif
													<a href="{{ route('product.edit',$val->id) }}">
														<div class="draw">
															<p class="price">
																<font>@if(!empty($val->title)){{ $val->title }}@elseサービス名未定@endif</font><br>{{ number_format($val->price) }}円
															</p>
														</div>
														<div class="single">
															@if(null !== ($val->is_online))
																<span tabindex="0">{{ App\Models\JobRequest::IS_ONLINE[$val->is_online] }}</span>
															@endif
														</div>
													</a>
													@if ($val->isPost())
													<form method="post">
														@csrf
														<input type="hidden" name="id" value={{ $val->id }}>
														<input type="hidden" name="category_id" value={{ $val->category_id }}>
														<input type="hidden" name="title" value={{ $val->title }}>
														<input type="hidden" name="content" value={{ $val->content }}>
														<input type="hidden" name="price" value={{ $val->price }}>
														<input type="hidden" name="is_online" value={{ $val->is_online }}>
														<input type="hidden" name="prefecture_id" value={{ $val->prefecture_id }}>
														<input type="hidden" name="time_unit" value={{ $val->time_unit }}>
														<input type="hidden" name="number_of_day" value={{ $val->number_of_day }}>
														<input type="hidden" name="number_of_sale" value={{ $val->number_of_sale }}>
														@if(collect($val->additionalOption)->isNotEmpty())
                            								@foreach($val->additionalOption as $additional_option)
                                                        		<input type="hidden" name="option_name[]" value="{{ $additional_option->name }}">
																<input type="hidden" name="option_price[]" value="{{ $additional_option->price }}">
																<input type="hidden" name="option_is_public[]" value="{{ $additional_option->is_public }}">
                                                        	@endforeach
														@else
															<input type="hidden" name="option_name[]" value="">
															<input type="hidden" name="option_price[]" value="">
															<input type="hidden" name="option_is_public[]" value="">
														@endif
														@if(collect($val->productQuestion)->isNotEmpty())
                                							@foreach($val->productQuestion as $product_question)
																<input type="hidden" name="question_title[]" value="{{ $product_question->title }}">
																<input type="hidden" name="answer[]" value="{{ $product_question->answer }}">
															@endforeach
														@else
															<input type="hidden" name="question_title[]" value="">
															<input type="hidden" name="answer[]" value="">
														@endif
														@if(collect($val->productLink)->isNotEmpty())
                            								@foreach($val->productLink as $link)
																<input type="hidden" name="youtube_link[]" value="{{ $link->youtube_link }}">
															@endforeach
														@else
															<input type="hidden" name="youtube_link[]" value="">
														@endif
														@for($i = 0; $i < 10; $i++)
															@if(isset($val->productImage[$i]))
																<input type="hidden" name="base64_text[]" value="#">
                                                    			<input type="hidden" name="old_image[]" value="{{ $val->productImage[$i]->path }}">
															@else
																<input type="hidden" name="base64_text[]" value="">
																<input type="hidden" name="old_image[]" value="">
															@endif
															<input type="hidden" name="image_status{{$i}}" value="">
														@endfor
														<input type="hidden" name="status" value={{ $val->status }}>
														<div class="update">
															<input type="submit" formaction="{{ route('product.update', $val->id) }}" value="登録する">
														</div>
														<div class="preview">
															<input type="submit" formaction="{{ route('product.edit.preview', $val->id) }}" value="プレビュー">
														</div>
													</form>
													@endif
													<div class="edit">
														<a href="{{ route('product.edit',$val->id) }}">編集する</a>
														<form id="delete-product" method="post" action="{{ route('product.destroy', $val->id ) }}">
															@csrf @method('delete')
															<p class="linkdel">
																<input type="button" class="full js-alertModal" value="削除">
															</p>
														</form>
													</div>
												</div>
											</div>
										</li>
                                        <x-parts.alert-modal formId="delete-product"/>
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
												<a href="{{ route('job_request.edit',$val->id) }}">
													<p class="img"><img src="/img/common/img_request@2x.jpg" alt=""></p>
												</a>
												<div class="info">
													@if(!empty($val->category_id))
													<div class="breadcrumb"><a href="{{ route('job_request.category.index',$val->mProductChildCategory->mProductCategory->id)}}" tabindex="0">{{ $val->mProductChildCategory->mProductCategory->name }}</a>&emsp;＞&emsp;<a href="{{ route('job_request.category.index.show',$val->mProductChildCategory->id)}}">{{ $val->mProductChildCategory->name }}</a></div>
													@else
													<div class="breadcrumb"><a href="#" tabindex="0">カテゴリ未選択</a></div>
													@endif
													<a href="{{ route('job_request.edit',$val->id) }}">
														<div class="draw">
															<p class="price">
																<font>@if(!empty($val->title)){{ $val->title }}@else サービス名未定@endif</font><br>{{ number_format($val->price) }}円
															</p>
														</div>
														<div class="single">
															@if(null !== ($val->is_online))
															<span tabindex="0">{{ App\Models\JobRequest::IS_ONLINE[$val->is_online] }}</span>
															@endif
														</div>
													</a>
													@if ($val->isPost())
													<form method="post">
														@csrf
														<input type="hidden" name="id" value={{ $val->id }}>
														<input type="hidden" name="category_id" value={{ $val->category_id }}>
														<input type="hidden" name="title" value={{ $val->title }}>
														<input type="hidden" name="content" value={{ $val->content }}>
														<input type="hidden" name="price" value={{ $val->price }}>
														<input type="hidden" name="application_deadline" value={{ $val->application_deadline }}>
														<input type="hidden" name="required_date" value={{ $val->required_date }}>
														<input type="hidden" name="is_online" value={{ $val->is_online }}>
														<input type="hidden" name="prefecture_id" value={{ $val->prefecture_id }}>
														<div class="update">
															<input type="submit" formaction="{{ route('job_request.update', $val->id) }}" value="登録する">
														</div>
														<div class="preview">
															<input type="submit" formaction="{{ route('job_request.edit.preview', $val->id) }}" value="プレビュー">
														</div>
													</form>
													@endif
													<div class="edit">
														<a href="{{ route('job_request.edit',$val->id) }}">編集する</a>
														<form id="delete-job_request" method="post" action="{{ route('job_request.destroy', $val->id ) }}">
															@csrf @method('delete')
                                                            <p class="linkdel">
                                                                <input type="button" class="full js-alertModal-2" value="削除">
                                                            </p>
														</form>
													</div>
												</div>
											</div>
										</li>
                                        <x-parts.alert-modal-2 formId="delete-job_request" />
										@endforeach
									@endif
								</ul>
								{{ $job_requests->fragment('job-request')->links() }}
							</div><!-- リクエスト-->

						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu />
			</div><!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal />
	</article>
</x-layout>
