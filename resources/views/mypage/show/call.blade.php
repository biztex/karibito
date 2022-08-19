<div class="mypageTop">
    <form action="{{route('can_call.update')}}" method="post">
        @csrf
        <p>電話対応：</p>
        <select name="can_call" onchange="submit(this.form)">
            <option value="{{App\Models\UserProfile::CAN_CALL}}" @if(Auth::user()->userProfile->can_call === App\Models\UserProfile::CAN_CALL) selected @endif id="can_call_send">待機中</option>
            <option value="{{App\Models\UserProfile::CANNOT_CALL}}" @if(Auth::user()->userProfile->can_call === App\Models\UserProfile::CANNOT_CALL) selected @endif id="can_call_send">対応不可</option>
        </select>
        <input type="submit" style="display:none;" id="can_call_submit">
    </form>
</div>