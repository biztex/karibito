{{-- <x-parts.alert-modal-3 phrase="モーダルの確認文言" formId="送信するフォームのID" cancel_value="キャンセルボタンの文字" value="ボタンの文字" /> --}}
@props([
	'phrase' => "削除してもよろしいですか？",
    'formId' => '',
    'cancel_value' => 'キャンセル',
    'value' => '削除',
])

<div id="overflow3" style="width:100%; height:100%; background-color:rgba(0,0,0,0.2); position:fixed; top:0; left:0; z-index: 10; display: none;">
    <div class="conf" style="background:#FFF; padding:20px; position:absolute; top:50%; left:50%; transform:translate(-50%,-50%);">
        <p>{{ $phrase }}</p>
        <div>
            <input type="button" value="{{ $cancel_value }}" class="js-alertCancel-3">
            @if ($formId)
                <input type="submit" value="{{ $value }}" form="{{ $formId }}">                
            @endif
        </div>
    </div>
</div>