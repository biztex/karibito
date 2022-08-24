<!-- 掲載者情報 -->
<div class="friendsTop">
    <div class="sellerTop">
            <div class="user">
                @if(null !== $service->user->userProfile->icon)
                    <a href="{{ route('user.mypage', $service->user_id) }}" class="head"><img src="{{ asset('/storage/'.$service->user->userProfile->icon) }}" alt=""></a>
                @else
                    <a href="{{ route('user.mypage', $service->user_id) }}"p class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
                @endif
                <div class="info">
                    @if($service_type === 'Product')
                        <p class="name">出品者・{{ $service->user->name }}</p>
                        <p><a href="{{ route('user.skills', $service->user_id) }}" class="link">職務経歴書を見る</a></p>
                    @else <!-- JobRequest-->
                        <p class="name">掲載者・{{ $service->user->name }}</p>
                    @endif
                </div>
            </div>
        <p class="login">最終ログイン：{{ $service->user->latest_login_datetime }}</p>
    </div>
</div>