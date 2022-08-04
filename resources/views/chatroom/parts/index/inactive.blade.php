<div class="tabBox" id="tab_box02">
    <ul class="favoriteUl01 exchangeChat">
        @if($inactive_chatrooms->isEmpty())
            <p style="margin:20px;">過去のやり取りはありません。</p>
        @else
            @foreach($inactive_chatrooms as $value)
                <li>

                    @include('chatroom.parts.index.conts')
                    
                    @include('chatroom.parts.index.functeBtns')

                </li>
            @endforeach
        @endif
    </ul>
    {{ $inactive_chatrooms->fragment('inactive')->links() }}
</div>