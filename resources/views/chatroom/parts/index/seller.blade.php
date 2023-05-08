<div class="tabBox is_active" id="seller_tab_box01">
    <div class="tabChatRoomWrap">
        <x-parts.seller-chatroom-step />
        <?php
            // すべて
            $seller_chatrooms_0 = [];
            // 交渉中
            $seller_chatrooms_1 = [];
            // 契約
            $seller_chatrooms_2 = [];
            // 完了
            $seller_chatrooms_3 = [];
            // キャンセル
            $seller_chatrooms_4 = [];
            // ゴミ箱
            $seller_chatrooms_5 = [];
            foreach($seller_chatrooms as $value) {
                if (isset($value->trash_flg) && $value->trash_flg === 1) {
                    array_push($seller_chatrooms_5, $value);
                } else {
                    array_push($seller_chatrooms_0, $value);
                    if(
                        $value->status == \App\Models\Chatroom::STATUS_START
                        || $value->status == \App\Models\Chatroom::STATUS_PROPOSAL
                    ) {
                        array_push($seller_chatrooms_1, $value);
                    } elseif (
                        $value->status == \App\Models\Chatroom::STATUS_WORK
                        || $value->status == \App\Models\Chatroom::STATUS_WORK_REPORT
                        || $value->status == \App\Models\Chatroom::STATUS_BUYER_EVALUATION
                        || $value->status == \App\Models\Chatroom::STATUS_SELLER_EVALUATION
                        || $value->status == \App\Models\Chatroom::STATUS_CANCELED_REPORT
                        || $value->status == \App\Models\Chatroom::STATUS_CANCELED
                        || $value->status == \App\Models\Chatroom::STATUS_CANCEL_SENDER_EVALUATION
                    ){
                        array_push($seller_chatrooms_2, $value);
                    } elseif ($value->status == \App\Models\Chatroom::STATUS_COMPLETE){
                        array_push($seller_chatrooms_3, $value);
                    } elseif ($value->status == \App\Models\Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION){
                        array_push($seller_chatrooms_4, $value);
                    }
                }

            }
        ?>

        <ul id="seller_chatroom_box01" class="tabChatRoomBox favoriteUl01 exchangeChat is_active">
            @if(count($seller_chatrooms_0) === 0)
                <p style="margin:20px;">出品に関するやりとりはありません。</p>
            @else
                @foreach($seller_chatrooms_0 as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>
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
