<!-- 掲載者情報 -->
<div class="friendsTop">
    <div class="sellerTop">
            <div class="user">
                @if(null !== $service->user->userProfile->icon)
                    <p class="head"><img src="{{ asset('/storage/'.$service->user->userProfile->icon) }}" alt="" style="width: 50px;max-height: 50px;object-fit: cover;border-radius: 50px;"></p>
                @else
                    <p class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
                <div class="info">
                    @if($service_type === 'Product')
                        <p class="name">出品者・{{ $service->user->name }}</p>
                    @else <!-- JobRequest-->
                        <p class="name">掲載者・{{ $service->user->name }}</p>
                    @endif
                    <p><a href="#" class="link">職務経歴書を見る</a></p>
                </div>
            </div>
        <p class="login">最終ログイン：オンライン中</p>
    </div>
</div>