<x-admin-layout>
	<article>
		<body id="register_confirm">
			
			<div id="contents" class="oneColumnPage02">
				<div class="inner">
					<div id="main">
						<div class="loginWrap">
							<h2 class="registerHd registerHd_confirm">メールアドレスを確認してください</h2>
									@if(isset($error))
                                        <div class="alert alert-danger" style="text-align: center;margin-bottom:10px;">{{ $error }}</div>
                                    @endif
									
									@if(isset($send_msg))
                                        <div style="text-align: center;margin-bottom:10px;">{{ $send_msg }}</div>
                                    @endif
							<p class="registerImg">次に進む前に、確認リンクのメールをチェックしてください。<br>メールが届かなかった場合、</p>
                            <form action="{{ route('admin.verification.send') }}" method="POST">
                                @csrf
                                <input class="input_a" type="submit" value="ここをクリックしてメールを再送信してください。">
                            </form>
									
							<ul class="loginFormBtn">
								<li><a href="/">トップページへ戻る</a></li>
							</ul>
						</div>
					</div><!-- /#main -->
				</div><!--inner-->
			</div><!-- /#contents -->
		</body>
	</article>
</x-admin-layout>