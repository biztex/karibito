@if($value->referencePurchased !== null)
    <li>
        <div class="cont01">
            <p class="img"><img src="/img/common/img_request@2x.jpg" alt=""></p>
            <div class="info">
                <div class="breadcrumb">
                    <a href="{{ route('job_request.category.index',$value->referencePurchased->mProductChildCategory->mProductCategory->id) }}">
                        {{ $value->referencePurchased->mProductChildCategory->mProductCategory->name}}</a>&emsp;＞&emsp;
                    <a href="{{ route('job_request.category.index.show',$value->referencePurchased->mProductChildCategory->id)}}">
                        {{ $value->referencePurchased->mProductChildCategory->name }}</a>
                </div>
                <div class="draw">
                    <p class="price"><font>{{$value->referencePurchased->title}}</font><br>{{ number_format($value->referencePurchased->price)}}円</p>
                </div>
                <div class="single">
                    <a tabindex="0">{{App\Models\JobRequest::IS_ONLINE[$value->referencePurchased->is_online]}}</a>
                </div>
            </div>
            <p class="link"><a href="{{ route('chatroom.show', $value->id)  }}">チャット</a></p>
        </div>
        <div class="cont02">
            @if($value->buyerUser->id === Auth::id())
                <div class="user">
                    @if(null !== $value->sellerUser->userProfile->icon)
                        <a href="{{ route('user.mypage', $value->seller_user_id) }}" class="ico"><img src="{{ asset('/storage/'.$value->sellerUser->userProfile->icon) }}" alt=""></a>
                    @else
                        <a href="{{ route('user.mypage', $value->seller_user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                    @endif
                    <div class="introd">
                            <p class="name">{{$value->sellerUser->name}}</p>
                            <p>({{App\Models\UserProfile::GENDER[$value->sellerUser->userProfile->gender]}}/ {{$value->sellerUser->userProfile->age}}/ {{$value->sellerUser->userProfile->prefecture->name}})</p>
                    </div>
                </div>
                <x-parts.evaluation-star :star='$value->sellerUser->avg_star'/>
            @else
                <div class="user">
                    @if(null !== $value->buyerUser->userProfile->icon)
                        <a href="{{ route('user.mypage', $value->buyer_user_id) }}" class="ico"><img src="{{ asset('/storage/'.$value->buyerUser->userProfile->icon) }}" alt=""></a>
                    @else
                        <a href="{{ route('user.mypage', $value->buyer_user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                    @endif
                    <div class="introd">
                        <p class="name">{{$value->buyerUser->name}}</p>
                        <p>({{App\Models\UserProfile::GENDER[$value->buyerUser->userProfile->gender]}}/ {{$value->buyerUser->userProfile->age}}/ {{$value->buyerUser->userProfile->prefecture->name}})</p>
                    </div>
                </div>
                <x-parts.evaluation-star :star='$value->buyerUser->avg_star'/>
            @endif
        </div>
    </li>

@elseif($value->reference === null)
    <li>
        <div class="cont01">
            <p class="price word-break" style="padding:15px;"><font>削除された商品</font><br></p>

            <p class="link"><a href="{{ route('chatroom.show', $value->id)  }}">チャット</a></p>
        </div>
        <div class="cont02">
            @if($value->buyerUser->id === Auth::id())
                <div class="user">
                    @if(null !== $value->sellerUser->userProfile->icon)
                        <a href="{{ route('user.mypage', $value->seller_user_id) }}" class="ico"><img src="{{ asset('/storage/'.$value->sellerUser->userProfile->icon) }}" alt=""></a>
                    @else
                        <a href="{{ route('user.mypage', $value->seller_user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                    @endif
                    <div class="introd">
                            <p class="name">{{$value->sellerUser->name}}</p>
                            <p>({{App\Models\UserProfile::GENDER[$value->sellerUser->userProfile->gender]}}/ {{$value->sellerUser->userProfile->age}}/ {{$value->sellerUser->userProfile->prefecture->name}})</p>
                    </div>
                </div>
                <x-parts.evaluation-star :star='$value->sellerUser->avg_star'/>
            @else
                <div class="user">
                    @if(null !== $value->buyerUser->userProfile->icon)
                        <a href="{{ route('user.mypage', $value->buyer_user_id) }}" class="ico"><img src="{{ asset('/storage/'.$value->buyerUser->userProfile->icon) }}" alt=""></a>
                    @else
                        <a href="{{ route('user.mypage', $value->buyer_user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                    @endif
                    <div class="introd">
                        <p class="name">{{$value->buyerUser->name}}</p>
                        <p>({{App\Models\UserProfile::GENDER[$value->buyerUser->userProfile->gender]}}/ {{$value->buyerUser->userProfile->age}}/ {{$value->buyerUser->userProfile->prefecture->name}})</p>
                    </div>
                </div>
                <x-parts.evaluation-star :star='$value->buyerUser->avg_star'/>
            @endif
        </div>
    </li>
@else
    <li>
        <div class="cont01">
            <div class="info">
                <div class="breadcrumb">
                    <a href="{{ route('job_request.category.index',$value->reference->mProductChildCategory->mProductCategory->id) }}">
                        {{ $value->reference->mProductChildCategory->mProductCategory->name}}</a>&emsp;＞&emsp;
                    <a href="{{ route('job_request.category.index.show',$value->reference->mProductChildCategory->id)}}">
                        {{ $value->reference->mProductChildCategory->name }}</a>
                </div>
                <div class="draw">
                    <p class="price"><font>{{$value->reference->title}}</font><br>{{ number_format($value->reference->price)}}円</p>
                </div>
                <div class="single">
                    <a tabindex="0">{{App\Models\JobRequest::IS_ONLINE[$value->reference->is_online]}}</a>
                </div>
            </div>
            <p class="link"><a href="{{ route('chatroom.show', $value->id)  }}">チャット</a></p>
        </div>
        <div class="cont02">
            @if($value->buyerUser->id === Auth::id())
                <div class="user">
                    @if(null !== $value->sellerUser->userProfile->icon)
                        <a href="{{ route('user.mypage', $value->seller_user_id) }}" class="ico"><img src="{{ asset('/storage/'.$value->sellerUser->userProfile->icon) }}" alt=""></a>
                    @else
                        <a href="{{ route('user.mypage', $value->seller_user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                    @endif
                    <div class="introd">
                            <p class="name">{{$value->sellerUser->name}}</p>
                            <p>({{App\Models\UserProfile::GENDER[$value->sellerUser->userProfile->gender]}}/ {{$value->sellerUser->userProfile->age}}/ {{$value->sellerUser->userProfile->prefecture->name}})</p>
                    </div>
                </div>
                <x-parts.evaluation-star :star='$value->sellerUser->avg_star'/>
            @else
                <div class="user">
                    @if(null !== $value->buyerUser->userProfile->icon)
                        <a href="{{ route('user.mypage', $value->buyer_user_id) }}" class="ico"><img src="{{ asset('/storage/'.$value->buyerUser->userProfile->icon) }}" alt=""></a>
                    @else
                        <a href="{{ route('user.mypage', $value->buyer_user_id) }}" class="ico"><img src="/img/mypage/no_image.jpg" alt=""></a>
                    @endif
                    <div class="introd">
                        <p class="name">{{$value->buyerUser->name}}</p>
                        <p>({{App\Models\UserProfile::GENDER[$value->buyerUser->userProfile->gender]}}/ {{$value->buyerUser->userProfile->age}}/ {{$value->buyerUser->userProfile->prefecture->name}})</p>
                    </div>
                </div>
                <x-parts.evaluation-star :star='$value->buyerUser->avg_star'/>
            @endif
        </div>
    </li>
@endif