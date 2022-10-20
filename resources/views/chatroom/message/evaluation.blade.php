<!-- 評価完了メッセージ-->
<!-- 提供者評価前-->
@if($chatroom->status === App\Models\Chatroom::STATUS_SELLER_EVALUATION)

    <!-- 購入者側の時 -->
    @if($message->user_id === Auth::id())
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="buy none"><input type="submit" value="お相手の評価をお待ちください" disabled></p>
                    </div>
                </div>
            </div>
	        @include('chatroom.message.parts.time')
        </li>

    <!-- 出品者側の時 -->
    @else
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="buy"><a href="{{route('chatroom.get.seller.evaluation',$chatroom->id)}}" class="red">これまでのお取引の評価を入力する</a></p>
                    </div>
                </div>
            </div>
	        @include('chatroom.message.parts.time')
        </li>
    @endif

<!-- 両者評価完了後 -->
@elseif($chatroom->status === App\Models\Chatroom::STATUS_COMPLETE)
    @if($message->user_id === $chatroom->seller_user_id)
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>{{$message->text}}</p>
                </div>
            </div>
	        @include('chatroom.message.parts.time')
        </li>

    @elseif($message->user_id === Auth::id() && $chatroom->buyer_user_id === Auth::id())
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="buy none"><input type="submit" value="お相手の評価をお待ちください" disabled></p>
                    </div>
                </div>
            </div>
	        @include('chatroom.message.parts.time')
        </li>
    @else
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="buy none"><input type="submit" value="これまでのお取引の評価を入力する" disabled></p>
                    </div>
                </div>
            </div>
	        @include('chatroom.message.parts.time')
        </li>
    @endif
@endif