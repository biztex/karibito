<ul id="chatroomStepUl" class="stepUl">
    <li class="is_active">
        <p class="stepDot"></p>
        <p class="stepTxt">交渉中</p>
    </li>
    <li @if($value->status >= App\Models\Chatroom::STATUS_PROPOSAL && $value->status >2) class="is_active" @endif>
        <p class="stepDot"></p>
        <p class="stepTxt">契約</p>
    </li>
    <li @if($value->status >= App\Models\Chatroom::STATUS_BUYER_EVALUATION) class="is_active" @endif>
        <p class="stepDot"></p>
        <p class="stepTxt">評価</p>
    </li>
</ul>
