<x-layout>
<body id="member-page">
<x-parts.post-button/>
	<article>
		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
            <div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">クレジットカード</h2>
							<div class="configEditBox">
								<div class="configEditList">
									@if(!empty($cards))
										<h3 class="mypageEditHd">現在のカード情報</h3>
										@foreach($cards as $card)
											<div class="configEditTable">
												<table>
													<tr>
														<th>カード番号</th>
														<td>************{{ $card['last4'] }}</td>
													</tr>
													<tr>
														<th>カード名義人</th>
														<td>{{ $card['name'] }}</td>
													</tr>
												</table>
												<a href="{{ route('member_config.card.destroy', $card['id']) }}" class="configEditDeleteBtn">削除</a>
											</div>
										@endforeach
									@endif
								</div>
								
								<script src="https://js.pay.jp/v2/pay.js"></script>
								<style>
									/* 必要に応じてフォームの外側のデザインを用意します */
									div.payjs-outer {
										border: thin solid #198fcc;
									}
								</style>
								<form action="{{ route('member_config.card.store') }}" method="post" name="createCustomer">
									@csrf
									@if(config('payjp.secret_key'))
										<input type="hidden" id='payjp-token' name="createCustomer-payjp-token">
										<div id="v2-demo" class="payjs-outer"><!-- ここにフォームが生成されます --></div>
										<button onclick="onSubmit(event)">登録</button>
										<span id="token"></span>

										<script>
											// 公開鍵を登録し、起点となるオブジェクトを取得します
											var payjp = Payjp('{{ config('payjp.public_key') }}')

											// elementsを取得します。ページ内に複数フォーム用意する場合は複数取得ください
											var elements = payjp.elements()

											// element(入力フォームの単位)を生成します
											var cardElement = elements.create('card')

											// elementをDOM上に配置します
											cardElement.mount('#v2-demo')

											// ボタンが押されたらtokenを生成する関数を用意します
											function onSubmit(event) {
												payjp.createToken(cardElement).then(function(r) {
													document.querySelector('#token').innerText = r.error ? r.error.message : r.id
													document.querySelector('[name="createCustomer-payjp-token"]').value = r.error ? r.error.message : r.id
													console.log(document.querySelector('[name="createCustomer-payjp-token"]').value)
													setTimeout(document.createCustomer.submit(), 5000);
												})
											}
										</script>
									@else
										<input type="hidden" name="createCustomer-payjp-token" value="stub">
										<button>クレカ登録</button>
									@endif
								</form>
	
									
									<div class="configEditList">
										<h3 class="mypageEditHd">新しいカード情報</h3>
										<div class="configEditTable">
											<table>
												<tr>
													<th>カード番号</th>
													<td>
														<div class="mypageEditInput"><input type="tell" name="cc_number" placeholder="" maxlength="19" pattern="([0-9]| )*"></div>
														<p class="noticeP">例）1234567890123456</p>
													</td>
												</tr>
												<tr>
													<th>有効期限</th>
													<td>
														<div class="mypageEditInput flexLine02">
															<select name="exp_month">
																@for($i=1; $i<=12; $i++)
																	<option value="{{$i}}" @if($i == old('ccmonth')) selected @endif>{{sprintf('%02d', $i)}}</option>
																@endfor
															</select>
															<span class="span">/</span>
															<select name="exp_year">
																@for($i=2022; $i<=2030; $i++)
																	<option value="{{$i}}" @if($i == old('ccyear')) selected @endif>{{$i}}</option>
																@endfor
															</select>
														</div>
														<p class="noticeP">※カードに刻印されている表記のとおりにご選択ください。</p>
													</td>
												</tr>
												<tr>
													<th>カード名義</th>
													<td>
														<div class="mypageEditInput"><input type="text" name="cc_name" placeholder=""></div>
													<p class="noticeP">※カードに刻印されている表記のとおりにご選択ください。</p>
													</td>
												</tr>
												<tr>
													<th>セキュリティコード</th>
													<td class="creditCode">
														<input type="tell" name="cvc" class="small" maxlength="4">
														<a href="#" class="link">▶セキュリティコードとは？</a>
														<div class="creditCodeBox">
															<p>セキュリティコードの場所</p>
															<div class="creditCodeImg">
																<img src="/img/cart_buy/security_guide_3.png" alt="">
															</div>
															<p>※カードの裏に記載されている<br>3桁のコードをご記入ください。</p>
														</div>
													</td>
												</tr>
											</table>
										</div>
									</div>

									<div class="configEditButton">
										<input class="loading-disabled" type="submit" value="登録" name="">
									</div>
							</div>
						</div>

					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-layout>
