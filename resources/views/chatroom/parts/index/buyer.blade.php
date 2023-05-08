<div class="tabBox is_active" id="buyer_tab_box02">
    <div class="tabChatRoomWrap">
        <x-parts.buyer-chatroom-step />
        <?php
            // すべて
            $buyer_chatrooms_0 = [];
            // 交渉中
            $buyer_chatrooms_1 = [];
            // 契約
            $buyer_chatrooms_2 = [];
            // 完了
            $buyer_chatrooms_3 = [];
            // キャンセル
            $buyer_chatrooms_4 = [];
            // ゴミ箱
            $buyer_chatrooms_5 = [];
            foreach($buyer_chatrooms as $value) {
                if (isset($value->trash_flg) && $value->trash_flg === 1) {
                    array_push($buyer_chatrooms_5, $value);
                } else {
                    array_push($buyer_chatrooms_0, $value);
                    if(
                        $value->status == \App\Models\Chatroom::STATUS_START
                        || $value->status == \App\Models\Chatroom::STATUS_PROPOSAL
                    ) {
                        array_push($buyer_chatrooms_1, $value);
                    } elseif (
                        $value->status == \App\Models\Chatroom::STATUS_WORK
                        || $value->status == \App\Models\Chatroom::STATUS_WORK_REPORT
                        || $value->status == \App\Models\Chatroom::STATUS_BUYER_EVALUATION
                        || $value->status == \App\Models\Chatroom::STATUS_SELLER_EVALUATION
                        || $value->status == \App\Models\Chatroom::STATUS_CANCELED_REPORT
                        || $value->status == \App\Models\Chatroom::STATUS_CANCELED
                        || $value->status == \App\Models\Chatroom::STATUS_CANCEL_SENDER_EVALUATION
                    ){
                        array_push($buyer_chatrooms_2, $value);
                    } elseif ($value->status == \App\Models\Chatroom::STATUS_COMPLETE){
                        array_push($buyer_chatrooms_3, $value);
                    } elseif ($value->status == \App\Models\Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION){
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
