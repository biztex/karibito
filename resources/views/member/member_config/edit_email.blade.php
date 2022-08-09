<x-layout>
<body id="member-page">
<x-parts.post-button/>
	<article>
		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">メールアドレスの変更</h2>
                            <form method="POST" action="{{ route('member_config.email.send') }}">
                                @csrf
                                <div class="configEditBox">
                                    <dl class="configEditDl01 text-left">
                                        <dt>現在のメールアドレス：</dt>
                                        <dt>
                                            <div class="align-bottom">{{ Auth::user()->email }}</div>
                                        </dt>
                                    </dl>
                                    <dl class="configEditDl01">
                                        <dt>新しいメールアドレス</dt>
                                        <dd>
                                            <div class="mypageEditInput">
                                                @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <input type="text" name="email" placeholder="" autocomplete="email" required>
                                            </div>
                                        </dd>
                                    </dl>
                                    <div class="configEditButton">
                                        <input type="submit" value="変更する">
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>
