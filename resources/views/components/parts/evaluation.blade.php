<li>
    <div class="evaluationIcon img">
        @if(null !== $value->user->userProfile->icon)
            <a href="{{ route('user.mypage', $value->user_id) }}" class="head"><img src="{{ asset('/storage/'.$value->user->userProfile->icon) }}" alt=""></a>
        @else
            <a href="{{ route('user.mypage', $value->user_id) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
        @endif
    </div>
    <div class="info">
        <p class="name">{{ $value->user->name }}<span>@if($value->user_id === $value->chatroom->seller_user_id)出品者@else 購入者@endif</span></p>
        <div class="cont">
            <p class="date">{{ $value->created_at->format('Y年m月d日') }}</p>
            <p class="txt" style="word-wrap: break-word;">{!!nl2br($value->text)!!}</p>
        </div>
    </div>
</li>