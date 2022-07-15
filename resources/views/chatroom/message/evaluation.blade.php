<!-- 評価完了メッセージ-->
<!-- 提供者評価前-->
@if($chatroom->status === 5)

    <!-- 購入者側の時 -->
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
                        <p class="buy none"><input type="submit" value="お相手の評価をお待ちください" disabled></p>
                    </div>
                </div>
            </div>
        </li>

    <!-- 出品者側の時 -->
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
                        <p class="buy"><a href="{{route('chatroom.evaluation',$chatroom->id)}}" class="red">お相手を評価する</a></p>
                    </div>
                </div>
            </div>
            <p class="time">既読 2021年7月26日9:10</p>
        </li>
    @endif

<!-- 両者評価完了後 -->
@elseif($chatroom->status === 6)
    @if($message->user_id === $chatroom->seller_user_id)
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
                </div>
            </div>
        </li>

    @elseif($message->user_id === Auth::id() && $chatroom->buyer_user_id === Auth::id())
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
                        <p class="buy none"><input type="submit" value="お相手の評価をお待ちください" disabled></p>
                    </div>
                </div>
            </div>
        </li>
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
                        <p class="buy none"><input type="submit" value="お相手を評価する" disabled></p>
                    </div>
                </div>
            </div>
        </li>
    @endif
@endif