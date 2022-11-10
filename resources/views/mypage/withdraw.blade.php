<x-layout>
	<article>
	<body id="withdraw">
		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">退会ページ</h2>
							<div class="box">
								<p class="title">カリビトを退会するにあたって</p>
								<p class="txt">
									・退会処理をすると、全てのサービスがご利用できなくなりますのでご注意ください。<br>
									・購入予定者がいるサービスが残っている場合、キャンセルになります。<br>
									・トークルームなど過去のやり取りの履歴は全て閲覧することができなくなります。<br>
									・退会処理後にアカウントを元に戻すことはできませんのでお気をつけください。<br>
									カリビトを退会する条件<br>
									・購入者：購入したサービスが全て完了している<br>
									・出品者：出品したサービスに対して全て正式な納品をしている<br>
									・出品者：振込依頼中の売上がない<br>
									・出品者：広告の返金申請中でない<br>
									（売上の振込依頼、あるいは広告の返金申請を行なっている場合は、振込が完了してから退会手続きを行なってください）<br>
									<br>
								</p>
							</div>
							<form action="{{ route('withdraw') }}" method="post">
								@csrf
								<div class="configEditBox">
									<div class="configEditButton">
										<!-- 退会理由 -->
										<div class="withdraw_reason">
											<p>もしこのまま退会されるようでしたら退会理由をご記入いただけましたら</p>
											<p>今後の運営改善の参考にさせていただきますのでお手数ですがよろしくお願いいたします。</p><br>
											<label for="withdraw_reason">退会理由<br>
												@error('withdraw_reason')<div class="alert alert-danger">{{ $message }}</div>@enderror
												<textarea class="withdraw_form" id="withdraw_reason" name="withdraw_reason">{{ old('withdraw_reason') }}</textarea>
											</label>
										</div>
										<input type="submit" value="退会する" name="" onclick='return confirm("退会してもよろしいですか？");'>
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
