<x-layout>
<script src="https://js.stripe.com/v3"></script>
<body id="setting-page">
<x-parts.post-button/>
	<article>
		<div id="breadcrumb">
                <div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<a href="{{ route('setting.index') }}">会員情報</a>　>　<span>クレジットカード情報</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
            <div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">クレジットカード</h2>
							<div class="configEditBox">
								<div class="configEditList" style="margin-bottom:35px;">
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
												<form action="{{ route('setting.card.destroy', $card['id']) }}" method="post" class="configEditDeleteBtn">
													@csrf @method('delete')
													<button type="submit" onclick='return confirm("削除してもよろしいですか？");'>削除</button>
												</form>
											</div>
										@endforeach
									@endif
								</div>
								<form id="payment-form" action="{{ route('setting.card.store') }}" method="post">
									@csrf
									<div class="configEditList">
										<h3 class="mypageEditHd">新しいカード情報　<span id="card-error"></span></h3>
										<div style="padding: 10px;border: 1px solid #ccc;" class="">
											
											<div class="creditField">
												<div id="label">カード番号</div>
												<div class="stripeCreditCardElements">
													<div class="creditCardElements" id="card-number"></div>
													<p class="noticeP">例）1234567890123456</p>
												</div>
											</div>

											<div class="creditField">
												<div id="label">有効期限</div>
												<div class="stripeCreditCardElements">
													<div class="creditCardElements" id="card-expiry"></div>
													<p class="noticeP">※カードに刻印されている表記のとおりにご選択ください。</p>
												</div>
											</div>

											<div class="creditField">
												<div id="label">カード名義</div>
												<div class="stripeCreditCardElements">
													<div class="mypageEditInput"><input type="text" name="cardName" id="cardName" placeholder=""></div>
													<p class="noticeP">※カードに刻印されている表記のとおりにご選択ください。</p>
												</div>
											</div>

											<div class="creditField">
												<div id="smallLabel">セキュリティコード</div>
												<div class="creditCode">
													<div class="stripeCreditCardElements">
														<div id="card-cvc" class="creditCardElements small"></div>
													</div>
													<a href="#" class="link">▶セキュリティコードとは？</a>
													<div class="creditCodeBox">
														<p>セキュリティコードの場所</p>
														<div class="creditCodeImg">
															<img src="/img/cart_buy/security_guide_3.png" alt="">
														</div>
														<p>※カードの裏に記載されている<br>3桁のコードをご記入ください。</p>
													</div>
												</div>
												
											</div>
											<div class="configEditButton">
												<input class="" type="submit" value="登録">
											</div>
										</div>
									</div>
								</form>
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
	if('{{ config('stripe.stripe_public_key') }}') {

		// publishable API keyをセットする
		const stripe = Stripe('{{ config('stripe.stripe_public_key') }}');
		const elements = stripe.elements();

		// カード番号・有効期限・名義入力欄用
		const elementStyles = { 
			base: {
				// 入力した文字のサイズ
				fontSize: '14px',
				// 入力した文字の色
				color: "#111111",
				// プレースホルダーの文字色
				'::placeholder': {
					color: '#d3d3d3'
				}
			}
			// エラー時の入力した文字色と左のカードアイコンの色
			,invalid: {
				color: '#ff5f3f',
				iconColor: '#ff5f3f'
			}
		};

		// セキュリティーコード入力欄用 
		const elementSmallStyles = {
			base: {
				fontSize: '14px',
				color: "#111111",
				'::placeholder': {
					color: '#ffffff'
				}
			}
			,invalid: {
				color: '#ff5f3f',
				iconColor: '#ff5f3f'
			}
		};

		// カード番号
		const cardNumber = elements.create('cardNumber', {style: elementStyles});
		cardNumber.mount('#card-number');

		// 有効期限
		const cardExpiry = elements.create('cardExpiry', {style: elementStyles});
		cardExpiry.mount('#card-expiry');

		// セキュリティーコード
		const cardCvc = elements.create('cardCvc', {style: elementSmallStyles});
		cardCvc.mount('#card-cvc');

		// トークンの生成、またはサブミット時のエラーを表示
		const form = document.getElementById('payment-form');
		form.addEventListener('submit', function(event) {
			// デフォルトのsubmit動作を止める
			event.preventDefault();
			stripe.createToken(cardNumber,{name: document.querySelector('#cardName').value}).then(function(result) {
				if (result.error) {
					// エラーがあった場合、エラーを表示
					const errorElement = document.getElementById('card-error');
					errorElement.textContent = result.error.message;
				} else {
					// エラーがない場合、トークン送信
					stripeTokenHandler(result.token);
				}
			});
		});
		function stripeTokenHandler(token) {
			// トークンIDを付加してフォームデータをサブミット
			const form = document.getElementById('payment-form');
			const hiddenInput = document.createElement('input');
			hiddenInput.setAttribute('type', 'hidden');
			hiddenInput.setAttribute('name', 'stripeToken');
			hiddenInput.setAttribute('value', token.id);
			form.appendChild(hiddenInput);
			// フォーム送信
			form.submit();
		}

	} else {
		// stripe key未設定の時
		const form = document.getElementById('payment-form');
	
		form.addEventListener('submit', function(event) {
			event.preventDefault();
			const hiddenInput = document.createElement('input');
			hiddenInput.setAttribute('type', 'hidden');
			hiddenInput.setAttribute('name', 'stripeToken');
			hiddenInput.setAttribute('value', 'tok_xxx');
			form.appendChild(hiddenInput);
			// フォーム送信
			form.submit();
		});
	};
	
</script>