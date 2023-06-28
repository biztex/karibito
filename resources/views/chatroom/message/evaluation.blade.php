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
                    @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                        <p class="message_text">自動的に評価を入力しました</p>
                    @else
                        <p class="message_text">評価を入力しました！</p>
                    @endif
                    <div class="proposeBuy">
                        <p class="buy none">
                            <span style="font-weight: normal;">
                                @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                    未評価のまま72時間が経過したため自動的に評価しました。
                                @else
                                    お礼のメッセージと評価入力をしたことを報告しましょう。
                                @endif
                                出品者からの評価入力をもって取引は完了となります。
                            </span>
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
                    @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                        <p class="message_text">自動的に評価が入力されました</p>
                    @else
                        <p class="message_text">{{$message->text}}</p>
                    @endif

                    <div class="proposeBuy">
                        <p class="buy">
                            <span style="font-weight: normal;">
                                @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                    未評価のまま72時間が経過したため自動的に評価されました。
                                @endif
                                引き続き、購入者の方の評価を入力しましょう。購入者の方の評価が完了した時点で取引は完了となります。
                                @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                    <br>
                                    ＊チャット内でやりとりをしていても、この通知の入力を行わない場合72時間はカウントされます。
                                @endif
                            </span>
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
            <p class="message_text">この取引は完了しました！</p>
            <p style="text-align: center; margin-top: 10px;">今後のやりとりはDMにてお願いします。</p>
        </li>
    @elseif($message->user_id === Auth::id() && $chatroom->buyer_user_id === Auth::id())
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                        <p class="message_text">自動的に評価を入力しました</p>
                    @else
                        <p class="message_text">評価を入力しました！</p>
                    @endif
                    <div class="proposeBuy">
                        <p class="buy none">
                            <span style="font-weight: normal;">
                                @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                    未評価のまま72時間が経過したため自動的に評価しました。
                                @else
                                    お礼のメッセージと評価入力をしたことを報告しましょう。
                                @endif
                                出品者からの評価入力をもって取引は完了となります。
                            </span>
                            @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                <input type="submit" value="自動的に評価されました【取引完了】" class="white">
                            @else
                                <input type="submit" value="取引完了" class="white">
                            @endif
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
                    @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                        <p class="message_text">自動的に評価が入力されました</p>
                    @else
                        <p class="message_text">{{$message->text}}</p>
                    @endif
                    <div class="proposeBuy">
                        <p class="buy none">
                            <span style="font-weight: normal;">
                                @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                    未評価のまま72時間が経過したため自動的に評価されました。
                                @endif
                                引き続き、購入者の方の評価を入力しましょう。購入者の方の評価が完了した時点で取引は完了となります。
                                @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                    <br>
                                    ＊チャット内でやりとりをしていても、この通知の入力を行わない場合72時間はカウントされます。
                                @endif
                            </span>
                            @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                <input type="submit" value="自動的に評価しました【取引完了】" class="white">
                            @else
                                <input type="submit" value="取引完了" class="white">
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @include('chatroom.message.parts.time')
        </li>
    @endif
@elseif($chatroom->status === App\Models\Chatroom::STATUS_CANCEL_SENDER_EVALUATION || $chatroom->status === App\Models\Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION)
    @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
        <script>
            showAutoMessage(<?php echo $chatroom->status?>)
            function showAutoMessage(status) {
                const STATUS_CANCEL_SENDER_EVALUATION = <?php echo App\Models\Chatroom::STATUS_CANCEL_SENDER_EVALUATION?>;
                const STATUS_CANCEL_RECEIVE_EVALUATION = <?php echo App\Models\Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION?>;
                if (status === STATUS_CANCEL_SENDER_EVALUATION) {
                    if (document.getElementById('cancel_start')) {
                        document.getElementById('cancel_start').innerText = "自動的に評価しました。お相手の評価を待ちましょう。";
                    }
                    if (document.getElementById('cancel_receive_evaluation_btn')) {
                        document.getElementById('cancel_receive_evaluation_btn').innerText = "自動的に評価されました。お相手の評価を入力しましょう。";
                    }
                } else if (status === STATUS_CANCEL_RECEIVE_EVALUATION) {
                    if (document.getElementById('cancel_end')) {
                        document.getElementById('cancel_end').innerText = "自動的に評価されました【キャンセル完了】";
                    }
                    if (document.getElementById('cancel_end_1')) {
                        document.getElementById('cancel_end_1').innerText = "自動的に評価しました【キャンセル完了】";
                    }

                }
            }
        </script>
    @endif
@endif