<!-- 購入メッセージ -->
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
    <p class="time">既読 2021年7月26日9:10</p>
</li>