<x-other-user.layout>
<body id="estimate" class="dm-page">
	<x-parts.post-button/>
	<article>
	<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="friendsTop">
						<div class="sellerTop">
							<div class="user">
								@if(null !== $user->userProfile->icon)
									<a href="{{ route('user.mypage', $user->id) }}" class="head"><img src="{{ asset('/storage/'.$user->userProfile->icon) }}" alt=""></a>
								@else
									<a href="{{ route('user.mypage', $user->id) }}" class="head"><img src="/img/mypage/no_image.jpg" alt=""></a>
								@endif
								<div class="info">
									<p class="name">{{ $user->name }}</p>
								</div>
							</div>
        					<p class="login">最終ログイン：{{ $user->latest_login_datetime }}</p>
						</div>
					</div>
					<h2 class="hdM">DM</h2>
					<div class="subPagesTab">
						<div class="chatPages">
							<div class="item">
								<div class="warnBox">
									<p class="tit">取引内容を入力し交渉をしましょう</p>
									<p>履歴を残すため、カリビト内でのやりとりを推奨しております。</p>
									<p class="note">※返信は3日以内にお願いします</p>
								</div>
								<ul class="communicate">
									
								</ul>
							</div>
							<form action="{{ route('dm.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
								<div class="item">
									@error('text')<div class="alert alert-danger">{{ $message }}</div>@enderror
									<div class="evaluation">
											<textarea name="text" placeholder="本文を入力してください" class="templateText" onkeyup="ShowLength(value);">{{ old('text') }}</textarea>
											<input type="hidden" name="to_user_id" value="{{ $user->id }}">
									</div>
									<p class="max-string" id="inputlength">{{ mb_strlen(old('text')) }}/3000</p>
									@error('file_path')<div class="alert alert-danger">{{ $message }}</div>@enderror
									<p class="input-file-name" style='color:#696969;margin-top:10px;'></p>
									<div class="btns">

										<p class="chatroom_file_input">資料を添付する</p>
										<input type="file" name="file_path" id="file_path" style="display:none;">
										<input type="hidden" name="file_name" value="">

										<a href="javascript:;" class="templateOpen">定型文を使う</a>
											<div class="templatePopup">
												<div class="templateOverlay"></div>
												<div class="templateArea tabSelectArea">
													<div class="templateClose"></div>
													<h2 class="templateTitle">定型文の挿入</h2>
													<div class="templateSelect">
														<select class="tabSelectLinks">
															<option value="#template01">あいさつ１</option>
															<option value="#template02">あいさつ２</option>
															<option value="#template03">あいさつ３</option>
														</select>
													</div>
													<div class="templateBox tabSelectBox is-active" id="template01">
														<textarea readonly>お世話になっております。&#13;一般社団法人日本ビジネスメール協会、●●担当の山田太郎と申します。&#13;このたびは、●●●●についてお問い合わせいただき誠にありがとうございます。&#13;ご請求いただいた資料は、本日郵送にてお送りいたします。&#13;今週中にはお手元に届くかと存じます。&#13;ご確認よろしくお願いいたします。
														</textarea>
													</div>
													<div class="templateBox tabSelectBox" id="template02">
														<textarea readonly>あいさつ２あいさつ２あいさつ２あいさつ２あいさつ２</textarea>
													</div>
													<div class="templateBox tabSelectBox" id="template03">
														<textarea readonly>あいさつ３あいさつ３あいさつ３あいさつ３あいさつ３あいさつ３あいさつ３</textarea>
													</div>
													<div class="templateButton"><button type="button" class="templateInput">挿入する</button></div>
												</div>
											</div>
									</div>
									<x-parts.file-input/>
									<div class="cancelTitle">
										<p>送信されたチャットを必要に応じてカリビト確認・削除することに同意し、</p>
									</div>
									<div class="functeBtns">
										<input type="submit" class="orange" value="送信する">
									</div>
								</div>
							</form>
							<div class="item">
								<div class="about">
									<p class="danger">ご注意！</p>
									<p>・履歴を残すため、カリビト内でのやりとりを推奨しております。<br>・トラブルの際は 警察等の捜査依頼に積極的に協力しております 。<br>・直接お会いしての取引は、人目のつく場所か複数人で行いましょう。<br>・ 無断でキャンセル、公序良俗に反する行為、誹謗中傷などは利用停止となることがあります。</p>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>

<script>
    // 打ち込んだ文字数の表示
    function ShowLength( str ) {
        document.getElementById("inputlength").innerHTML = str.length + "/3000";
    }
</script>
