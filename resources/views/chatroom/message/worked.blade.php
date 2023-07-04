<!-- 作業報告メッセージ -->
@if($message->text === '納品が完了しました！')
    <?php
        $message_title = '納品が完了しました！';
        if ($message->user_id !== Auth::id()) {
            $message_title = '「納品完了」通知が届きました！';
        }
    ?>
    <li>
        <div class="img">
            @include('chatroom.message.parts.icon')
            <div class="info">
                <p class="name">{{$message->user->name}}</p>
                <p class="message_text">
                    {{$message_title}}
                </p>
                <div class="proposeBuy">
                    <p class="tit">{{$chatroom->referencePurchased->title}}</p>
                    <p>提供価格：¥{{ number_format($chatroom->purchase->proposal->price) }}</p>
                    <p class="buy">
                        @if($message->user_id !== Auth::id())
                            <span style="font-weight: normal;">
                                サービス内容を確認し、「承認」か「リトライ」か選択しましょう。リトライは一度のみ選択出来ます。<br>
                                ＊修正箇所がある場合、未入力のまま72時間が経過すると自動的に承認となりますのでご注意ください。<br>
                                ＊チャット内でやりとりをしていても、この通知の入力を行わない場合72時間はカウントされます。
                                @if($chatroom->status === \App\Models\Chatroom::STATUS_WORK_REPORT)
                                    @if($message->oldMessage($chatroom->id, $message->text, $message->id))
                                        <input type="submit" value="返信済み" class="white">
                                    @else
                                        <a href="{{ route('chatroom.get.work.confirm',$chatroom->id) }}" class="red">承認する</a>
                                        @if($chatroom->retry_flg !== 1)
                                            <a href="{{ route('chatroom.get.work.retry',$chatroom->id) }}" class="white">リトライ</a>
                                        @endif
                                    @endif
                                @else
                                    <input type="submit" value="返信済み" class="white">
                                @endif
                            </span>
                        @else
                            <span style="font-weight: normal;">
                                納品完了通知を送信したことを伝え、購入者からの返信を待ちましょう。
                                @if($chatroom->status === \App\Models\Chatroom::STATUS_WORK_REPORT)

                                    @if($message->oldMessage($chatroom->id, $message->text, $message->id))
                                        <input type="submit" value="返信されました" class="white">
                                    @else
                                        <input type="submit" value="未返信" disabled>
                                    @endif
                                @else
                                    <input type="submit" value="返信されました" class="white">
                                @endif
                            </span>
                        @endif
                    </p>

                </div>
            </div>
        </div>
        @include('chatroom.message.parts.time')
    </li>

@elseif($message->text === 'リトライを通知しました！')
    <?php
        $message_title = 'リトライを通知しました！';
        if ($message->user_id !== Auth::id()) {
            $message_title = 'リトライをお願いします！';
        }
    ?>
    <li>
        <div class="img">
            @include('chatroom.message.parts.icon')
            <div class="info">
                <p class="name">{{$message->user->name}}</p>
                <p class="message_text">
                    {{$message_title}}
                </p>
                <div class="proposeBuy">
                    <p class="buy">
                        <span style="font-weight: normal;">
                        @if($message->user_id !== Auth::id())
                            納品完了通知はリトライとなりました。修正箇所を確認し、再度「納品完了」通知を送りましょう。
                        @else
                            リトライを通知しました。修正箇所を丁寧に伝え、再度「納品完了」通知を送ってもらいましょう。
                        @endif
                        </span>
                    </p>

                </div>
            </div>
        </div>
        @include('chatroom.message.parts.time')
    </li>
@elseif($message->text === '「納品完了」通知を承認しました！')
    <?php
        $message_title = $message->text;
        if (isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE) {
            $message_title = "「納品完了」通知を自動承認しました";
        }
        if ($message->user_id !== Auth::id()) {
            $message_title = '「納品完了」通知が承認されました！';
            if (isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE) {
                $message_title = "「納品完了」通知が自動承認されました";
            }
        }
    ?>
    <li>
        <div class="img">
            @include('chatroom.message.parts.icon')
            <div class="info">
                <p class="name">{{$message->user->name}}</p>
                <p class="message_text">
                    {{$message_title}}
                </p>
                <div class="proposeBuy">
                    <p class="buy">
                        <span style="font-weight: normal;">
                            @if($message->user_id !== Auth::id())
                                @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                    通知後72時間が経過したため自動的に承認されました。
                                @else
                                    納品完了通知が承認されました。
                                @endif
                                    引き続き評価が入力されるのを待ちましょう。
                            @else
                                @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                    通知が届いてから72時間が経過したため自動的に承認しました。引き続き評価を入力しましょう。
                                @else
                                    引き続き評価を入力しましょう。
                                @endif
                                <br>
                                ＊未入力のまま72時間が経過すると自動的に評価済みとなりますのでご注意ください。<br>
                                ＊チャット内でやりとりをしていても、この通知の入力を行わない場合72時間はカウントされます。
                                @if($chatroom->status === \App\Models\Chatroom::STATUS_BUYER_EVALUATION)
                                    <a href="{{ route('chatroom.get.buyer.evaluation',$chatroom->id) }}" class="red">評価する</a>
                                @else
                                    <input type="submit" value="評価済み" class="white">
                                @endif
                            @endif
                        </span>
                    </p>
                </div>
            </div>
        </div>
        @include('chatroom.message.parts.time')
    </li>
@endif
