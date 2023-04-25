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
						<h2>このお取引を本当にキャンセルしますか？</h2>
					</div>

					<form id="form" action="" method="post">
						@csrf
						<input type="hidden" name="purchase_id" value="{{$request->purchase_id}}">
                        <div class="cancelReason">
                            <p>キャンセル理由：</p>
                            <div class="cancelRea"><p class="reason">
                                    @for($i=1; $i<7; $i++)
                                        @if($request['reason'.$i] == "on")
                                            {{App\Models\PurchasedCancel::REASON[$i]}}<br/>
                                            <input type="hidden" name="reason{{$i}}" value="on">
                                        @endif
                                    @endfor
                                </p>
                            </div>
                        </div>
                        <div class="evaluation">
                            <p>キャンセル理由の詳細</p>
                            <textarea readonly>{{ old('text', $request->text) }}</textarea>
                            <input type="hidden" name="text" value="{{ $request->text }}">
                        </div>

						<div class="warnNotes mt50">
							<p class="danger">！キャンセルについて</p>
                            <p>キャンセルは原則として双方の合意が必要です。トラブル防止のため、必ず明確な理由をお伝えください。相手の方がキャンセル申請に「承認」も「再交渉」も選択しないまま72時間が経過した場合は、自動的に「承認」となります。その後、双方の評価入力をもってキャンセルは完了します。</p>
{{--							<p>カリビトではキャンセルについて罰則はありません。</p>--}}
{{--							<p class="danger02">しかし、相手の方はあなたを信頼して契約しています。<br>よほどの理由がない限りは安易にキャンセルしないようにしましょう。</p>--}}
{{--							<p class="note">※キャンセル申請をするとマイページにキャンセル申請の数が表示されます</p>--}}
						</div>
						<div class="functeBtns">
							<input type="submit" formaction="{{ route('cancel.store' ,$purchase->id) }}" class="blue loading-disabled" value="上記内容でキャンセルを申請する">
							<input type="submit" formaction="{{ route('cancel.back' ,$purchase->id) }}" class="loading-disabled" value="内容を修正する">
						</div>
					</form>
				</div>
			</div>
		</div>
    </article>
</x-layout>
