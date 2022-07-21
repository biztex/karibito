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
								<p class="head"><img src="/img/mypage/no_image.jpg" alt=""></p>
								<div class="info">
									<p class="name">購入者の名前</p>
								</div>
							</div>
							<p class="login">最終ログイン：オンライン中</p>
						</div>
					</div>
					<h2 class="hdM">チャット<a href="#" class="more st2">契約後のキャンセルについて</a></h2>
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
										<textarea name="text" placeholder="依頼する入力してください">{{ old('text') }}</textarea>
										<input type="hidden" name="to_user_id" value="{{ $to_user_id }}">
									</div>

									@error('file_path')<div class="alert alert-danger">{{ $message }}</div>@enderror
									<p class="input-file-name" style='color:#696969;margin-top:10px;'></p>
									<div class="btns">

										<p class="chatroom_file_input">資料を添付する</p>
										<input type="file" name="file_path" id="file_path" style="display:none;">
										<input type="hidden" name="file_name" value="">

										<a href="#">定型分を使う</a>
										
									</div>
									<div class="about mt25">
										<p class="tit">【資料を添付する】について</p>
										<p>・テキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト<br>・テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
									</div>
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
		<x-hide-modal/>
	</body>
</article>
</x-layout>