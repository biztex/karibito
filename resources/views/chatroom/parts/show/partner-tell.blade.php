@if($chatroom->referencePurchased === null)

@elseif($chatroom->referencePurchased->is_call ===  1 && $chatroom->canCall())
    <div class="tellTop">
        <div class="support">
            <span class="pre">電話対応：{{App\Models\UserProfile::CALL_STATUS[$partner->userProfile->can_call]}}</span>
            <span class="fix">「待機中」のみ着信可能です</span>
        </div>
        @if($partner->userProfile->can_call === App\Models\UserProfile::CAN_CALL )
            @if($partner->tel !== null)
                <div class="functeBtns">
                    <a href="tel:{{$partner->tel}}" class="full blue">電話をかける</a>
                </div>
            @else
                <div class="functeBtns">
                    <a tabindex="-1" class="full">電話番号は登録されていません</a>
                </div>
            @endif
        @endif
    </div>
@endif