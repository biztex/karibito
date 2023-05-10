<x-layout>
    <article>
		<div id="breadcrumb">
            <div class="inner">
                    <a href="{{ route('home') }}">ホーム</a>　>　
                    <a href="{{ route('chatroom.index') }}">やり取り一覧</a>　>　
				@if($purchase->chatroom->reference === 'App\Models\Product')
                    <a href="{{ route('product.show', $purchase->chatroom->reference_id) }}">{{$purchase->chatroom->referencePurchased->title}}</a>　>　
                @else <!-- JobRequest-->
                    <a href="{{ route('job_request.show', $purchase->chatroom->reference_id) }}">{{$purchase->chatroom->referencePurchased->title}}</a>　>　
                @endif
                    <span>キャンセル手続き</span>
            </div>
        </div><!-- /.breadcrumb -->
		<div id="contents" style="margin-bottom:35px;">
			<div class="cancelWrap">
				<div class="inner inner05">
					<div class="cancelTitle">
						<h2>このお取引きを本当にキャンセルしますか？</h2>
					</div>
					<form id="form" action="" method="">
					@csrf
						<input type="hidden" name="purchase_id" value="{{$purchase->id}}">
						@error('reason1')<div class="alert alert-danger">{{ $message }}</div>@enderror
                        <p>▸ 該当するキャンセル理由をチェックしてください。（必須）</p>
						<ul class="cancelRea checkChoice">
							@if( old('purchase_id') == null && $request->purchase_id == null )
								<li><label><input type="checkbox" name="reason1" checked>{{App\Models\PurchasedCancel::REASON[1]}}</label></li>
							@else
								<li><label><input type="checkbox" name="reason1" @if(old('reason1', $request['reason1']) == "on")checked @endif>{{App\Models\PurchasedCancel::REASON[1]}}</label></li>
							@endif
								<li><label><input type="checkbox" name="reason2" @if(old('reason2', $request['reason2']) == "on")checked @endif>{{App\Models\PurchasedCancel::REASON[2]}}</label></li>
								<li><label><input type="checkbox" name="reason3" @if(old('reason3', $request['reason3']) == "on")checked @endif>{{App\Models\PurchasedCancel::REASON[3]}}</label></li>
								<li><label><input type="checkbox" name="reason4" @if(old('reason4', $request['reason4']) == "on")checked @endif>{{App\Models\PurchasedCancel::REASON[4]}}</label></li>
								<li><label><input type="checkbox" name="reason5" @if(old('reason5', $request['reason5']) == "on")checked @endif>{{App\Models\PurchasedCancel::REASON[5]}}</label></li>
								<li><label><input type="checkbox" name="reason6" @if(old('reason6', $request['reason6']) == "on")checked @endif>{{App\Models\PurchasedCancel::REASON[6]}}</label></li>
						</ul>
						<div class="evaluation">
							<div class="write">
								@error('text')<div class="alert alert-danger" style="font-weight:normal;">{{ $message }}</div>@enderror
								<p>キャンセル理由の詳細をご記入ください。<span>（必須）</span></p>
								<textarea name="text">{{ old('text', $request->text) }}</textarea>
							</div>
						</div>
						<div class="warnNotes mt50">
							<p class="danger">！キャンセルについて</p>
							<p>
                                キャンセルは原則として双方の合意が必要です。<br />
                                トラブル防止のため、必ず明確な理由をお伝えください。<br />
                                相手の方がキャンセル申請に「承認」も「再交渉」も選択しないまま72時間が経過した場合は、自動的に「承認」となります。<br />
                                その後、双方の評価入力をもってキャンセルは完了します。</p>
{{--							<p>カリビトではキャンセルについて罰則はありません。</p>--}}
{{--							<p class="danger02">しかし、相手の方はあなたを信頼して契約しています。<br>よほどの理由がない限りは安易にキャンセルしないようにしましょう。</p>--}}
{{--							<p class="note">※キャンセル申請をするとマイページにキャンセル申請の数が表示されます</p>--}}
						</div>
						<div class="functeBtns">
							<input type="submit" formaction="{{ route('cancel.confirm', $purchase->id) }}" formmethod="post" class="blue loading-disabled" value="確認する">
{{--							<input type="submit" formaction="{{ route('chatroom.show', $purchase->chatroom->id) }}" formmethod="get" value="戻る">--}}
						</div>
					</form>
				</div>
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>
