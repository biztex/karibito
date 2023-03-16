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
        <?php
            $active_chatrooms_1 = [];
            $active_chatrooms_2 = [];
            $active_chatrooms_3 = [];
            $active_chatrooms_4 = [];
            $active_chatrooms_5 = [];
            foreach($active_chatrooms as $value) {
                if (isset($value->trash_flg) && $value->trash_flg === 1) {
                    array_push($active_chatrooms_5, $value);
                } else {
                    if($value->status == 1 || $value->status == 2) {
                        array_push($active_chatrooms_1, $value);
                    } elseif ($value->status == 3 || $value->status == 4 || $value->status == 5){
                        array_push($active_chatrooms_2, $value);
                    } elseif ($value->status == 6){
                        array_push($active_chatrooms_3, $value);
                    } elseif ($value->status == 7){
                        array_push($active_chatrooms_4, $value);
                    }
                }

            }
        ?>
        <ul id="chatroom_box02" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($active_chatrooms_1) === 0)
                <p style="margin:20px;">進行中のやり取りはありません。</p>
            @else
                @foreach($active_chatrooms_1 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <ul id="chatroom_box03" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($active_chatrooms_2) === 0)
                <p style="margin:20px;">進行中のやり取りはありません。</p>
            @else
                @foreach($active_chatrooms_2 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <ul id="chatroom_box04" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($active_chatrooms_3) === 0)
                <p style="margin:20px;">進行中のやり取りはありません。</p>
            @else
                @foreach($active_chatrooms_3 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <ul id="chatroom_box05" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($active_chatrooms_4) === 0)
                <p style="margin:20px;">進行中のやり取りはありません。</p>
            @else
                @foreach($active_chatrooms_4 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <ul id="chatroom_box06" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($active_chatrooms_5) === 0)
                <p style="margin:20px;">進行中のやり取りはありません。</p>
            @else
                @foreach($active_chatrooms_5 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>

        {{ $active_chatrooms->fragment('')->links() }}
    </div>
</div>
