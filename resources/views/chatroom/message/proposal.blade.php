<!-- 提案メッセージ -->
<!-- 未購入状態 -->
@if($chatroom->status === App\Models\Chatroom::STATUS_PROPOSAL)
    <!-- 提案者の時 -->
    @if($message->user_id === Auth::id())
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p class="message_text">{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="tit">{{$chatroom->reference->title}}<p>
                        <p>提供価格：¥{{ number_format($message->reference->price) }}</p>
                        <p class="buy">
                            <span style="font-weight: normal;">提供通知を送信したことを伝えましょう。</span>
                            <input type="submit" value="購入されていません" disabled>
                        </p>
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
                    <p class="message_text">「サービス提供」通知が届きました！</p>
                    <div class="proposeBuy">
                        <p class="tit">{{$chatroom->reference->title}}</p>
                        <p>提供価格：¥{{ number_format($message->reference->price) }}</p>
                        <p class="buy">
                            <span style="font-weight: normal;">「購入する」を押すと決済画面に進みます。</span>
                            <a href="{{route('chatroom.purchase', $message->reference->id)}}">購入する</a>
                        </p>
                    </div>
                </div>
            </div>
            @include('chatroom.message.parts.time')
        </li>
    @endif

<!-- 購入済 状態-->
@elseif($chatroom->referencePurchased !== null)
    <!-- 購入された提案-->
    @if($message->reference_id === $chatroom->purchase->proposal->id)
        <!-- 提案者の時 -->
        @if($message->user_id === Auth::id())
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p class="message_text">サービスを提供しました！</p>
                        <div class="proposeBuy">
                            <p class="tit">{{$chatroom->referencePurchased->title}}<p>
                            <p>提供価格：¥{{ number_format($message->reference->price) }}</p>
                            <p class="buy">
                                <span style="font-weight: normal;">提供通知を送信したことを伝えましょう。</span>
                                <input type="submit" value="購入されました" class="white">
                            </p>
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
                        <p class="message_text">「サービス提供」通知が届きました！</p>
                        <div class="proposeBuy">
                            <p class="tit">{{$chatroom->referencePurchased->title}}</p>
                            <p>提供価格：¥{{ number_format($message->reference->price) }}</p>
                            <p class="buy"><input type="submit" class="white" value="購入しました"></p>
                        </div>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
        @endif

    <!-- 購入されなかった提案-->
    @else
        <!-- 提案者の時 -->
        @if($message->user_id === Auth::id())
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p class="message_text">サービスを提供しました！</p>
                        <div class="proposeBuy">
                            <span style="font-weight: normal;">提供通知を送信したことを伝えましょう。</span>
                            <p class="tit">{{$chatroom->referencePurchased->title}}<p>
                            <p>提供価格：¥{{ number_format($message->reference->price) }}</p>
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
                        <p class="message_text">「サービス提供」通知が届きました！</p>
                        <div class="proposeBuy">
                            <span style="font-weight: normal;">「購入する」を押すと決済画面に進みます。</span>
                            <p class="tit">{{$chatroom->referencePurchased->title}}</p>
                            <p>提供価格：¥{{ number_format($message->reference->price) }}</p>
                        </div>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
        @endif
    @endif
{{-- 商品が削除された状態  --}}
@elseif($chatroom->reference === null)

    <li>
        <div class="img">
            @include('chatroom.message.parts.icon')
            <div class="info">
                <p class="name">{{$message->user->name}}</p>
                <p>{{$message->text}}</p>
                <div class="proposeBuy">
                    <p class="tit">このサービスは削除されました<p>
                    <p class="buy"><input type="submit" value="このサービスは削除されました" disabled></p>
                </div>
            </div>
        </div>
        @include('chatroom.message.parts.time')
    </li>

@endif