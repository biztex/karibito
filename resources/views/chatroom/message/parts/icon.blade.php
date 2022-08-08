@if(null !== $message->user->userProfile->icon)
    <p  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt=""></p>
@else
    <p  class="head"><img src="/img/mypage/no_image.jpg" alt=""></p>
@endif