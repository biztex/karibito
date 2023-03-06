{{-- NDAメッセージ --}}
{{-- 受信者確認中 --}}

@if (App\Models\ChatroomMessage::where(['chatroom_id' => $chatroom->id, 'reference_type' => 'App\Models\ChatroomNdaMessage'])->latest()->first()->id === $message->id)
@if ($chatroom->chatroomNdaMessages()->latest()->first()->status === App\Models\ChatroomNdaMessage::CONFIRMING_RECEIVED_USER)
    @php
        $status = App\Models\ChatroomNdaMessage::CONFIRMING_USER_SUBMITTED; // ステータスを送信者確認中に
    @endphp
    {{-- NDA受信者側 --}}
    @if ($message->user_id !== Auth::id())
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p class="message_text">NDAが届きました！</p>
                    <div class="proposeBuy">
                        <p class="buy">
                            <span style="font-weight: normal;">NDAを受信しました。締結に向けて内容を編集してください。</span>
                            <a href="javascript:;" class="editNDAOpen">NDAを編集する</a>
                        </p>
                    </div>
                </div>
            </div>
            @include('chatroom.message.parts.time')
        </li>
    {{-- NDA送信側 --}}
    @else
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p class="message_text">{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="buy">
                            <input type="submit" value="編集待ち" disabled>
                        </p>
                    </div>
                </div>
            </div>
            @include('chatroom.message.parts.time')
        </li>
    @endif

{{-- 送信者確認中 --}}
@elseif ($chatroom->chatroomNdaMessages()->latest()->first()->status === App\Models\ChatroomNdaMessage::CONFIRMING_USER_SUBMITTED)
    @php
        $status = App\Models\ChatroomNdaMessage::CONFIRMING_RECEIVED_USER; // ステータスを受信者確認中に
    @endphp
    {{-- NDA受信者側 --}}
    @if ($message->user_id === Auth::id())
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p class="message_text">{{$message->text}}</p>
                    <div class="proposeBuy">
                        <p class="buy">
                            <input type="submit" value="締結待ち" disabled>
                        </p>
                    </div>
                </div>
            </div>
            @include('chatroom.message.parts.time')
        </li>
    {{-- NDA送信者側 --}}
    @else
        <li>
            <div class="img">
                @include('chatroom.message.parts.icon')
                <div class="info">
                    <p class="name">{{$message->user->name}}</p>
                    <p class="message_text">NDAが編集されました！</p>
                    <div class="proposeBuy">
                        <p class="buy">
                            <span style="font-weight: normal;">内容に問題がなければ締結をしてください。再編集した場合は再度送信してください。</span>
                            <a href="javascript:;" class="editNDAOpen">NDAを編集する</a>
                        </p>
                    </div>
                </div>
            </div>
            @include('chatroom.message.parts.time')
        </li>
    @endif

{{-- 締結 --}}
@elseif ($chatroom->chatroomNdaMessages()->latest()->first()->status === App\Models\ChatroomNdaMessage::CONCLUSION)
    @php
        $status = App\Models\ChatroomNdaMessage::CONCLUSION;
    @endphp
    <li>
        <div class="img">
            @include('chatroom.message.parts.icon')
            <div class="info">
                <p class="name">{{$message->user->name}}</p>
                <p class="message_text">{{$message->text}}</p>
                <div class="proposeBuy">
                    <p class="buy">
                        <span style="font-weight: normal;">NDAが締結されました。作成したNDAをインストールできます。</span>
                        <a href="{{ route('chatroom.download.nda.pdf', $chatroom->id) }}">NDAをダウンロード</a>
                    </p>
                </div>
            </div>
        </div>
        @include('chatroom.message.parts.time')
    </li>
@endif

<div class="editNDAPopup">
    <form id="form" action="{{ route('chatroom.send.nda.edit', $chatroom->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="templateOverlay"></div>
        <div class="templateArea tabSelectArea">
            <div class="templateClose"></div>
            <h2 class="templateTitle">NDAの送付</h2>
            <div class="templateBox tabSelectBox is-active" id="editNDA">
                <textarea name="text">
                {{ $chatroom->chatroomNdaMessages()->latest()->first()->text }}
                </textarea>
            </div>
            <div class="templateButton"><button type="submit" class="templateInput" name="status" value="{{ $status }}">送信する</button></div>
            @if ($chatroom->chatroomNdaMessages()->latest()->first()->status === App\Models\ChatroomNdaMessage::CONFIRMING_USER_SUBMITTED)
                <div class="templateButton"><button type="submit" class="templateInput" name="status" value={{ App\Models\ChatroomNdaMessage::CONCLUSION }}>締結する</button></div>
            @endif
        </div>
    </form>
</div>
@endif