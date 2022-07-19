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
						<p class="reason">誤って重複購入してしまった</p>
						<p>ダミーテキストはいりますダミーテキストはいりますダミーテキストはいりますダミーテキストはいりますダミーテキストはいりますダミーテキストはいりますダミーテキストはいりますダミーテキストはいりますダミーテキストはいりますダミーテキストはいります<br>ダミーテキストはいります</p>
					</div>
					<div class="functeBtns">
						<input type="submit" class="blue" value="キャンセル手続きに進む">
						<input type="submit" value="キャンセル手続きに進む">
					</div>
				</div>
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>