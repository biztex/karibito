<li>
    <div class="evaluationIcon img">
        @if(null !== $value->user->userProfile->icon)
            <p class="head"><img src="{{ asset('/storage/'.$value->user->userProfile->icon) }}" alt=""></p>
        @else
            <p class="head"><img src="/img/mypage/no_image.jpg" alt=""></p>
        @endif
    </div>
    <div class="info">
        <p class="name">{{ $value->user->name }}</p>
        <div class="cont">
            <p class="date">{{ $value->created_at->format('Y年m月d日') }}</p>
            <p class="txt" style="word-wrap: break-word;">{!!nl2br($value->text)!!}</p>
        </div>
    </div>
</li>