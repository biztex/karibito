@if($partner === $chatroom->sellerUser && $chatroom->reference_type === 'App\Models\Product')
    <!-- 提供・出品者情報 -->
    <div class="friendsTop">
        <div class="sellerTop">
            <div class="user">
                @if(null !== $chatroom->sellerUser->userProfile->icon)
                    <p class="head"><img src="{{ asset('/storage/'.$chatroom->sellerUser->userProfile->icon) }}" alt="" style="width: 50px;max-height: 50px;object-fit: cover;border-radius: 50px;"></p>
                @else
                    <p class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
                <div class="info">
                    <p class="name">出品者・{{ $chatroom->sellerUser->name }}</p>
                    <p><a href="#" class="link">職務経歴書を見る</a></p>
                </div>
            </div>
            <p class="login">最終ログイン：オンライン中</p>
        </div>
    </div>

@elseif($partner === $chatroom->buyerUser && $chatroom->reference_type === 'App\Models\JobRequest')
    <!-- リクエスト・掲載者情報 -->
    <div class="friendsTop">
        <div class="sellerTop">
            <div class="user">
                @if(null !== $chatroom->buyerUser->userProfile->icon)
                    <p class="head"><img src="{{ asset('/storage/'.$chatroom->buyerUser->userProfile->icon) }}" alt="" style="width: 50px;max-height: 50px;object-fit: cover;border-radius: 50px;"></p>
                @else
                    <p class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
                <div class="info">
                    <p class="name">掲載者・{{ $chatroom->buyerUser->name }}</p>
                    <p><a href="#" class="link">職務経歴書を見る</a></p>
                </div>
            </div>
            <p class="login">最終ログイン：オンライン中</p>
        </div>
    </div>
@else
    <!-- 購入者情報 -->
    <div class="friendsTop">
        <div class="sellerTop">
            <div class="user">
                <p class="head"><img src="/img/service/ico_head.png" alt=""></p>
                <div class="info">
                    <p class="name">{{$partner->name}}</p>
                </div>
            </div>
            <p class="login">最終ログイン：オンライン中</p>
        </div>
    </div>
@endif