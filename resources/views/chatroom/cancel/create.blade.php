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
					<ul class="cancelRea checkChoice">
						<li><label><input type="checkbox" checked>誤って重複購入してしまった</label></li>
						<li><label><input type="checkbox">相手と連絡がつかない</label></li>
						<li><label><input type="checkbox">購入者の都合で取引が継続できなくなった</label></li>
						<li><label><input type="checkbox">出品者の都合で提供できなくなった</label></li>
						<li><label><input type="checkbox">スケジュールの折り合いがつかなくなった</label></li>
						<li><label><input type="checkbox">その他トラブル</label></li>
					</ul>
					<div class="evaluation">
						<div class="write">
							<p>キャンセル理由の詳細をご記入ください</p>
							<textarea></textarea>
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
						<input type="submit" value="キャンセル手続きに進む">
					</div>
				</div>
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>