<!-- キャンセルメッセージ -->
<!-- 申請中 -->
@if($message->reference->status === App\Models\PurchasedCancel::STATUS_APPLYING)

    <!-- 購入者評価後 (キャンセル不可) -->
    @if($chatroom->status === App\Models\Chatroom::STATUS_SELLER_EVALUATION)
        @if($message->user_id === Auth::id())
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p>{{$message->text}}</p>
                        <div class="proposeBuy">
                            <p class="buy"><input type="submit" value="この申請は無効です" disabled></p>
                        </div>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
        <!-- 申請者でない時 -->
        @else
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p>{{$message->text}}</p>
                        <div class="proposeBuy">
                            <p class="buy"><input type="submit" value="この申請は無効です" disabled></p>
                        </div>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
        @endif
    @else
        <!-- 申請者の時 -->
        @if($message->user_id === Auth::id())
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p class="message_text">{{$message->text}}</p>
                        <div class="proposeBuy">
                            <p class="buy">
                                <span style="font-weight: normal;">
                                    キャンセル申請に返信していただくようご連絡しましょう。<br>
                                    キャンセル成立には双方の同意が必要です。
                                </span>
                                <input type="submit" value="未返信" disabled>
                            </p>
                        </div>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
        <!-- 申請者でない時 -->
        @else
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p class="message_text">キャンセル申請が届きました！</p>
                        <span>
                            内容を確認し、「承認」か「再交渉」を選択ください。未送信のまま72時間が経過しますと自動的に「承認」となります。
                            <br>
                            ＊チャット内でやりとりをしていても、この通知の入力を行わない場合72時間はカウントされます。
                        </span>
                        <div class="proposeBuy">
                            <p class="buy">
                                <a href="{{ route('cancel.show', $message->reference_id) }}" class="red">確認する</a>
                            </p>
                        </div>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
        @endif
    @endif

<!-- 成立 -->
@elseif($message->reference->status === App\Models\PurchasedCancel::STATUS_CANCELED)
    @if($message->text === 'キャンセル申請しました！')
        <!-- 申請者の時 -->
        @if($message->user_id === Auth::id())
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p class="message_text">{{$message->text}}</p>
                        <div class="proposeBuy">
                            <p class="buy">
                                <span>キャンセル申請に返信していただくようご連絡しましょう。<br>
                                    キャンセル成立には双方の同意が必要です。</span>
                                <input type="submit" value="返信されました" class="white">
                            </p>
                        </div>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
        <!-- 申請者でない時 -->
        @else
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p class="message_text">キャンセル申請が届きました！</p>
                        <span>
                            内容を確認し、「承認」か「再交渉」を選択ください。未送信のまま72時間が経過しますと自動的に「承認」となります。
                            <br>
                            ＊チャット内でやりとりをしていても、この通知の入力を行わない場合72時間はカウントされます。
                        </span>
                        <div class="proposeBuy">
                            <p class="buy">
                                <input type="submit" class="white" value="返信済み">
                            </p>
                        </div>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
        @endif
    @else ($message->text === 'キャンセル申請を承認しました！')<!-- キャンセル申請を承認しました -->
        <!-- 承諾者の時 -->
        @if($message->user_id === Auth::id())
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info cancel">
                        <p class="name">{{$message->user->name}}</p>
                        <p class="message_text">
                            @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                キャンセル申請を自動承認しました
                            @else
                                {{$message->text}}
                            @endif
                        </p><br>
                        <p class="cancel_evaluation">
                            <span>
                                @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                    申請が届いてから72時間が経過したため、自動的に承認しました。
                                @else
                                    キャンセルが成立しました。
                                @endif
                                引き続き評価を入力しましょう。<br>
                                ＊未入力のまま72時間が経過すると自動的に評価済みとなりますのでご注意ください。<br>
                                ＊チャット内でやりとりをしていても、この通知の入力を行わない場合72時間はカウントされます。<br>
                                双方の評価が入力された時点でキャンセル完了となり、代金が購入者の方に返金されます。<br><br>
                            </span>
                            @if($chatroom->purchase->exists() && !$chatroom->purchase->purchasedCancels->where('user_id', Auth::id())->where('status', '<>', \App\Models\PurchasedCancel::STATUS_OBJECTION)->isNotEmpty())
                                <!-- キャンセルした側評価 -->
                                @if($chatroom->status == \App\Models\Chatroom::STATUS_CANCELED)
                                    <a href="{{ route('chatroom.get.cancel.sender.evaluation',$chatroom->id) }}" class="red">
                                        評価する
                                    </a>
                                @elseif ($chatroom->status == \App\Models\Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION)
                                    <a class="cancelEnd" id="cancel_end">キャンセル完了</a>
                                @elseif ($chatroom->status == \App\Models\Chatroom::STATUS_CANCEL_SENDER_EVALUATION)
                                    <a class="cancelStart" id="cancel_start">未評価</a>
                                @endif
                            @endif

                        </p>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
            @if($chatroom->purchase->exists() && !$chatroom->purchase->purchasedCancels->where('user_id', Auth::id())->where('status', '<>', \App\Models\PurchasedCancel::STATUS_OBJECTION)->isNotEmpty())
                @if ($chatroom->status == \App\Models\Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION)
                    <li>
                        <div class="img">
                            <div style="text-align: center; width: 100%;">
                                <p class="message_text">この取引はキャンセルになりました</p><br>
                                <p class="cancel_evaluation">
                                    今後のやりとりはDMにてお願いします。
                                </p>
                            </div>
                        </div>
                    </li>
                @endif
            @endif
        <!-- 申請者でない時 -->
        @else
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info cancel">
                        <p class="name">{{$message->user->name}}</p>
                        <p class="message_text">
                            @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                キャンセル申請が自動承認されました
                            @else
                                キャンセル申請が承認されました！
                            @endif
                        </p><br>
                        <p class="cancel_evaluation">
                            <span>
                                @if(isset($message->is_auto_message) && $message->is_auto_message === \App\Models\ChatroomMessage::IS_AUTO_MESSAGE)
                                    申請後72時間が経過したため
                                @endif
                                キャンセルが成立しました。引き続き評価が入力されるのを待ちましょう。<br>
                                評価が入力されたら、あなたからも評価を入力してください。双方の評価が入力された時点でキャンセル完了となります。<br>
                                ＊未入力のまま72時間が経過すると自動的に評価済みとなりますのでご注意ください。<br>
                                ＊チャット内でやりとりをしていても、この通知の入力を行わない場合72時間はカウントされます。<br>
                                <br>
                            </span>
                            @if($chatroom->purchase->exists() && $chatroom->purchase->purchasedCancels->where('user_id', Auth::id())->isNotEmpty())
                                <!-- キャンセルされた側評価 -->
                                @if($chatroom->status == \App\Models\Chatroom::STATUS_CANCEL_SENDER_EVALUATION)
                                    <a href="{{ route('chatroom.get.cancel.receiver.evaluation',$chatroom->id) }}" class="red" id="cancel_receive_evaluation_btn">
                                        評価する
                                    </a>
                                @elseif ($chatroom->status == \App\Models\Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION)
                                    <a class="cancelEnd" id="cancel_end_1">
                                        キャンセル完了
                                    </a>
                                @elseif ($chatroom->status == \App\Models\Chatroom::STATUS_CANCELED)
                                    <a class="cancelStart" id="cancel_start">未評価</a>
                                @endif
                            @endif
{{--                            <a href="{{ route('chatroom.get.buyer.cancel.evaluation',$chatroom->id) }}" class="red">評価を入力する</a>--}}
                        </p>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
            @if($chatroom->purchase->exists() && $chatroom->purchase->purchasedCancels->where('user_id', Auth::id())->isNotEmpty())
                @if ($chatroom->status == \App\Models\Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION)
                    <li>
                        <div class="img">
                            <div style="text-align: center; width: 100%;">
                                <p class="message_text">この取引はキャンセルになりました</p><br>
                                <p class="cancel_evaluation">
                                    今後のやりとりはDMにてお願いします。
                                </p>
                            </div>
                        </div>
                    </li>
                @endif
            @endif
        @endif
    @endif

<!-- 異議申し立て-->
@else
    @if($message->text === 'キャンセル申請しました！')
        <!-- 申請者の時 -->
        @if($message->user_id === Auth::id())
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p class="message_text">キャンセル申請しました！</p>
                        <span>キャンセル申請に返信していただくようご連絡しましょう。<br>
                            キャンセル成立には双方の同意が必要です。</span>
                        <div class="proposeBuy">
                            <p class="buy">
                                <input type="submit" class="white" value="返信されました">
                            </p>
                        </div>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
        <!-- 申請者でない時 --> {{--同じ人（表示される場所一緒）--}}
        @else
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p class="message_text">キャンセル申請が届きました！</p>
                        <span>
                            内容を確認し、「承認」か「再交渉」を選択ください。未送信のまま72時間が経過しますと自動的に「承認」となります。
                            <br>
                            ＊チャット内でやりとりをしていても、この通知の入力を行わない場合72時間はカウントされます。
                        </span>
                        <div class="proposeBuy">
                            <p class="buy"><input type="submit" class="white" value="返信済み"></p>
                        </div>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
        @endif
    @else <!-- 再交渉を希望しました -->
        <!-- 再交渉を希望した人 --> {{--同じ人（表示される場所一緒）--}}
        @if($message->user_id === Auth::id())
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p class="message_text">{{$message->text}}</p><br>
                    <span>再交渉を通知しました。引き続き、お互いのすり合わせを行いましょう。</span>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
            <!-- キャンセルできなかった人 -->
            @else
                <li>
                    <div class="img">
                        @include('chatroom.message.parts.icon')
                        <div class="info">
                            <p class="name">{{$message->user->name}}</p>
                            <p class="message_text">再交渉をお願いします！</p>
                            <span>キャンセル申請は承認されませんでした。引き続き、お互いのすり合わせを行いましょう。</span>
                        </div>
                    </div>
                    @include('chatroom.message.parts.time')
                </li>
        @endif

    @endif
@endif
