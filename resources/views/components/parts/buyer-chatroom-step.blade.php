<div class="subPagesTab st2">
    <ul class="tabChatRoomLink" style="display:flex;justify-content:space-around;">
        <li><a href="{{ route('chatroom.buyer') }}" class="@if(isset($step) && $step == 'all') is_active @endif">すべて</a></li>
        <li><a href="{{ route('chatroom.buyer.proposal') }}" class="@if(isset($step) && $step == 'proposal') is_active @endif">交渉中</a></li>
        <li><a href="{{ route('chatroom.buyer.work') }}" class="@if(isset($step) && $step == 'work') is_active @endif">契約</a></li>
        <li><a href="{{ route('chatroom.buyer.complete') }}" class="@if(isset($step) && $step == 'complete') is_active @endif">完了</a></li>
        <li><a href="{{ route('chatroom.buyer.cancel') }}" class="@if(isset($step) && $step == 'cancel') is_active @endif">キャンセル</a></li>
        <li><a href="{{ route('chatroom.buyer.trash') }}" class="@if(isset($step) && $step == 'trash') is_active @endif">ゴミ箱</a></li>
    </ul>
</div>
