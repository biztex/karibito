<div class="tabBox is_active" id="buyer_tab_box02">
    <div class="tabChatRoomWrap">
        <x-parts.buyer-chatroom-step :step='$step'/>
        <ul id="buyer_chatroom_box01" class="tabChatRoomBox favoriteUl01 exchangeChat is_active">
            @if(count($buyer_chatrooms) === 0)
                <p style="margin:20px;">購入に関するやりとりはありません。</p>
            @else
                @foreach($buyer_chatrooms as $value)
                    <li>
                        @include('chatroom.parts.index.conts')
                    </li>
                @endforeach
            @endif
        </ul>

        {{ $buyer_chatrooms->fragment('')->links() }}
    </div>
</div>
