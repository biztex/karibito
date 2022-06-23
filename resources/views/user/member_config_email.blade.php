<x-layout>
	<article>
		<div class="btnFixed"><a href="{{ route('product.index') }}"><img src="/img/common/btn_fix.svg" alt="投稿"></a></div>
		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">メールアドレスの変更</h2>
							<div class="configEditBox">
								<dl class="configEditDl01">
									<dt>新しいメールアドレス</dt>
									<dd>
										<div class="mypageEditInput"><input type="text" name="" placeholder=""></div>
									</dd>
								</dl>
								<div class="configEditButton">
									<input type="submit" value="送信" name="">
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
