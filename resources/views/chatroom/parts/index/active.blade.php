<div class="tabBox is_active" id="tab_box01">
    <ul class="favoriteUl01 exchangeChat">
        @if($active_chatrooms->isEmpty())
            <p style="margin:20px;">進行中のやり取りはありません。</p>
        @else
            @foreach($active_chatrooms as $value)
                <li>
                    @if(isset($value->buyerUser) && isset($value->sellerUser))
                      <x-parts.chatroom-step :value="$value"/>
                    @endif

                    @include('chatroom.parts.index.conts')

                    @if(isset($value->buyerUser) && isset($value->sellerUser))
                      @include('chatroom.parts.index.functeBtns')
                    @endif

                </li>
            @endforeach
        @endif
    </ul>
    {{ $active_chatrooms->fragment('')->links() }}
</div>