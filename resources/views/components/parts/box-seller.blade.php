<div class="box seller">
    <h3>スキル出品者</h3>
        @if(empty($user->userProfile->icon))
            <a href="{{ route('user.mypage', $user) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
        @else
            <a href="{{ route('user.mypage', $user) }}" class="head"><img src={{asset('/storage/'.$user->userProfile->icon) }} alt=""></a>
        @endif
    <!-- <p class="login">最終ログイン：8時間前</p> -->
    <p class="introd"><a href="{{ route('user.mypage', $user) }}" class="name">{{$user->name}}</a><br>({{App\Models\UserProfile::GENDER[$user->userProfile->gender]}} / {{$user->userProfile->age}}/ {{$user->userProfile->prefecture->name}})</p>

    <x-parts.evaluation-star :star='$user->avg_star'/>

</div>