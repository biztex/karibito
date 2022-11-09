<aside id="side" class="">
    <div class="box seller">
        <h3>スキル出品者</h3>
        @if(null !== $user->userProfile->icon)
            @if(empty($user->deleted_at))
                <a href="{{ route('user.mypage', $user->id) }}" class="head"><img src="{{ asset('/storage/'.$user->userProfile->icon) }}" alt=""></a>
            @else
                <span class="head"><img src="{{ asset('/storage/'.$user->userProfile->icon) }}" alt=""></span>
            @endif
        @else
            @if(empty($user->deleted_at))
                <a href="{{ route('user.mypage', $user->id) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
            @else
                <span class="head"><img src="/img/mypage/no_image.jpg" alt=""></span>
            @endif
        @endif
        <p class="login">最終ログイン：{{ $user->latest_login_datetime }}</p>

        <p class="introd"><span>{{$user->name}}</span><br>({{\App\Models\UserProfile::GENDER[$user->userProfile->gender]}}/ {{ $user->userProfile->age }}/ {{$user->userProfile->prefecture->name}})</p>

        <x-parts.evaluation-star :star='$user->avg_star'/>

        @if(Auth::user()->userProfile->is_identify == 1)
            <a>本人確認済み</a>
        @endif
        @if (\Auth::id() !== $user->id)
            @if(empty($user->deleted_at))
                <div class="blogDtOtherBtn">
                    @if(\Auth::user())
                        @if(App\Models\UserFollow::IsFollowing($user->id))
                            <a href="{{ route('follow.sub', ['id' => $user->id]) }}" class="followB" onclick='return confirm("フォローを解除しますか？");'>フォロー済み</a>
                        @else
                            <a href="{{ route('follow.add', ['id' => $user->id]) }}" class="followA">フォローする</a>
                        @endif
                    @else
                        <a href="{{ route('follow.add', ['id' => $user->id]) }}" class="followA">フォローする</a>
                    @endif
                    @if(empty($dmrooms))
                        <a href="{{ route('dm.create',$user->id) }}">メッセージを送る</a>
                    @else
                        <a href="{{ route('dm.show',$dmrooms->id) }}">メッセージを送る</a>
                    @endif
                </div>
            @endif
        @endif
    </div>
</aside><!-- /#side -->
