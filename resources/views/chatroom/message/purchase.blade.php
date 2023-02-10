<!-- 購入メッセージ -->
<li>
    <div class="img">
        @include('chatroom.message.parts.icon')
        <div class="info">
            <p class="name">{{$message->user->name}}</p>
            @if (Auth::user()->id === $chatroom->buyer_user_id)
                <p class="message_text">{{$message->text}}</p>
                <div class="proposeBuy">
                    <p class="tit">{{$chatroom->referencePurchased->title}}</p>
                    <p>提供価格：¥{{ number_format($chatroom->purchase->proposal->price) }}</p>
                </div>
                <span>購入後のあいさつをして、詳細を相談しましょう。</span>
            @elseif (Auth::user()->id === $chatroom->seller_user_id)
                <p class="message_text">サービスが購入されました！</p>
                <div class="proposeBuy">
                    <p class="tit">{{$chatroom->referencePurchased->title}}</p>
                    <p>提供価格：¥{{ number_format($chatroom->purchase->proposal->price) }}</p>
                </div>
                <span>購入のお礼をお伝えし、詳細を確認しましょう。</span>
            @endif
        </div>
    </div>
    @include('chatroom.message.parts.time')
</li>