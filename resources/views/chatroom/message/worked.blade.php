<!-- 作業報告メッセージ -->
<!-- 購入者 評価前 -->
@if($chatroom->status === 4)
    <!-- 購入者側の時 相手を評価するボタン-->
    @if($message->user_id !== Auth::id()) 
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
                        <p class="buy"><a href="{{ route('chatroom.evaluation',$chatroom->id) }}" class="red">お相手を評価する</a></p>
                    </div>
                </div>
            </div>
        </li>

    <!-- 提供者側の時 相手の評価待ち -->
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
                        <p class="buy"><input type="submit" value="お相手の評価をお待ちください" disabled></p>
                    </div>
                </div>
            </div>
        </li>
    @endif

<!-- 作業完了報告 購入者評価後-->
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
                </div>
            </div>
        </div>
    </li>
@endif