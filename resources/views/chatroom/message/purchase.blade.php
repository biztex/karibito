<!-- 購入メッセージ -->
<li>
    <div class="img">
        @include('chatroom.message.parts.icon')
        <div class="info">
            <p class="name">{{$message->user->name}}</p>
            <p>{{$message->text}}</p>
            <div class="proposeBuy">
                <p class="tit">{{$chatroom->reference->title}}</p>
                <p>提供価格：¥{{ number_format($chatroom->purchase->proposal->price) }}</p>
            </div>
        </div>
    </div>
    @include('chatroom.message.parts.time')
</li>