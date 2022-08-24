@if($partner === $chatroom->sellerUser && $chatroom->reference_type === 'App\Models\Product')
    <!-- 提供・出品者情報 -->
    <div class="friendsTop">
        <div class="sellerTop">
            <div class="user">
                @if(null !== $partner->userProfile->icon)
                    <a href="{{ route('user.mypage', $partner->id) }}" class="head"><img src="{{ asset('/storage/'.$partner->userProfile->icon) }}" alt=""></a>
                @else
                    <a href="{{ route('user.mypage', $partner->id) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
                @endif
                <div class="info">
                    <p class="name">出品者・{{ $partner->name }}</p>
                    <p><a href="{{ route('user.skills', $partner->id) }}" class="link">職務経歴書を見る</a></p>
                </div>
            </div>
            <p class="login">最終ログイン：{{ $partner->latest_login_datetime }}</p>
        </div>

        @include('chatroom.parts.show.partner-tell')

    </div>

@elseif($partner === $chatroom->buyerUser && $chatroom->reference_type === 'App\Models\JobRequest')
    <!-- リクエスト・掲載者情報 -->
    <div class="friendsTop">
        <div class="sellerTop">
            <div class="user">
                @if(null !== $partner->userProfile->icon)
                    <a href="{{ route('user.mypage', $partner->id) }}" class="head"><img src="{{ asset('/storage/'.$partner->userProfile->icon) }}" alt=""></a>
                @else
                    <a href="{{ route('user.mypage', $partner->id) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
                @endif
                <div class="info">
                    <p class="name">掲載者・{{ $partner->name }}</p>
                    <p><a href="{{ route('user.skills', $partner->id) }}" class="link">職務経歴書を見る</a></p>
                </div>
            </div>
            <p class="login">最終ログイン：{{ $partner->latest_login_datetime }}</p>
        </div>

        @include('chatroom.parts.show.partner-tell')

    </div>
@else
    <!-- 購入者情報 -->
    <div class="friendsTop">
        <div class="sellerTop">
            <div class="user">
                @if(null !== $partner->userProfile->icon)
                    <a href="{{ route('user.mypage', $partner->id) }}" class="head"><img src="{{ asset('/storage/'.$partner->userProfile->icon) }}" alt=""></a>
                @else
                    <a href="{{ route('user.mypage', $partner->id) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
                @endif
                <div class="info">
                    <p class="name">{{$partner->name}}</p>
                </div>
            </div>
            <p class="login">最終ログイン：{{ $partner->latest_login_datetime }}</p>
        </div>

        @include('chatroom.parts.show.partner-tell')

    </div>
    
@endif