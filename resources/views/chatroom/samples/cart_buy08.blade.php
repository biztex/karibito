<x-layout>
    <article>
    	<div id="breadcrumb">
			<div class="inner">
				<a href="index.html">ホーム</a>　>　<a href="#">やること</a>　>　<span>お支払い手続き</span>
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
						<li class="is_active">
							<p class="stepDot"></p>
							<p class="stepTxt">評価</p>
						</li>
					</ul>
					<div class="cancelTitle">
						<h2>評価をお願いします</h2>
					</div>
					<div class="cancelRea">
						<p class="reason checkChoice"><label><input type="checkbox" checked>契約完了を確認しました</label></p>
						<div class="radioChoice rate">
							<label class="good">良かった<input type="radio" name="評価" checked></label>
							<label class="usually">普通<input type="radio" name="評価"></label>
							<label class="pity">残念だった<input type="radio" name="評価"></label>
						</div>
					</div>
					<div class="evaluation">
						<p>評価のコメントを記入しましょう</p>
						<textarea></textarea>
					</div>
					<div class="functeBtns">
						<input type="submit" class="red" value="評価を投稿する">
					</div>
					<div class="warnNotes">
						<p class="danger">ご注意！</p>
						<p>※他のクーポンと併用はできません。</p>
					</div>
				</div>
			</div>
		</div>
    </article>
</x-layout>