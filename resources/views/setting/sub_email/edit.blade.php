<x-layout>
	<article>
		<body id="create" class="none-modal">
			<div id="contents" class="oneColumnPage02">
				<div class="inner">
					<div id="main">
						<div class="loginWrap">
							<h2 class="subPagesHd">サブメールアドレス編集</h2>
							<div class="contactBox">
								<form action="{{ route('sub_mail_store') }}" method="post" id="form" enctype="multipart/form-data" name="form1">
									@csrf
									{{-- TODO:すぐ飛べるために --}}
									<div class="labelCategory">
										<p>サブメールアドレス</p>
											@error('sub_email')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										<p><input type="text" name="sub_email" value="{{ $user->sub_email }}"></p>
									</div>
									<ul class="loginFormBtn">
										<li><input type="submit" class="submit loading-disabled" value="変更する"></li>
									</ul>
                                    <ul class="loginFormBtn">
										<li><a href="{{ route('setting.index') }}">戻る</a></li>
									</ul>
								</form>
                                <form action="{{ route('sub_mail_destroy') }}" method="post"> {{-- 削除form --}}
                                    @csrf
                                    <ul class="loginFormBtn">
                                        <li><input type="submit" style="background-color: crimson" class="submit loading-disabled" value="削除する"></li>
                                    </ul>
                                </form> {{-- 削除form --}}
							</div>
						</div>
					</div><!-- /#main -->
				</div><!--inner-->
			</div><!-- /#contents -->
		</body>
	</article>
</x-layout>
