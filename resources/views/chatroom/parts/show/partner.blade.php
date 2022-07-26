@if($partner === $chatroom->sellerUser && $chatroom->reference_type === 'App\Models\Product')
    <!-- 提供・出品者情報 -->
    <div class="friendsTop">
        <div class="sellerTop">
            <div class="user">
                @if(null !== $partner->userProfile->icon)
                    <p class="head"><img src="{{ asset('/storage/'.$partner->userProfile->icon) }}" alt="" style="width: 50px;max-height: 50px;object-fit: cover;border-radius: 50px;"></p>
                @else
                    <p class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
                <div class="info">
                    <p class="name">出品者・{{ $partner->name }}</p>
                    <p><a href="#" class="link">職務経歴書を見る</a></p>
                </div>
            </div>
            <p class="login">最終ログイン：オンライン中</p>
        </div>
        @if($chatroom->reference->is_call ===  1 && $chatroom->canCall())
            <div class="tellTop">
                <div class="support">
                    <span class="pre">電話対応：{{App\Models\UserProfile::CALL_STATUS[$partner->userProfile->can_call]}}</span>
                    <span class="fix">「待機中」のみ着信可能です</span>
                </div>
                @if($partner->userProfile->can_call === App\Models\UserProfile::CAN_CALL )
                    <div class="functeBtns">
                        <a href="tel:{{$partner->tel}}" class="full blue">電話をかける</a>
                    </div>
                @endif
            </div>
        @endif
    </div>

@elseif($partner === $chatroom->buyerUser && $chatroom->reference_type === 'App\Models\JobRequest')
    <!-- リクエスト・掲載者情報 -->
    <div class="friendsTop">
        <div class="sellerTop">
            <div class="user">
                @if(null !== $partner->userProfile->icon)
                    <p class="head"><img src="{{ asset('/storage/'.$partner->userProfile->icon) }}" alt="" style="width: 50px;max-height: 50px;object-fit: cover;border-radius: 50px;"></p>
                @else
                    <p class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
                <div class="info">
                    <p class="name">掲載者・{{ $partner->name }}</p>
                    <p><a href="#" class="link">職務経歴書を見る</a></p>
                </div>
            </div>
            <p class="login">最終ログイン：オンライン中</p>
        </div>
        @if($chatroom->reference->is_call === 1 && $chatroom->canCall())
            <div class="tellTop">
                <div class="support">
                    <span class="pre">電話対応：{{App\Models\UserProfile::CALL_STATUS[$partner->userProfile->can_call]}}</span>
                    <span class="fix">「待機中」のみ着信可能です</span>
                </div>
                @if($partner->userProfile->can_call === App\Models\UserProfile::CAN_CALL)
                    <div class="functeBtns">
                        <a href="tel:{{$partner->tel}}" class="full blue">電話をかける</a>
                    </div>
                @endif
            </div>
        @endif
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
        @if($chatroom->reference->is_call === 1 && $chatroom->canCall())
            <div class="tellTop">
                <div class="support">
                    <span class="pre">電話対応：{{App\Models\UserProfile::CALL_STATUS[$partner->userProfile->can_call]}}</span>
                    <span class="fix">「待機中」のみ着信可能です</span>
                </div>
                @if($partner->userProfile->can_call === App\Models\UserProfile::CAN_CALL)
                    <div class="functeBtns">
                        <a href="tel:{{$partner->tel}}" class="full blue">電話をかける</a>
                    </div>
                @endif
            </div>
        @endif
    </div>
@endif