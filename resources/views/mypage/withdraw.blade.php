<x-layout>
	<article>
	<body id="withdraw">
		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">退会手続き</h2>
							<p class="withdrawLead">以下の内容をご確認の上、チェックいただき「退会する」ボタンを押してください。</p>
							<form id="withdraw-form" action="{{ route('withdraw') }}" method="post">
								@csrf
								<div class="configEditBox">
									<div class="withdrawBox">
										<div class="withdrawBoxInner">
											<ul class="withdrawBoxList">
												<li class="withdrawBoxItem withdrawBoxIcon">退会は取消しができません。</li>
												<li class="withdrawBoxItem withdrawBoxIcon">退会後はすべてのサービスがご利用できなくなります。</li>
												<li class="withdrawBoxItem withdrawBoxIcon">退会すると登録情報やお取引き履歴などの情報はすべて削除されます。</li>
											</ul>
										</div>
										<div class="checkboxChoice withdrawBoxCheckbox">
											<label><input type="checkbox" name="agree_not_cancel">上記事項に同意する</label>
											@error('agree_not_cancel')<div class="alert alert-danger">{{ $message }}</div>@enderror
										</div>
									</div>
									<div class="withdrawBox">
										<div class="withdrawBoxInner">
											<p class="withdrawBoxTitle">《退会の条件》</p>
											<dl class="withdrawBoxDl">
												<dt class="withdrawBoxIcon">購入者：</dt>
												<dd>購入したサービスがすべて完了している。（評価まで行っている。）</dd>
											</dl>
											<dl class="withdrawBoxDl">
												<dt class="withdrawBoxIcon">出品者：</dt>
												<dd>購入されたサービスがすべて完了している。（評価まで行っている。）<br>申請中の振込がすべて完了している。</dd>
											</dl>
										</div>
										<div class="checkboxChoice withdrawBoxCheckbox">
											<label><input type="checkbox" name="agree_not_in_the_middle">上記条件を満たしている</label>
											@error('agree_not_in_the_middle')<div class="alert alert-danger">{{ $message }}</div>@enderror
										</div>
									</div>
									<div class="configEditButton withdrawBox">
										<!-- 退会理由 -->
										<div class="withdraw_reason">
											<label for="withdraw_reason"><span class="withdraw_reasonText">サービス改善のため、よろしければ退会理由を教えてください。</span><br>
												@error('withdraw_reason')<div class="alert alert-danger">{{ $message }}</div>@enderror
												<textarea class="withdraw_form" id="withdraw_reason" name="withdraw_reason">{{ old('withdraw_reason') }}</textarea>
											</label>
										</div>
										<input type="button" value="退会する" class="js-alertModal">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
        <x-parts.alert-modal catch="退会手続き" phrase="本当に退会してもよろしいですか？
退会後はログイン画面に切り替わります。
再ログインできませんのでご注意ください。" value="OK" formId="withdraw-form" />
	</article>
</x-layout>
