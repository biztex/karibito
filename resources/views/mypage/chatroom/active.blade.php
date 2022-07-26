<x-other-user.layout>
	<article>
        <body id="chatroom-active">
            <div id="breadcrumb">
                <div class="inner">
                    <a href="{{ route('home') }}">ホーム</a>　>　<span>進行中の取引</span>
                </div>
            </div><!-- /.breadcrumb -->		
	        <x-parts.post-button/>
            <div id="contents" class="otherPage">
                <div class="inner02 clearfix">
                    <div id="main">
                        <div class="subPagesWrap favoriteWrap">
                            <h2 class="subPagesHd">進行中の取引</h2>
                            <div class="subPagesTab tabWrap">
                                <ul class="tabLink">
                                    <li><a href="#tab_box01" class="is_active">提供</a></li>
                                    <li><a href="#tab_box02" id="box02">リクエスト</a></li>
                                </ul>
                                <div class="tabBox is_active" id="tab_box01">
                                    <ul class="favoriteUl01 ">

                                    @if($active_product_chatrooms->isEmpty())
                                        <p>進行中の取引はありません。</p>
                                    @else
                                        @foreach($active_product_chatrooms as $value)
                                            <li>
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
																<p class="ico"><img src="/img/mypage/no_image.jpg" alt="" style="width: 40px;height: 40px;object-fit: cover;border-radius: 50%;"></p>
															@endif
															<div class="introd">
																	<p class="name">{{$value->sellerUser->name}}</p>
																	<p>({{App\Models\UserProfile::GENDER[$value->sellerUser->userProfile->gender]}}/ {{$value->sellerUser->userProfile->birthday}}/ {{$value->sellerUser->userProfile->prefecture->name}})</p>
															</div>
														@else
															@if(null !== $value->buyerUser->userProfile->icon)
																<p class="ico"><img src="{{ asset('/storage/'.$value->buyerUser->userProfile->icon) }}" alt="" style="width: 40px;max-height: 40px;object-fit: cover;border-radius: 50px;"></p>
															@else
																<p class="ico"><img src="/img/mypage/no_image.jpg" alt="" style="width: 40px;height: 40px;object-fit: cover;border-radius: 50%;"></p>
															@endif
															<div class="introd">
																<p class="name">{{$value->buyerUser->name}}</p>
																<p>({{App\Models\UserProfile::GENDER[$value->buyerUser->userProfile->gender]}}/ {{$value->buyerUser->userProfile->birthday}}/ {{$value->buyerUser->userProfile->prefecture->name}})</p>
															</div>
														@endif
                                                    </div>
                                                    <div class="evaluate three"></div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                    </ul>
								{{ $active_product_chatrooms->links() }}
						        </div>
                                <div class="tabBox" id="tab_box02">
                                    <ul class="favoriteUl01 ">
                                        @if($active_job_request_chatrooms->isEmpty())
                                            <p>進行中の取引はありません。</p>
                                        @else
                                            @foreach($active_job_request_chatrooms as $value)
                                                <li>
                                                    <div class="cont01">
                                                        <div class="info">
                                                            <div class="breadcrumb"><a href="#" tabindex="0">{{$value->reference->mProductChildCategory->mProductCategory->name}}</a> ＞ <span>{{$value->reference->mProductChildCategory->name}}</span></div>
                                                            <div class="draw">
                                                                <p class="price"><font>{{$value->reference->title}}</font><br>{{ number_format($value->reference->price)}}円</p>
                                                            </div>
                                                            <div class="single">
                                                                <a href="#" tabindex="0">{{App\Models\JobRequest::IS_ONLINE[$value->reference->is_online]}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cont02">
                                                        <div class="user">
                                                            @if($value->buyerUser->id === Auth::id())
                                                                @if(null !== $value->sellerUser->userProfile->icon)
                                                                    <p class="ico"><img src="{{ asset('/storage/'.$value->sellerUser->userProfile->icon) }}" alt="" style="width: 40px;max-height: 40px;object-fit: cover;border-radius: 50%;"></p>
                                                                @else
                                                                    <p class="ico"><img src="/img/mypage/no_image.jpg" alt="" style="width: 40px;height: 40px;object-fit: cover;border-radius: 50%;"></p>
                                                                @endif
                                                                <div class="introd">
                                                                        <p class="name">{{$value->sellerUser->name}}</p>
                                                                        <p>({{App\Models\UserProfile::GENDER[$value->sellerUser->userProfile->gender]}}/ {{$value->sellerUser->userProfile->birthday}}/ {{$value->sellerUser->userProfile->prefecture->name}})</p>
                                                                </div>
                                                            @else
                                                                @if(null !== $value->buyerUser->userProfile->icon)
                                                                    <p class="ico"><img src="{{ asset('/storage/'.$value->buyerUser->userProfile->icon) }}" alt="" style="width: 40px;max-height: 40px;object-fit: cover;border-radius: 50%;"></p>
                                                                @else
                                                                    <p class="ico"><img src="/img/mypage/no_image.jpg" alt="" style="width: 40px;height: 40px;object-fit: cover;border-radius: 50%;"></p>
                                                                @endif
                                                                <div class="introd">
                                                                    <p class="name">{{$value->buyerUser->name}}</p>
                                                                    <p>({{App\Models\UserProfile::GENDER[$value->buyerUser->userProfile->gender]}}/ {{$value->buyerUser->userProfile->birthday}}/ {{$value->buyerUser->userProfile->prefecture->name}})</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="evaluate three"></div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif  
                                    </ul>
								{{ $active_job_request_chatrooms->fragment('job-request')->links() }}
						        </div>
						    </div>
					    </div>
				    </div><!-- /#main -->
                    <x-side-menu/>
                </div><!--inner-->
            </div><!-- /#contents -->
		<x-hide-modal/>
	</body>
</article>
</x-layout>