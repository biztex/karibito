<x-layout>
    <article>
    <div id="breadcrumb">
			<div class="inner">
				<a href="{{route('home')}}">ホーム</a>　>　<a href="#">やること</a>　>　<span>お支払い手続き</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div id="contents">
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
											<p class="img"><img src="img/common/img_work01@2x.jpg" alt=""></p>
											<div class="info">
												<p>ダミータイトル・ダミータイトルだ…ダミータイトル・ダミータイトル・ダミータイトル・ダミータイトル・</p>
												<p class="link"><a href="#">機密保持契約(NDA)</a></p>
											</div>
										</div>
									</td>
									<td>¥10,000</td>
								</tr>
								<tr>
									<td><big>商品代金</big><br>手数料<br><font class="colorRed">500円割引クーポン(合計3,000円以上のサービスでご利用可能)／2022年02月08日まで</font></td>
									<td><big>¥10,000</big><br>¥500<br><font class="colorRed">¥-500</font></td>
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
						<div class="method">
							<p class="tit">お支払い方法</p>
							<div class="credit">
								<table>
									<tr>
										<th>カード番号</th>
										<td>1234567890123456</td>
									</tr>
									<tr>
										<th>有効期限</th>
										<td>22年/4月</td>
									</tr>
									<tr>
										<th>カード名義</th>
										<td>dummy text</td>
									</tr>
									<tr>
										<th>セキュリティコード</th>
										<td>123</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="warnNotes mt50">
							<p class="danger">ご注意！</p>
							<p>※他のクーポンと併用はできません。</p>
						</div>
						<div class="functeBtns">
							<form action="{{route('chatroom.product.purchesed', $product_proposal->id)}}" method="post">
							@csrf
								<input type="submit" class="orange full" value="確定する">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    </article>
</x-layout>