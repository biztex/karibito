<!-- 提案メッセージ -->
<!-- 未購入状態 -->
@if($message->reference->is_purchase === 0)
    <!-- 提案者の時 -->
    @if($message->user_id === Auth::id())
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
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
	        @include('chatroom.message.parts.time')
        </li>
    <!-- 購入者の時 -->
    @else
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
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
	        @include('chatroom.message.parts.time')
        </li>
    @endif

<!-- 購入済 状態-->
@else
    <!-- 提案者の時 -->
    @if($message->user_id === Auth::id())
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
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
	        @include('chatroom.message.parts.time')
        </li>

    <!-- 購入者の時-->
    @else
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
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
	        @include('chatroom.message.parts.time')
        </li>
    @endif

@endif