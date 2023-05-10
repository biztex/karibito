{{-- <x-parts.alert-modal-2 phrase="モーダルの確認文言" formId="送信するフォームのID" cancel_value="キャンセルボタンの文字" value="ボタンの文字" /> --}}
@props([
    'cancel_value' => 'キャンセル',
])

<div id="overflow2" style="width:100%; height:100%; background-color:rgba(0,0,0,0.2); position:fixed; top:0; left:0; z-index: 10; display: none;">
    <div class="conf confAlert">
        <div class="confAlertInner">
            <p class="confAlertPhrase">振り込み口座の登録が必要です。口座登録は<a href="{{route('setting.index')}}" class="supportLink" target="_blank">こちらから</a></p>
            <input type="button" value="{{ $cancel_value }}" class="js-alertCancel-2 confAlertCancel">
        </div>
    </div>
</div>
