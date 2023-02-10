{{-- <x-parts.alert-modal phrase="モーダルの確認文言" formId="送信するフォームのID" cancel_value="キャンセルボタンの文字" value="ボタンの文字" /> --}}
@props([
	'catch' => "",
	'phrase' => "削除してもよろしいですか？",
    'formId' => '',
    'cancel_value' => 'キャンセル',
    'value' => '削除',
])

<div id="overflow" style="width:100%; height:100%; background-color:rgba(0,0,0,0.2); position:fixed; top:0; left:0; z-index: 10; display: none;">
    <div class="conf confAlert">
        @if ($catch)
        <p class="confAlertTitle">{{ $catch }}</p>
        @endif
        <div class="confAlertInner">
            <p class="confAlertPhrase">{{ $phrase }}</p>
            @if ($formId)
                <input type="submit" value="{{ $value }}" form="{{ $formId }}" class="confAlertSubmit">
            @endif
            <input type="button" value="{{ $cancel_value }}" class="js-alertCancel confAlertCancel">
        </div>
    </div>
</div>