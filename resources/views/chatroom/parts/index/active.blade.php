<div class="tabBox is_active" id="tab_box01">
    <div class="tabChatRoomWrap">
        <x-parts.chatroom-step />
        <ul id="chatroom_box01" class="tabChatRoomBox favoriteUl01 exchangeChat is_active">
            @if($active_chatrooms->isEmpty())
                <p style="margin:20px;">進行中のやり取りはありません。</p>
            @else
                @foreach($active_chatrooms as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <ul id="chatroom_box02" class="tabChatRoomBox favoriteUl01 exchangeChat">
        @if($active_chatrooms->isEmpty())
                <p style="margin:20px;">進行中のやり取りはありません。</p>
            @else
                @foreach($active_chatrooms as $value)
                    @if($value->status == 1 || $value->status == 2)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                    @endif
                @endforeach
            @endif
        </ul>
        <ul id="chatroom_box03" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if($active_chatrooms->isEmpty())
                <p style="margin:20px;">進行中のやり取りはありません。</p>
            @else
                @foreach($active_chatrooms as $value)
                @if($value->status == 3 || $value->status == 4 || $value->status == 5)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                    @endif
                @endforeach
            @endif
        </ul>
        <ul id="chatroom_box04" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if($active_chatrooms->isEmpty())
                <p style="margin:20px;">進行中のやり取りはありません。</p>
            @else
                @foreach($active_chatrooms as $value)
                @if($value->status == 6)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                    @endif
                @endforeach
            @endif
        </ul>
        <ul id="chatroom_box05" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if($active_chatrooms->isEmpty())
                <p style="margin:20px;">進行中のやり取りはありません。</p>
            @else
                @foreach($active_chatrooms as $value)
                @if($value->status == 7)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                    @endif

                @endforeach
            @endif
        </ul>
        <ul id="chatroom_box06" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if($active_chatrooms->isEmpty())
                <p style="margin:20px;">進行中のやり取りはありません。</p>
            @else
                @foreach($active_chatrooms as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>

        {{ $active_chatrooms->fragment('')->links() }}
    </div>
</div>