<x-layout>
    <article>
    	<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<a href="#">やること</a>　>　<span>お支払い手続き</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div id="contents" style="margin-bottom:35px;">
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
						<p>キャンセル理由</p>
					</div>
					<form action="" method="post">
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
							<input type="submit" formaction="{{ route('cancel.store' ,$request->purchase_id) }}" class="blue" value="上記内容でキャンセルを申請する">
							<input type="submit" formaction="{{ route('cancel.back' ,$request->purchase_id) }}"value="内容を修正する">
						</div>
					</form>
				</div>
			</div>
		</div>
    </article>
</x-layout>