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
                    <p class="message_text">評価を入力しました！</p>
                    <div class="proposeBuy">
                        <p class="buy none">
                            <span style="font-weight: normal;">お礼のメッセージと評価入力をしたことを報告しましょう。出品者からの評価入力をもって取引は完了となります。</span>
                            <input type="submit" value="未評価" disabled>
                        </p>
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
                    <p class="message_text">{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="buy">
                            <span style="font-weight: normal;">引き続き、購入者の方の評価を入力しましょう。購入者の方の評価が完了した時点で取引は完了となります。</span>
                            <a href="{{route('chatroom.get.seller.evaluation',$chatroom->id)}}" class="red">評価を入力する</a>
                        </p>
                    </div>
                </div>
            </div>
            @include('chatroom.message.parts.time')
        </li>
    @endif

<!-- 両者評価完了後 -->
@elseif($chatroom->status === App\Models\Chatroom::STATUS_COMPLETE)
    @if($message->user_id === $chatroom->seller_user_id) {{--両者に表示される--}}
        <li>
            <p class="message_text">取引終了となります。ありがとうございました。</p>
        </li>
    @elseif($message->user_id === Auth::id() && $chatroom->buyer_user_id === Auth::id())
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p class="message_text">評価を入力しました！</p>
                    <div class="proposeBuy">
                        <p class="buy none">
                            <span style="font-weight: normal;">お礼のメッセージと評価入力をしたことを報告しましょう。出品者からの評価入力をもって取引は完了となります。</span>
                            <input type="submit" value="取引完了" class="white">
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
                        <p class="buy none">
                            <span style="font-weight: normal;">引き続き、購入者の方の評価を入力しましょう。購入者の方の評価が完了した時点で取引は完了となります。</span>
                            <input type="submit" value="取引完了" class="white">
                        </p>
                    </div>
                </div>
            </div>
            @include('chatroom.message.parts.time')
        </li>
    @endif
@endif