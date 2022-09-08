<x-layout>
<body id="setting-page">
<x-parts.post-button/>
	<article>
        <div id="breadcrumb">
                <div class="inner">
                    <a href="{{ route('home') }}">ホーム</a>　>　<a href="{{ route('setting.index') }}">会員情報</a>　>　<span>メールアドレス変更</span>
                </div>
            </div><!-- /.breadcrumb -->
		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">メールアドレスの変更</h2>
                            <form method="POST" action="{{ route('setting.email.send') }}">
                                @csrf
                                <div class="configEditBox">
                                    <dl class="configEditDl01 text-left">
                                        <dt class="configEditMail">現在のメールアドレス：{{ Auth::user()->email }}</dt>
                                    </dl>
                                    <dl class="configEditDl01">
                                        <dt>新しいメールアドレス</dt>
                                        <dd>
                                            <div class="mypageEditInput">
                                                @error('email')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                <input type="email" name="email" placeholder="" autocomplete="email" required>
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
