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
                                <span>キャンセル申請に返信していただくようご連絡しましょう。<br>
                                    キャンセル成立には双方の同意が必要です。</span>
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
                        <span>内容を確認し、「承認」か「再交渉」を選択ください。未送信のまま72時間が経過しますと自動的に「承認」となります。</span>
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
                        <span>内容を確認し、「承認」か「再交渉」を選択ください。未送信のまま72時間が経過しますと自動的に「承認」となります。</span>
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
    @else <!-- キャンセル申請を承認しました -->
        <!-- 承諾者の時 -->
        @if($message->user_id === Auth::id())
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info cancel">
                        <p class="name">{{$message->user->name}}</p>
                        <p class="message_text">{{$message->text}}</p><br>
                        <p class="cancel_evaluation">
                            <span>キャンセルが成立しました。代金は購入者の方に返金されます。<br>
                            今後こちらのやり取りは、過去の取引履歴よりご確認いただけます。</span>
                            @if($chatroom->purchase->exists() && !$chatroom->purchase->purchasedCancels->where('user_id', Auth::id())->isNotEmpty())
                                <!-- キャンセルした側評価 -->
                                @if($chatroom->status == \App\Models\Chatroom::STATUS_CANCELED)
                                    <a href="{{ route('chatroom.get.cancel.sender.evaluation',$chatroom->id) }}" class="red">評価を入力する</a>
                                @elseif ($chatroom->status == \App\Models\Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION)
                                    <a class="cancelEnd">取引完了</a>
                                @elseif ($chatroom->status == \App\Models\Chatroom::STATUS_CANCEL_SENDER_EVALUATION)
                                    <a class="cancelStart">未評価</a>
                                @endif
                            @endif

                        </p>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
        <!-- 申請者でない時 -->
        @else
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info cancel">
                        <p class="name">{{$message->user->name}}</p>
                        <p class="message_text">キャンセル申請が承諾されました！</p><br>
                        <p class="cancel_evaluation">
                            <span>キャンセルが成立しました。代金は購入者の方に返金されます。<br>
                                今後こちらのやり取りは、過去の取引履歴よりご確認いただけます。</span>
                            @if($chatroom->purchase->exists() && $chatroom->purchase->purchasedCancels->where('user_id', Auth::id())->isNotEmpty())
                                <!-- キャンセルされた側評価 -->
                                @if($chatroom->status == \App\Models\Chatroom::STATUS_CANCEL_SENDER_EVALUATION)
                                    <a href="{{ route('chatroom.get.cancel.receiver.evaluation',$chatroom->id) }}" class="red">評価を入力する</a>
                                @elseif ($chatroom->status == \App\Models\Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION)
                                    <a class="cancelEnd">取引完了</a>
                                @elseif ($chatroom->status == \App\Models\Chatroom::STATUS_CANCELED)
                                    <a class="cancelStart">未評価</a>
                                @endif
                            @endif
{{--                            <a href="{{ route('chatroom.get.buyer.cancel.evaluation',$chatroom->id) }}" class="red">評価を入力する</a>--}}
                        </p>
                    </div>
                </div>
                @include('chatroom.message.parts.time')
            </li>
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
                        <span>内容を確認し、「承認」か「再交渉」を選択ください。未送信のまま72時間が経過しますと自動的に「承認」となります。</span>
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
