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
                            <form method="POST" action="{{ route('mail.send') }}">
                                @csrf
                                <div class="configEditBox">
                                    <dl class="configEditDl01">
                                        <dt>新しいメールアドレス</dt>
                                        <dd>
                                            <div class="mypageEditInput"><input type="text" name="email" placeholder=""></div>
                                        </dd>
                                    </dl>
                                        <button>送信</button>
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
