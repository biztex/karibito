@if(null !== $message->user->userProfile->icon)
    <a href="{{ route('user.mypage', $message->user_id) }}" class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt=""></a>
@else
    <a href="{{ route('user.mypage', $message->user_id) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
@endif