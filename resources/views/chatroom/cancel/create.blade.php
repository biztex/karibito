<x-layout>
    <article>
        <div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<a href="#">やること</a>　>　<span>お支払い手続き</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div id="contents">
			<div class="cancelWrap">
				<div class="inner inner05">
					<ul class="stepUl">
						<li class="is_active">
							<p class="stepDot"></p>
							<p class="stepTxt">チャット開始</p>
						</li>
						<li class="is_active">
							<p class="stepDot"></p>
							<p class="stepTxt">契約</p>
						</li>
						<li class="is_active">
							<p class="stepDot"></p>
							<p class="stepTxt">作業</p>
						</li>
						<li>
							<p class="stepDot"></p>
							<p class="stepTxt">評価</p>
						</li>
					</ul>
					<div class="cancelTitle">
						<h2>この取引を本当にキャンセルしますか？</h2>
						<p>※キャンセルの場合は理由を下記の中からお選びください。</p>
					</div>
					<form action="{{ route('cancel.confirm', $purchase->id) }}" method="POST">
					@csrf
						<input type="hidden" name="purchase_id" value="{{$purchase->id}}">
						@error('reason1')<div class="alert alert-danger">{{ $message }}</div>@enderror
						<ul class="cancelRea checkChoice">
							@if( old('purchase_id') == null && $request->purchase_id == null )
							<li><label><input type="checkbox" name="reason1" checked>{{App\Models\PurchasedCancel::REASON[1]}}</label></li>
								@for($i=2; $i<7; $i++)
									<li><label><input type="checkbox" name="reason{{$i}}" @if(($request['reason'.$i]) == "on")checked @endif>{{App\Models\PurchasedCancel::REASON[$i]}}</label></li>
								@endfor
								@else

								@for($i=1; $i<7; $i++)
									<li><label><input type="checkbox" name="reason{{$i}}" @if(old('reason'.$i, $request['reason'.$i]) == "on")checked @endif>{{App\Models\PurchasedCancel::REASON[$i]}}</label></li>
								@endfor
								
							@endif
						</ul>
						<div class="evaluation">
							<div class="write">
								@error('text')<div class="alert alert-danger" style="font-weight:normal;">{{ $message }}</div>@enderror
								<p>キャンセル理由の詳細をご記入ください</p>
								<textarea name="text">{{ old('text', $request->text) }}</textarea>
							</div>
						</div>
						<div class="warnNotes mt50">
							<p class="danger">キャンセルについて</p>
							<p>カリビトではキャンセルについて罰則はありません。</p>
							<p class="danger02">しかし、相手の方はあなたを信頼して契約しています。<br>よほどの理由がない限りは安易にキャンセルしないようにしましょう。</p>
							<p class="note">※キャンセル申請をするとマイページにキャンセル申請の数が表示されます</p>
						</div>
						<div class="functeBtns">
							<input type="submit" class="blue" value="キャンセル手続きに進む">
							<a href="{{ route('chatroom.show', $purchase->chatroom->id) }}">戻る</a>
						</div>
					</form>
				</div>
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>