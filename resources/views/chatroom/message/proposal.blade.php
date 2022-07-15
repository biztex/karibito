<!-- 提案メッセージ -->
<!-- 未購入状態 -->
@if($message->reference->is_purchase === 0)
    <!-- 提案者の時 -->
    @if($message->user_id === Auth::id())
        <li>
            <div class="img">
                @if(null !== $message->user->userProfile->icon)
                    <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @else
                    <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="tit">{{$chatroom->reference->title}}<p>
                        <p>提供価格：¥{{ number_format($chatroom->proposal->price) }}</p>
                        <p class="buy"><input type="submit" value="購入されていません" disabled></p>
                    </div>
                </div>
            </div>
        </li>
    <!-- 購入者の時 -->
    @else
        <li>
            <div class="img">
                @if(null !== $message->user->userProfile->icon)
                    <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @else
                    <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="tit">{{$chatroom->reference->title}}</p>
                        <p>提供価格：¥{{ number_format($chatroom->proposal->price) }}</p>
                        <p class="buy"><a href="{{route('chatroom.purchase', $message->reference->id)}}">購入する</a></p>
                    </div>
                </div>
            </div>
        </li>
    @endif

<!-- 購入済 状態-->
@else
    <!-- 提案者の時 -->
    @if($message->user_id === Auth::id())
        <li>
            <div class="img">
                @if(null !== $message->user->userProfile->icon)
                    <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @else
                    <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="tit">{{$chatroom->reference->title}}<p>
                        <p>提供価格：¥{{ number_format($chatroom->proposal->price) }}</p>
                        <p class="buy"><input type="submit" value="購入されました" disabled></p>
                    </div>
                </div>
            </div>
        </li>

    <!-- 購入者の時-->
    @else
        <li>
            <div class="img">
                @if(null !== $message->user->userProfile->icon)
                    <p style="width: 50px;height: 50px;"  class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @else
                    <p style="width: 50px;height: 50px;"  class="head"><img src="/img/mypage/no_image.jpg" alt="" style="width: 50px;height: 50px;object-fit: cover;"></p>
                @endif
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="tit">{{$chatroom->reference->title}}</p>
                        <p>提供価格：¥{{ number_format($chatroom->proposal->price) }}</p>
                        <p class="buy"><input type="submit" class="white" value="購入済み"></p>
                    </div>
                </div>
            </div>
        </li>
    @endif

@endif