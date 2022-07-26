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
						<h2>キャンセルの申請が完了いたしました</h2>
					</div>
					<div class="cancelRea">
						<p>キャンセルの申請をしました。<br>相手の方がキャンセルに「合意」を選択した場合、または3日以内に相手が「異議申し立て」を<br>選択しなかった場合に、キャンセルが成立します。</p>
					</div>
					<div class="functeBtns">
						<a href="{{ route('chatroom.show', $purchase->chatroom_id) }}">やりとりページへ戻る</a>
					</div>
				</div>
			</div>
		</div>
    </article>
</x-layout>