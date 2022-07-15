<x-layout>
    <article>
    <x-parts.post-button/>
        <div id="breadcrumb">
			<div class="inner">
				<a href="{{route('home')}}">ホーム</a>　>　<span>チャット</span>
			</div>
		</div><!-- /.breadcrumb -->
        <div id="contents">
			<div class="cancelWrap">
				<div class="inner02">
					<h2 class="subPagesHd">やりとり</h2>
					<div class="subPagesTab st2 tabWrap">
						<ul class="tabLink">
							<li><a href="#tab_box01" class="is_active">進行中のやりとり</a></li>
							<li><a href="#tab_box02" class="">過去のやりとり</a></li>
						</ul>
						
						<div class="tabBox is_active" id="tab_box01">
							<ul class="favoriteUl01 exchangeChat">
								@foreach($active_product_chatrooms as $value)
									<li>
										<ul class="stepUl">
											<li @if($value->status < 5 ) class="is_active" @endif>
												<p class="stepDot"></p>
												<p class="stepTxt">チャット開始</p>
											</li>
											<li @if($value->status > 1 && $value->status < 5) class="is_active" @endif>
												<p class="stepDot"></p>
												<p class="stepTxt">契約</p>
											</li>
											<li @if($value->status > 2 && $value->status < 5)  class="is_active" @endif>
												<p class="stepDot"></p>
												<p class="stepTxt">作業</p>
											</li>
											<li @if($value->status >3 && $value->status < 5) class="is_active" @endif>
												<p class="stepDot"></p>
												<p class="stepTxt">評価</p>
											</li>
										</ul>
										<div class="conts">
											<div class="cont01">
												@if(isset($value->reference->productImage[0]))
													<p class="img"><img src="{{ asset('/storage/'.$value->reference->productImage[0]->path)}}" alt="" style="width: 120px;height: 100px;object-fit: cover;"></p>
												@else
													<p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
												@endif
												<div class="info">
													<div class="breadcrumb"><a href="#" tabindex="0">{{$value->reference->mProductChildCategory->mProductCategory->name}}</a> ＞ <span>{{$value->reference->mProductChildCategory->name}}</span></div>
													<div class="draw">
														<p class="price"><font>{{$value->reference->title}}</font><br>{{ number_format($value->reference->price)}}円</p>
													</div>
													<div class="single">
														<a href="#" tabindex="0">{{App\Models\Product::IS_ONLINE[$value->reference->is_online]}}</a>
													</div>
												</div>
											</div>
											<div class="cont02">
												<div class="user">
													@if($value->buyerUser->id === Auth::id())
														@if(null !== $value->sellerUser->userProfile->icon)
															<p class="ico"><img src="{{ asset('/storage/'.$value->sellerUser->userProfile->icon) }}" alt="" style="width: 40px;max-height: 40px;object-fit: cover;border-radius: 50px;"></p>
														@else
															<p class="ico"><img src="/img/mypage/no_image.jpg" alt="" style="width: 40px;height: 40px;object-fit: cover;"></p>
														@endif
														<div class="introd">
																<p class="name">{{$value->sellerUser->name}}</p>
																<p>({{App\Models\UserProfile::GENDER[$value->sellerUser->userProfile->gender]}}/ {{$value->sellerUser->userProfile->birthday}}/ {{$value->sellerUser->userProfile->prefecture->name}})</p>
														</div>
													@else
														@if(null !== $value->buyerUser->userProfile->icon)
															<p class="ico"><img src="{{ asset('/storage/'.$value->buyerUser->userProfile->icon) }}" alt="" style="width: 40px;max-height: 40px;object-fit: cover;border-radius: 50px;"></p>
														@else
															<p class="ico"><img src="/img/mypage/no_image.jpg" alt="" style="width: 40px;height: 40px;object-fit: cover;"></p>
														@endif
														<div class="introd">
															<p class="name">{{$value->buyerUser->name}}</p>
															<p>({{App\Models\UserProfile::GENDER[$value->buyerUser->userProfile->gender]}}/ {{$value->buyerUser->userProfile->birthday}}/ {{$value->buyerUser->userProfile->prefecture->name}})</p>
														</div>
													@endif
												</div>
												<div class="evaluate three"></div>
											</div>
										</div>
										<div class="functeBtns st2">
											<a href="{{route('product.show', $value->reference_id)}}" class="blue_o">チケット詳細</a>
											<a href="{{route('chatroom.show', $value->id)}}" class="green">チャットを開始</a>
										</div>
									</li>
								@endforeach
							</ul>
						</div><!-- #tab_box01-->

						<div class="tabBox" id="tab_box02">
							<ul class="favoriteUl01 exchangeChat">
								@foreach($inactive_product_chatrooms as $value)
									<li>
										<ul class="stepUl">
											<li class="is_active">
												<p class="stepDot"></p>
												<p class="stepTxt">チャット開始</p>
											</li>
											<li class="is_active">
												<p class="stepDot"></p>
												<p class="stepTxt">契約</p>
											</li>
											<li class="is_active">
												<p class="stepDot"></p>
												<p class="stepTxt">作業</p>
											</li>
											<li class="is_active">
												<p class="stepDot"></p>
												<p class="stepTxt">評価</p>
											</li>
										</ul>
										<div class="conts">
											<div class="cont01">
												@if(isset($value->reference->productImage[0]))
													<p class="img"><img src="{{ asset('/storage/'.$value->reference->productImage[0]->path)}}" alt="" style="width: 120px;height: 100px;object-fit: cover;"></p>
												@else
													<p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
												@endif
												<div class="info">
													<div class="breadcrumb"><a href="#" tabindex="0">{{$value->reference->mProductChildCategory->mProductCategory->name}}</a> ＞ <span>{{$value->reference->mProductChildCategory->name}}</span></div>
													<div class="draw">
														<p class="price"><font>{{$value->reference->title}}</font><br>{{ number_format($value->reference->price)}}円</p>
													</div>
													<div class="single">
														<a href="#" tabindex="0">{{App\Models\Product::IS_ONLINE[$value->reference->is_online]}}</a>
													</div>
												</div>
											</div>
											<div class="cont02">
												<div class="user">
													@if($value->buyerUser->id === Auth::id())
														@if(null !== $value->sellerUser->userProfile->icon)
															<p class="ico"><img src="{{ asset('/storage/'.$value->sellerUser->userProfile->icon) }}" alt="" style="width: 40px;max-height: 40px;object-fit: cover;border-radius: 50px;"></p>
														@else
															<p class="ico"><img src="/img/mypage/no_image.jpg" alt="" style="width: 40px;height: 40px;object-fit: cover;"></p>
														@endif
														<div class="introd">
																<p class="name">{{$value->sellerUser->name}}</p>
																<p>({{App\Models\UserProfile::GENDER[$value->sellerUser->userProfile->gender]}}/ {{$value->sellerUser->userProfile->birthday}}/ {{$value->sellerUser->userProfile->prefecture->name}})</p>
														</div>
													@else
														@if(null !== $value->buyerUser->userProfile->icon)
															<p class="ico"><img src="{{ asset('/storage/'.$value->buyerUser->userProfile->icon) }}" alt="" style="width: 40px;max-height: 40px;object-fit: cover;border-radius: 50px;"></p>
														@else
															<p class="ico"><img src="/img/mypage/no_image.jpg" alt="" style="width: 40px;height: 40px;object-fit: cover;"></p>
														@endif
														<div class="introd">
															<p class="name">{{$value->buyerUser->name}}</p>
															<p>({{App\Models\UserProfile::GENDER[$value->buyerUser->userProfile->gender]}}/ {{$value->buyerUser->userProfile->birthday}}/ {{$value->buyerUser->userProfile->prefecture->name}})</p>
														</div>
													@endif
												</div>
												<div class="evaluate three"></div>
											</div>
										</div>
										<div class="functeBtns st2">
											<a href="{{route('product.show', $value->reference_id)}}" class="blue_o">チケット詳細</a>
											<a href="{{route('chatroom.show', $value->id)}}" class="green">チャットを開始</a>
										</div>
									</li>
								@endforeach
							</ul>
						</div><!-- #tab_box02-->
					</div>
				</div><!--inner-->
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>