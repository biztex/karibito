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

					<x-parts.chatroom-step :value="$purchase->chatroom"/>

					<div class="cancelTitle">
						<h2>この取引を本当にキャンセルしますか？</h2>
						<p>キャンセル理由</p>
					</div>
					<form id="form" action="" method="post">
						@csrf
						<input type="hidden" name="purchase_id" value="{{$request->purchase_id}}">

						<div class="cancelRea"><p class="reason">
							@for($i=1; $i<7; $i++)
								@if($request['reason'.$i] == "on")
									{{App\Models\PurchasedCancel::REASON[$i]}}<br/>
									<input type="hidden" name="reason{{$i}}" value="on">
								@endif
							@endfor
							</p>
							<p>{!! nl2br(e($request->text)) !!}</p>
							<input type="hidden" name="text" value="{{ $request->text }}">
						</div>
						<div class="warnNotes mt50">
							<p class="danger">キャンセルについて</p>
							<p>カリビトではキャンセルについて罰則はありません。</p>
							<p class="danger02">しかし、相手の方はあなたを信頼して契約しています。<br>よほどの理由がない限りは安易にキャンセルしないようにしましょう。</p>
							<p class="note">※キャンセル申請をするとマイページにキャンセル申請の数が表示されます</p>
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