<x-layout>
	<article>
		<body id="create" class="none-modal">
			<div id="contents" class="oneColumnPage02">
				<div class="inner">
					<div id="main">
						<div class="loginWrap">
							<h2 class="subPagesHd">サブメールアドレス登録</h2>
							<div class="contactBox">
								<form action="{{ route('sub_mail_store') }}" method="post" id="form" enctype="multipart/form-data" name="form1">
									@csrf
									{{-- TODO:すぐ飛べるために --}}
									<div class="labelCategory">
										<p>サブメールアドレス</p>
											@error('sub_email')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										<p><input type="text" name="sub_email" placeholder="" class="@error('sub_email') is-invalid @enderror" value="{{ old('sub_email') }}" required></p>
									</div>
									<ul class="loginFormBtn">
										<li><input type="submit" class="submit loading-disabled" value="登録"></li>
									</ul>
                                    <ul class="loginFormBtn">
										<li><a href="{{ route('setting.index') }}">戻る</a></li>
									</ul>
								</form>
							</div>
						</div>
					</div><!-- /#main -->
				</div><!--inner-->
			</div><!-- /#contents -->
		</body>
	</article>
</x-layout>
