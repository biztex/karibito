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
									<p class="warnBoxTitle" style="color:red;">【注意事項】</p>
									<p class="warnBoxText">メッセージのやり取りは、必ず「カリビトチャット」を通じて行ってください<br>・メールアドレス・LINE・電話など外部連絡先の交換、またそれらを用いてのやり取り<br>・カリビト外での直接取引を促す行為<br>カリビトではこれらの行為を禁止しております。<br>確認した場合、アカウントの停止など、今後のご利用をお断りさせていただくことがございますので、ご注意ください。</p>
								</div>
								<ul class="communicate">

								</ul>
							</div>
							<form action="{{ route('dm.store') }}" method="POST" enctype="multipart/form-data">
							@csrf
								<div class="item">
									@error('text')<div class="alert alert-danger">{{ $message }}</div>@enderror
									<div class="evaluation">
										<textarea name="text" placeholder="本文を入力してください" class="templateText" onclick="ClickShowLength(value);" onkeyup="ShowLength(value);">{{ old('text') }}</textarea>
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
									</div>
									<x-parts.file-input/>
									<div class="cancelTitle">
										<p>送信されたチャットを必要に応じてカリビトが確認・削除することに同意します。</p>
									</div>
									<div class="functeBtns">
										<input type="submit" class="orange" value="送信する">
									</div>
								</div>
							</form>
                            <div class="templatePopup">
                                <div class="templateOverlay"></div>
                                <div class="templateArea tabSelectArea">
                                    <div class="templateClose"></div>
                                    <h2 class="templateTitle">定型文の挿入</h2>
                                    <div class="templateSelect">
                                        <select class="tabSelectLinks">
                                            <option value="#template01">購入前の問い合わせ（購入者）▼</option>
                                            <option value="#template02">購入確認のあいさつ（購入者）▼</option>
                                            <option value="#template03">購入確認のあいさつ（出品者）▼</option>
                                            <option value="#template04">購入後のあいさつ（購入者）▼</option>
                                            <option value="#template05">購入後のあいさつ（出品者）▼</option>
                                            <option value="#template06">やりとりが滞ってしまったら▼</option>
                                            <option value="#template07">キャンセルについて（購入者）▼</option>
                                            <option value="#template10">キャンセルについて（出品者）▼</option>
                                            <option value="#template08">納品完了メール（出品者）▼</option>
                                            <option value="#template09">サービス受取時（購入者）▼</option>
                                        </select>
                                    </div>
                                    <div class="templateBox tabSelectBox is-active" id="template01">
                                        <textarea readonly> {{--表示が崩れるためインデント無視--}}
                                            はじめまして。〇〇と申します。
                                            ▲▲様が出品されている「□□□」のサービスをお願いしたいと考えております。
                                            購入にあたり、下記内容をご確認の程よろしくお願い致します。
                                            （＊購入後のトラブル防止のため、気になることはしっかりと確認しましょう。）
                                            お忙しいところ大変お手数ではございますが、どうぞ宜しくお願い致します。
                                        </textarea>
                                    </div>
                                    <div class="templateBox tabSelectBox" id="template02">
                                        <textarea readonly>
                                        はじめまして。
                                        〇〇と申します。　
                                        ▲▲様が出品されている「□□□」のサービスを購入したいと思いますので、「サービスの提供」通知を送っていただけますでしょうか。
                                        届き次第、購入手続きをさせていただきたいと思います。
                                        どうぞよろしくお願い致します。
                                        </textarea>
                                    </div>
                                    <div class="templateBox tabSelectBox" id="template03">
                                        <textarea readonly>
                                        この度は、数多くあるサービスの中からご連絡いただきまして誠にありがとうございます。
                                        さっそく「サービス提供」通知をお送りしましたので、購入手続きをお願いいたします。　
                                        お取引完了まで、どうぞよろしくお願い致します。
                                        </textarea>
                                    </div>
                                    <div class="templateBox tabSelectBox" id="template04">
                                        <textarea readonly>
                                            先ほどサービスを購入させていただきました〇〇です。　
                                            とても楽しみにしていますので、お取引完了までどうぞよろしくお願い致します。
                                        </textarea>
                                    </div>
                                    <div class="templateBox tabSelectBox" id="template05">
                                        <textarea readonly>
                                            この度はサービスをご購入いただき、誠にありがとうございます。
                                            お取引完了まで、どうぞよろしくお願い致します。　
                                            早速ですが、ご依頼内容の詳細を確認させていただきたいので、下記内容を教えてください。
                                            よろしくお願い致します。
                                            （＊サービス提供に必要な情報をしっかりとすり合わせましょう。）
                                        </textarea>
                                    </div>
                                    <div class="templateBox tabSelectBox" id="template06">
                                        <textarea readonly>
                                            ●日に送らせていただきましたご連絡について、まだご返信をいただけておりませんのでご連絡をさせていただきました。
                                            現在の状況等、お早目にご連絡をいただければ幸いです。
                                            お忙しいところ恐縮ではございますが、どうぞよろしくお願い致します。
                                        </textarea>
                                    </div>
                                    <div class="templateBox tabSelectBox" id="template07">
                                        <textarea readonly>
                                            大変申し訳ございませんが、今回のご依頼の件はキャンセルさせていただきたいと思います。
                                            キャンセル申請にも記述しておりますが、理由としましては（＊必ず理由を明記します）でございます。
                                            申請のご確認をお願いします。
                                            お役に立てず誠に残念ですが、また機会がございましたら、どうぞよろしくお願い致します。
                                            なお、承認をいただきましたら、代金は支払方法に応じて後日返金されると存じております。よろしくお願い致します。　　
                                        </textarea>
                                    </div>
                                    <div class="templateBox tabSelectBox" id="template08">
                                        <textarea readonly>
                                            サービスを納品させていただきますので、ご確認の程よろしくお願い致します。
                                            修正箇所や何か確認したい点がございましたら、お手数をおかけしますが「リトライ」を選択し、ご連絡をお願い致します。
                                            問題がないようでしたら、「承認」を選択していただき、評価にお進みいただけますでしょうか？
                                            よろしくお願い致します。
                                        </textarea>
                                    </div>
                                    <div class="templateBox tabSelectBox" id="template09">
                                        <textarea readonly>
                                            サービスの確認をさせていただきました。
                                            こちらで問題ございませんので、「承認」とさせて頂きます。
                                            どうもありがとうございます。
                                            この後評価をさせていただきますので、取引終了までよろしくお願い致します。
                                        </textarea>
                                    </div>
                                    <div class="templateBox tabSelectBox" id="template10">
                                        <textarea readonly>
                                            大変申し上げにくいのですが、今回のご依頼の件はキャンセルをお願いしたく存じます。
                                            キャンセル申請にも記述しておりますが、理由としましては（＊必ず理由を明記する）でございます。申請のご確認をお願いします。
                                            こちらから依頼したにもかかわらず大変恐縮ですが、ご了承いただけますようお願い致します。
                                        </textarea>
                                    </div>
                                    <div class="templateButton">
                                        <button type="button" class="templateInput">挿入する</button>
                                    </div>
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

		// フィールドをクリックしたら文字数の表示
    function ClickShowLength( str ) {
        document.getElementById("inputlength").innerHTML = str.length + "/3000";
    }
</script>
