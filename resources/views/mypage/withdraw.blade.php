<x-layout>
	<article>
		<div class="btnFixed"><a href="#"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">退会ページ</h2>
                            <form action="{{ route('withdraw') }}" method="post">
                                @csrf
                                <div class="configEditBox">
                                    <div class="configEditButton">
                                        <input type="submit" value="退会する" name="">
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-layout>