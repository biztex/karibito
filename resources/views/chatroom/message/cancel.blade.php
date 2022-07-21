<!-- キャンセルメッセージ -->
<!-- 申請中 -->
@if($message->reference->status === 1)
    <!-- 申請者の時 -->
    @if($message->user_id === Auth::id())
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p>{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="buy"><input type="submit" value="お相手の承認をお待ちください" disabled></p>
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
                        <p class="buy"><a href="{{ route('cancel.show', $message->reference_id) }}" class="red">キャンセル申請が届きました</a></p>
                    </div>
                </div>
            </div>
	        @include('chatroom.message.parts.time')
        </li>
    @endif

<!-- 成立 -->
@elseif($message->reference->status === 2)
    @if($message->text === 'キャンセル申請をしました')
        <!-- 申請者の時 -->
        @if($message->user_id === Auth::id())
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p>{{$message->text}}</p>
                        <div class="proposeBuy">
                            <p class="buy"><input type="submit" value="承認されました" disabled></p>
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
                            <p class="buy"><input type="submit" class="white" value="承認済み"></p>
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
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p>{{$message->text}}</p>
                        <div class="proposeBuy">
                            <p class="buy"><input type="submit" class="white" value="キャンセル申請を承認しました" disabled></p>
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
                            <p class="buy"><input type="submit" class="white" value="キャンセル申請が承認されました"></p>
                        </div>
                    </div>
                </div>
	            @include('chatroom.message.parts.time')
            </li>
        @endif
    @endif

<!-- 異議申し立て-->
@else
    @if($message->text === 'キャンセル申請をしました')
        <!-- 申請者の時 -->
        @if($message->user_id === Auth::id())
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p>{{$message->text}}</p>
                        <div class="proposeBuy">
                            <p class="buy"><input type="submit" value="お相手の承認をお待ちください" disabled></p>
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
                            <p class="buy"><input type="submit" value="キャンセル申請が届きました" disabled></p>
                        </div>
                    </div>
                </div>
	            @include('chatroom.message.parts.time')
            </li>
        @endif
    @else <!-- キャンセル申請に異議を申し立てました -->
        <!-- 異議申し立て者の時 -->
        @if($message->user_id === Auth::id())
            <li>
                <div class="img">
                    @include('chatroom.message.parts.icon')
                    <div class="info">
                        <p class="name">{{$message->user->name}}</p>
                        <p>{{$message->text}}</p>
                        <div class="proposeBuy">
                            <p class="buy"><input type="submit" class="white" value="キャンセル申請に異議を申し立てました"></p>
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
                            <p class="buy"><input type="submit" class="white" value="キャンセル申請が承認されませんでした"></p>
                        </div>
                    </div>
                </div>
	            @include('chatroom.message.parts.time')
            </li>
        @endif

    @endif
@endif