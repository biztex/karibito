<div class="tabBox is_active" id="tab_box01">
    <ul class="favoriteUl01 exchangeChat">
        @if($active_chatrooms->isEmpty())
            <p style="margin:20px;">進行中のやり取りはありません。</p>
        @else
            @foreach($active_chatrooms as $value)
                <li>
                    <x-parts.chatroom-step :value="$value"/>

                    <div class="conts">
                        @if($value->reference_type === 'App\Models\Product')
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
                        @else
                            <div class="cont01">
                                <p class="img"><img src="/img/common/img_request@2x.jpg" alt=""></p>
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
                        @endif
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
                        @if($value->reference_type === 'App\Models\Product')
                            <a href="{{route('product.show', $value->reference_id)}}" class="blue_o">チケット詳細</a>
                        @else
                            <a href="{{route('job_request.show', $value->reference_id)}}" class="blue_o">チケット詳細</a>
                        @endif
                        <a href="{{route('chatroom.show', $value->id)}}" class="green">チャットを開始</a>
                    </div>
                </li>
            @endforeach
        @endif
    </ul>
    {{ $active_chatrooms->fragment('')->links() }}
</div>