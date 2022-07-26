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
						<h2>キャンセルの申請を承認いたしました</h2>
					</div>
					<div class="cancelRea">
						<p>キャンセルの申請を承認いたしました。<br>相手の方に承認の連絡が届きます。<br>今回のお取引はキャンセルとなりました。<br>取引相手との連絡は、カリビトチャットで可能です。<br>報酬等につきましては、直接取引相手様とお願いいたします。</p>
					</div>
					<div class="functeBtns">
						<a href="{{ route('chatroom.show', $purchased_cancel->purchase->chatroom_id) }}">やりとりページへ戻る</a>
					</div>
				</div>
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>