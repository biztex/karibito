<div class="tabBox is_active" id="seller_tab_box01">
    <div class="tabChatRoomWrap">
        <x-parts.seller-chatroom-step />
        <ul id="seller_chatroom_box01" class="tabChatRoomBox favoriteUl01 exchangeChat is_active">
            @if($seller_chatrooms->isEmpty())
                <p style="margin:20px;">出品に関するやりとりはありません。</p>
            @else
                @foreach($seller_chatrooms as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <?php
            $seller_chatrooms_1 = [];
            $seller_chatrooms_2 = [];
            $seller_chatrooms_3 = [];
            $seller_chatrooms_4 = [];
            $seller_chatrooms_5 = [];
            foreach($seller_chatrooms as $value) {
                if (isset($value->trash_flg) && $value->trash_flg === 1) {
                    array_push($seller_chatrooms_5, $value);
                } else {
                    if($value->status == 1 || $value->status == 2) {
                        array_push($seller_chatrooms_1, $value);
                    } elseif ($value->status == 3 || $value->status == 4 || $value->status == 5){
                        array_push($seller_chatrooms_2, $value);
                    } elseif ($value->status == 6){
                        array_push($seller_chatrooms_3, $value);
                    } elseif ($value->status == 7 || $value->status == 8 || $value->status == 9){
                        array_push($seller_chatrooms_4, $value);
                    }
                }

            }
        ?>
        {{-- {{info($seller_chatrooms_1[0]);}} エラーになるので、非表示--}}

        <ul id="seller_chatroom_box02" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($seller_chatrooms_1) === 0)
                <p style="margin:20px;">出品に関するやりとりはありません。</p>
            @else
                @foreach($seller_chatrooms_1 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <ul id="seller_chatroom_box03" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($seller_chatrooms_2) === 0)
                <p style="margin:20px;">出品に関するやりとりはありません。</p>
            @else
                @foreach($seller_chatrooms_2 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <ul id="seller_chatroom_box04" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($seller_chatrooms_3) === 0)
                <p style="margin:20px;">出品に関するやりとりはありません。</p>
            @else
                @foreach($seller_chatrooms_3 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <ul id="seller_chatroom_box05" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($seller_chatrooms_4) === 0)
                <p style="margin:20px;">出品に関するやりとりはありません。</p>
            @else
                @foreach($seller_chatrooms_4 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
        <ul id="seller_chatroom_box06" class="tabChatRoomBox favoriteUl01 exchangeChat">
            @if(count($seller_chatrooms_5) === 0)
                <p style="margin:20px;">出品に関するやりとりはありません。</p>
            @else
                @foreach($seller_chatrooms_5 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>

        {{ $seller_chatrooms->fragment('')->links() }}
    </div>
</div>
