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
						<h2>下記の内容でキャンセル申請が届いています</h2>
						<p>キャンセル理由</p>
					</div>
					<div class="cancelRea">
						<p class="reason">
							@for($i=1; $i<7; $i++)
								@if($purchased_cancel['reason'.$i] === 1){{ App\Models\PurchasedCancel::REASON[$i] }}<br/>@endif
							@endfor
						</p>
						<p>{!! nl2br(e($purchased_cancel->text)) !!}</p>
					</div>
					<div class="functeBtns">
						<form action="" method="">
						@csrf
							<input type="submit" formaction="{{ route('cancel.approval', $purchased_cancel->id) }}" formmethod="post" class="blue" value="キャンセル申請を承認する">
							<input type="submit" formaction="{{ route('cancel.objection', $purchased_cancel->id) }}" formmethod="get" value="異議を申し立てる">
						</form>
					</div>
				</div>
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>