@if(null !== $message->user->userProfile->icon)
    @if(empty($message->user->deleted_at))
        <a href="{{ route('user.mypage', $message->user_id) }}" class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt=""></a>
    @else
        <span class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt=""></span>
    @endif
@else
    @if(empty($message->user->deleted_at))
        <a href="{{ route('user.mypage', $message->user_id) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
    @else
        <span class="head"><img src="/img/mypage/no_image.jpg" alt=""></span>
    @endif
@endif