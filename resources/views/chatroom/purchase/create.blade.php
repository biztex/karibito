<x-layout>
    <article>
    <div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<a href="#">やること</a>　>　<span>お支払い手続き</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div id="contents" style="margin-bottom:35px;">
			<div class="cancelWrap">
				<div class="inner inner05">
					<ul class="stepUl">
						<li class="is_active">
							<p class="stepDot"></p>
							<p class="stepTxt">チャット開始</p>
						</li>
						<li class="is_active">
							<p class="stepDot"></p>
							<p class="stepTxt">契約</p>
						</li>
						<li class="is_active">
							<p class="stepDot"></p>
							<p class="stepTxt">作業</p>
						</li>
						<li>
							<p class="stepDot"></p>
							<p class="stepTxt">評価</p>
						</li>
					</ul>
					<h2 class="subPagesHd">お支払い手続き</h2>
					<div class="payment">
						<table>
							<thead>
								<th width="70%">内容</th>
								<th>お支払い金額</th>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="cont">
											<p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
											<div class="info">
												<p>ダミータイトル・ダミータイトルだ…ダミータイトル・ダミータイトル・ダミータイトル・ダミータイトル・</p>
												<p class="link"><a href="#">機密保持契約(NDA)</a></p>
											</div>
										</div>
									</td>
									<td>¥10,000</td>
								</tr>
								<tr>
									<td><big>商品代金</big><br>手数料</td>
									<td><big>¥10,000</big><br>¥500</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<td>合計</td>
									<td>¥10,500</td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="coupons">
						<div class="checkbox">
							<p class="checkChoice"><label><input type="checkbox" checked>クーポンの利用する</label></p>
							<p class="number"><input type="text" value="asdf784asfhg4"></p>
							<p class="detail">500円割引クーポン(合計3,000円以上のサービスでご利用可能)／2022年02月08日まで</p>
							<div class="warnNotes">
								<p class="danger">ご注意！</p>
								<p>※他のクーポンと併用はできません。</p>
							</div>
						</div>
						<div class="radio">
							<p class="tit">ポイントの利用</p>
							<ul class="radioChoice">
								<li><label><input type="radio" name="ポイント">利用しない</label></li>
								<li><label><input type="radio" name="ポイント">利用する</label>
									<p class="point">利用可能ポイント：000P</p>
								</li>
							</ul>
						</div>
						<div class="method">
							<p class="tit">お支払い方法</p>
							<div class="radioChoice">
								<label><input type="radio">クレジット決済</label>
								<div class="marks">
									<a href="#" target="_blank"><img src="/img/cart_buy/ico_mark01.svg" alt=""></a>
									<a href="#" target="_blank"><img src="/img/cart_buy/ico_mark02.svg" alt=""></a>
									<a href="#" target="_blank"><img src="/img/cart_buy/ico_mark03.svg" alt=""></a>
									<a href="#" target="_blank"><img src="/img/cart_buy/ico_mark04.svg" alt=""></a>
									<a href="#" target="_blank"><img src="/img/cart_buy/ico_mark05.svg" alt=""></a>
								</div>
							</div>
							<div class="credit">
								<table>
									<tr>
										<th>カード番号</th>
										<td>
											<input type="text" class="big">
											<p class="case">例）1234567890123456</p>
										</td>
									</tr>
									<tr>
										<th>有効期限</th>
										<td>
											<div>
												<select>
													<option>01</option>
													<option>02</option>
													<option>03</option>
													<option>04</option>
													<option>05</option>
													<option>06</option>
													<option>07</option>
													<option>08</option>
													<option>09</option>
													<option>10</option>
												</select> /
												<select>
													<option>2022</option>
													<option>2023</option>
													<option>2024</option>
												</select>
											</div>
											<p class="note">※カードに刻印されている表記のとおりにご選択ください。</p>
										</td>
									</tr>
									<tr>
										<th>カード名義</th>
										<td>
											<input type="text" class="big">
											<p class="note">※カードに刻印されている表記のとおりにご選択ください。</p>
										</td>
									</tr>
									<tr>
										<th>セキュリティコード</th>
										<td>
											<input type="text" class="small">
											<a href="#" class="link">▶セキュリティコードとは？</a>
										</td>
									</tr>
								</table>
								<p class="click"><a href="">登録できない場合はこちら</a></p>
							</div>
						</div>
						<div class="functeBtns">
							<a href="{{ route('chatroom.purchase.confirm', $proposal->id) }}" class="orange full">確認する</a>
						</div>
					</div>
				</div>
			</div>
		</div>
    </article>
</x-layout>