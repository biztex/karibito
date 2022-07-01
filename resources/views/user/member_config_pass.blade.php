<x-layout>
<x-parts.post-button/>{{--投稿ボタンの読み込み--}}
	<article>
		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">パスワードの変更</h2>
							<div class="configEditBox">
								<dl class="configEditDl01">
									<dt>　　　　現在のパスワード</dt>
									<dd>
										<div class="mypageEditInput"><input type="text" name="" placeholder=""></div>
									</dd>
								</dl>
								<dl class="configEditDl01">
									<dt>　　　　新しいパスワード</dt>
									<dd>
										<div class="mypageEditInput"><input type="text" name="" placeholder=""></div>
									</dd>
								</dl>
								<dl class="configEditDl01">
									<dt>新しいパスワードの再入力</dt>
									<dd>
										<div class="mypageEditInput"><input type="text" name="" placeholder=""></div>
										<p class="noticeP">※同じパスワードを確認のため入力してください</p>
									</dd>
								</dl>
								<div class="configEditButton">
									<input type="submit" value="変更する" name="">
								</div>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-layout>
