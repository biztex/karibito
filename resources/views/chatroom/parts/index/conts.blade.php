<div class="conts">
    @if($value->purchased_reference_type === 'App\Models\PurchasedProduct')
        <div class="cont01">
            @if(isset($value->referencePurchased->productImage[0]))
                <p class="img"><img src="{{ asset('/storage/'.$value->referencePurchased->productImage[0]->path)}}" alt=""></p>
            @else
                <p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
            @endif
            <div class="info">
                <div class="breadcrumb"><a tabindex="0">{{$value->referencePurchased->mProductChildCategory->mProductCategory->name}}</a> ＞ <span>{{$value->referencePurchased->mProductChildCategory->name}}</span></div>
                <div class="draw">
                    <p class="price word-break"><font>{{$value->referencePurchased->title}}</font><br>{{ number_format($value->referencePurchased->price)}}円</p>
                </div>
                <div class="single">
                    <span tabindex="0">{{App\Models\Product::IS_ONLINE[$value->referencePurchased->is_online]}}</span>
                    <div class="chat_log">
                        更新日時:{{$value->chatroomMessages->last()->created_at->format('Y-m-d H:i');}}
                    </div>
                </div>
            </div>
        </div>
    @elseif($value->purchased_reference_type === 'App\Models\PurchasedJobRequest')
        <div class="cont01">
            <p class="img"><img src="/img/common/img_request@2x.jpg" alt=""></p>
            <div class="info">
                <div class="breadcrumb"><a tabindex="0">{{$value->referencePurchased->mProductChildCategory->mProductCategory->name}}</a> ＞ <span>{{$value->referencePurchased->mProductChildCategory->name}}</span></div>
                <div class="draw">
                    <p class="price word-break"><font>{{$value->referencePurchased->title}}</font><br>{{ number_format($value->referencePurchased->price)}}円</p>
                </div>
                <div class="single">
                    <span tabindex="0">{{App\Models\JobRequest::IS_ONLINE[$value->referencePurchased->is_online]}}</span>
                    <div class="chat_log">
                        更新日時:{{$value->chatroomMessages->last()->created_at->format('Y-m-d H:i');}}
                    </div>
                </div>
            </div>
        </div>
    @elseif($value->reference === null)
        <div class="cont01">
            <p class="price word-break" style="padding-left:15px;"><font>このサービスは削除されました</font><br></p>
        </div>
    @elseif($value->reference_type === 'App\Models\Product')
        <div class="cont01">
            @if(isset($value->reference->productImage[0]))
                <p class="img"><img src="{{ asset('/storage/'.$value->reference->productImage[0]->path)}}" alt=""></p>
            @else
                <p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
            @endif
            <div class="info">
                <div class="breadcrumb"><a tabindex="0">{{$value->reference->mProductChildCategory->mProductCategory->name}}</a> ＞ <span>{{$value->reference->mProductChildCategory->name}}</span></div>
                <div class="draw">
                    <p class="price word-break"><font>{{$value->reference->title}}</font><br>{{ number_format($value->reference->price)}}円</p>
                </div>
                <div class="single">
                    <span tabindex="0">{{App\Models\Product::IS_ONLINE[$value->reference->is_online]}}</span>
                    <div class="chat_log">
                        更新日時:{{$value->chatroomMessages->last()->created_at->format('Y-m-d H:i');}}
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="cont01">
            <p class="img"><img src="/img/common/img_request@2x.jpg" alt=""></p>
            <div class="info">
                <div class="breadcrumb"><a tabindex="0">{{$value->reference->mProductChildCategory->mProductCategory->name}}</a> ＞ <span>{{$value->reference->mProductChildCategory->name}}</span></div>
                <div class="draw">
                    <p class="price word-break"><font>{{$value->reference->title}}</font><br>{{ number_format($value->reference->price)}}円</p>
                </div>
                <div class="single">
                    <span tabindex="0">{{App\Models\JobRequest::IS_ONLINE[$value->reference->is_online]}}</span>
                    <div class="chat_log">
                        更新日時:{{$value->chatroomMessages->last()->created_at->format('Y-m-d H:i');}}
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="cont02">
        @if($value->buyerUser->id === Auth::id())
            <div class="user">
                @if(null !== $value->sellerUser->userProfile->icon)
                    @if(empty($value->sellerUser->deleted_at))
                        <a href="{{ route('user.mypage', $value->seller_user_id) }}" class="ico"><img src="{{ asset('/storage/'.$value->sellerUser->userProfile->icon) }}" alt=""></a>
                    @else
                        <span class="ico"><img src="{{ asset('/storage/'.$value->sellerUser->userProfile->icon) }}" alt=""></span>
                    @endif
                @else
                    @if(empty($value->sellerUser->deleted_at))
                        <a href="{{ route('user.mypage', $value->seller_user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                    @else
                        <span class="ico"><img src="/img/mypage/no_image.jpg" alt=""></span>
                    @endif
                @endif
                <div class="introd">
                        <p class="name word-break">{{$value->sellerUser->name}}</p>
                        @if(isset($value->sellerUser->deleted_at))
                            <p class="name">退会したユーザーです。</p>
                        @endif
                        <p>({{App\Models\UserProfile::GENDER[$value->sellerUser->userProfile->gender]}}/ {{$value->sellerUser->userProfile->age}}/ {{$value->sellerUser->userProfile->prefecture->name}})</p>
                </div>
            </div>
            @if(isset($value->sellerUser))
              <x-parts.evaluation-star :star='$value->sellerUser->avg_star'/>
            @endif
        @else
            <div class="user">
                @if(null !== $value->buyerUser->userProfile->icon)
                    @if(empty($value->buyerUser->deleted_at))
                        <a href="{{ route('user.mypage', $value->buyer_user_id) }}" class="ico"><img src="{{ asset('/storage/'.$value->buyerUser->userProfile->icon) }}" alt=""></a>
                    @else
                        <span class="ico"><img src="{{ asset('/storage/'.$value->buyerUser->userProfile->icon) }}" alt=""></span>
                    @endif
                @else
                    @if(empty($value->buyerUser->deleted_at))
                        <a href="{{ route('user.mypage', $value->buyer_user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                    @else
                        <span class="ico"><img src="/img/mypage/no_image.jpg" alt=""></span>
                    @endif
                @endif
                <div class="introd">
                    <p class="name word-break">{{$value->buyerUser->name}}</p>
                    @if(isset($value->buyerUser->deleted_at))
                        <p class="name">退会したユーザーです。</p>
                    @endif
                    <p>({{App\Models\UserProfile::GENDER[$value->buyerUser->userProfile->gender]}}/ {{$value->buyerUser->userProfile->age}}/ {{$value->buyerUser->userProfile->prefecture->name}})</p>
                </div>
            </div>
            <x-parts.evaluation-star :star='$value->buyerUser->avg_star'/>
        @endif
    </div>
</div>
