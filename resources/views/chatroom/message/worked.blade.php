<!-- 作業報告メッセージ -->
<!-- 購入者 評価前 -->
@if($chatroom->status === App\Models\Chatroom::STATUS_BUYER_EVALUATION)
    <!-- 購入者側の時 相手を評価するボタン-->
    @if($message->user_id !== Auth::id()) 
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="tit">{{$chatroom->referencePurchased->title}}</p>
                        <p>提供価格：¥{{ number_format($chatroom->purchase->proposal->price) }}</p>
                        <p class="buy"><a href="{{ route('chatroom.get.buyer.evaluation',$chatroom->id) }}" class="red">お相手を評価する</a></p>
                    </div>
                </div>
            </div>
	        @include('chatroom.message.parts.time')
        </li>

    <!-- 提供者側の時 相手の評価待ち -->
    @else
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="tit">{{$chatroom->referencePurchased->title}}</p>
                        <p>提供価格：¥{{ number_format($chatroom->purchase->proposal->price) }}</p>
                        <p class="buy"><input type="submit" value="お相手の評価をお待ちください" disabled></p>
                    </div>
                </div>
            </div>
	        @include('chatroom.message.parts.time')
        </li>
    @endif

<!-- 作業完了報告 購入者評価後-->
@else
    <li>
        <div class="img">
            @include('chatroom.message.parts.icon')
            <div class="info">
                <p class="name">{{$message->user->name}}</p>
                <p>{{$message->text}}</p>
                <div class="proposeBuy">
                    <p class="tit">{{$chatroom->referencePurchased->title}}</p>
                    <p>提供価格：¥{{ number_format($chatroom->purchase->proposal->price) }}</p>
                </div>
            </div>
        </div>
	    @include('chatroom.message.parts.time')
    </li>
@endif