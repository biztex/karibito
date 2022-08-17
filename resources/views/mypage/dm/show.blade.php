<x-layout>
<body id="estimate" class="dm-page-show">
	<x-parts.post-button/>
	<article>
	<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="friendsTop">
						<div class="sellerTop">
							<div class="user">
								@if($dmroom->from_user_id === Auth::id())
									@if($dmroom->toUser->userProfile->icon === null)
										<p class="head"><img src="/img/mypage/no_image.jpg" alt=""></p>
									@else
										<p class="head"><img src="{{ asset('/storage/'.$dmroom->toUser->userProfile->icon) }}" alt=""></p>
									@endif
								@else
									@if($dmroom->fromUser->userProfile->icon === null)
										<p class="head"><img src="/img/mypage/no_image.jpg" alt=""></p>
									@else
										<p class="head"><img src="{{ asset('/storage/'.$dmroom->fromUser->userProfile->icon) }}" alt=""></p>
									@endif
								@endif
								<div class="info">
									@if($dmroom->from_user_id === \Auth::id())
										<p class="name" style="margin-left:10px;">{{ $dmroom->toUser->name }}</p>
									@elseif($dmroom->to_user_id === \Auth::id())
										<p class="name" style="margin-left:10px;">{{ $dmroom->fromUser->name }}</p>
									@endif
								</div>
							</div>
							<p class="login">最終ログイン：オンライン中</p>
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
								@foreach($dmroom->dmroomMessages as $message)
								<li>
									<div class="img">
										@if(null !== $message->user->userProfile->icon)
											<p class="head"><img src="{{ asset('/storage/'.$message->user->userProfile->icon) }}" alt=""></p>
										@else
											<p class="head"><img src="/img/mypage/no_image.jpg" alt=""></p>
										@endif
										<div class="info">
											<p class="name">{{$message->user->name}}</p>

											<p class="chatroom-text break-word">{!! $message->text !!}</p>
											@if($message->file_name !== null)
												<p class="chatroom-text break-word"><a href="{{ asset('/storage/'.$message->file_path) }}" download="{{ $message->file_name }}"  style="display: inline-flex; vertical-align: center;">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark" viewBox="0 0 16 16">
													<path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
												</svg>{{ $message->file_name }}
												</a></p>
											@endif
										</div>
									</div>
									<p class="time">@if($message->user_id === Auth::id() && $message->is_view === 1) 既読 @endif {{date('Y年m月d日 G:i', strtotime($message->created_at))}}</p>
								</li>
								@endforeach
								</ul>
							</div>
							<form action="{{ route('dm.message', $dmroom->id) }}" method="POST" enctype="multipart/form-data">
							@csrf
								<div class="item">
									@error('text')<div class="alert alert-danger">{{ $message }}</div>@enderror
									<div class="evaluation">
										<textarea name="text" placeholder="依頼する内容入力してください" class="templateText">{{ old('text') }}</textarea>
									</div>
									<p class="taR">3000</p>
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
</article>
</x-layout>