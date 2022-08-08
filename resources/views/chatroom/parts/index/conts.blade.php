<div class="conts">
    @if($value->reference_type === 'App\Models\Product')
        <div class="cont01">
            @if(isset($value->reference->productImage[0]))
                <p class="img"><img src="{{ asset('/storage/'.$value->reference->productImage[0]->path)}}" alt=""></p>
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
        @if($value->buyerUser->id === Auth::id())
            <div class="user">
                @if(null !== $value->sellerUser->userProfile->icon)
                    <p class="ico"><img src="{{ asset('/storage/'.$value->sellerUser->userProfile->icon) }}" alt=""></p>
                @else
                    <p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
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
                    <p class="ico"><img src="{{ asset('/storage/'.$value->buyerUser->userProfile->icon) }}" alt=""></p>
                @else
                    <p class="ico"><img src="/img/mypage/no_image.jpg" alt=""></p>
                @endif
                <div class="introd">
                    <p class="name">{{$value->buyerUser->name}}</p>
                    <p>({{App\Models\UserProfile::GENDER[$value->buyerUser->userProfile->gender]}}/ {{$value->buyerUser->userProfile->age}}/ {{$value->buyerUser->userProfile->prefecture->name}})</p>
                </div>
            </div>
            <x-parts.evaluation-star :star='$value->buyerUser->avg_star'/>
        @endif
    </div>
</div>