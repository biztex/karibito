<div class="tabBox" id="buyer_tab_box02">
    <div class="tabChatRoomWrap">
        <x-parts.buyer-chatroom-step />
        <?php
            $buyer_chatrooms_0 = [];
            $buyer_chatrooms_1 = [];
            $buyer_chatrooms_2 = [];
            $buyer_chatrooms_3 = [];
            $buyer_chatrooms_4 = [];
            $buyer_chatrooms_5 = [];
            foreach($buyer_chatrooms as $value) {
                if (isset($value->trash_flg) && $value->trash_flg === 1) {
                    array_push($buyer_chatrooms_5, $value);
                } else {
                    array_push($buyer_chatrooms_0, $value);
                    if($value->status == 1 || $value->status == 2) {
                        array_push($buyer_chatrooms_1, $value);
                    } elseif ($value->status == 3 || $value->status == 4 || $value->status == 5){
                        array_push($buyer_chatrooms_2, $value);
                    } elseif ($value->status == 6){
                        array_push($buyer_chatrooms_3, $value);
                    } elseif ($value->status == 7 || $value->status == 8 || $value->status == 9){
                        array_push($buyer_chatrooms_4, $value);
                    }
                }

            }
        ?>
        <ul id="buyer_chatroom_box01" class="tabChatRoomBox favoriteUl01 exchangeChat is_active">
            @if(count($buyer_chatrooms_0) === 0)
                <p style="margin:20px;">購入に関するやりとりはありません。</p>
            @else
                @foreach($buyer_chatrooms_0 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>

        <ul id="buyer_chatroom_box02" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($buyer_chatrooms_1) === 0)
                <p style="margin:20px;">購入に関するやりとりはありません。</p>
            @else
                @foreach($buyer_chatrooms_1 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <ul id="buyer_chatroom_box03" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($buyer_chatrooms_2) === 0)
                <p style="margin:20px;">購入に関するやりとりはありません。</p>
            @else
                @foreach($buyer_chatrooms_2 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <ul id="buyer_chatroom_box04" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($buyer_chatrooms_3) === 0)
                <p style="margin:20px;">購入に関するやりとりはありません。</p>
            @else
                @foreach($buyer_chatrooms_3 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <ul id="buyer_chatroom_box05" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($buyer_chatrooms_4) === 0)
                <p style="margin:20px;">購入に関するやりとりはありません。</p>
            @else
                @foreach($buyer_chatrooms_4 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <ul id="buyer_chatroom_box06" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($buyer_chatrooms_5) === 0)
                <p style="margin:20px;">購入に関するやりとりはありません。</p>
            @else
                @foreach($buyer_chatrooms_5 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>

        {{ $buyer_chatrooms->fragment('')->links() }}
    </div>
</div>
