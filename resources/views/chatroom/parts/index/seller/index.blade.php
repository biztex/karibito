<div class="tabBox is_active" id="seller_tab_box01">
    <div class="tabChatRoomWrap">
        <x-parts.seller-chatroom-step :step='$step'/>
        <ul id="buyer_chatroom_box01" class="tabChatRoomBox favoriteUl01 exchangeChat is_active">
            @if(count($seller_chatrooms) === 0)
                <p style="margin:20px;">出品に関するやりとりはありません。</p>
            @else
                @foreach($seller_chatrooms as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>

        {{ $seller_chatrooms->fragment('')->links() }}
    </div>
</div>
