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
                    <p class="message_text">「納品完了」通知が届きました！</p>
                    <div class="proposeBuy">
                        <p class="tit">{{$chatroom->referencePurchased->title}}</p>
                        <p>提供価格：¥{{ number_format($chatroom->purchase->proposal->price) }}</p>
                        <p class="buy">
                            <span style="font-weight: normal;">サービス内容を確認し、評価を入力してください。<br>
                                ＊修正箇所がある場合、未入力のまま72時間が経過すると自動的に評価入力済みとなりますのでご注意ください。</span>
                            <a href="{{ route('chatroom.get.buyer.evaluation',$chatroom->id) }}" class="red">評価を入力する</a>
                        </p>
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
                    <p class="message_text">{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="tit">{{$chatroom->referencePurchased->title}}</p>
                        <p>提供価格：¥{{ number_format($chatroom->purchase->proposal->price) }}</p>
                        <p class="buy">
                            <span style="font-weight: normal;">納品完了のご連絡をし、購入者の方に評価を入力してもらいましょう。</span>
                            <input type="submit" value="未評価" disabled>
                        </p>
                    </div>
                </div>
            </div>
            @include('chatroom.message.parts.time')
        </li>
    @endif

<!-- 作業完了報告 購入者評価後-->
@else
    @if($message->user_id !== Auth::id()) 
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p class="message_text">「納品完了」通知が届きました！</p>
                    <div class="proposeBuy">
                        <p class="tit">{{$chatroom->referencePurchased->title}}</p>
                        <p>提供価格：¥{{ number_format($chatroom->purchase->proposal->price) }}</p>
                        <p class="buy">
                        <span style="font-weight: normal;">サービス内容を確認し、評価を入力してください。<br>
                            ＊修正箇所がある場合、未入力のまま72時間が経過すると自動的に評価入力済みとなりますのでご注意ください。</span>
                            <input type="submit" value="評価入力済み" class="white">
                        </p>
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
                    <p class="message_text">{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="tit">{{$chatroom->referencePurchased->title}}</p>
                        <p>提供価格：¥{{ number_format($chatroom->purchase->proposal->price) }}</p>
                        <p class="buy">
                            <span style="font-weight: normal;">納品完了のご連絡をし、購入者の方に評価を入力してもらいましょう。</span>
                            <input type="submit" value="評価されました" class="white">
                        </p>
                    </div>
                </div>
            </div>
            @include('chatroom.message.parts.time')
        </li>
    @endif
@endif