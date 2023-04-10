<x-layout>
	<script src="https://js.stripe.com/v3"></script>
    <article>
		<div id="breadcrumb">
			<div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('chatroom.index') }}">やりとり一覧</a>　>　
                <a href="{{ route('chatroom.show', $proposal->chatroom->id) }}">{{ $proposal->chatroom->reference->title }}</a>　>　
				<span>お支払い手続き</span>
            </div>
		</div><!-- /.breadcrumb -->
		<div id="contents" style="margin-bottom:35px;">
			<div class="cancelWrap">
				<div class="inner inner05">

					<h2 class="subPagesHd">お支払い手続き</h2>
					<form id="paymentform" action="{{ route('chatroom.purchase.confirm', $proposal->id) }}" method="post">
						@csrf
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
												@if(isset($proposal->chatroom->reference->productImage[0]))
													<p class="img"><img src="{{ asset('/storage/'.$proposal->chatroom->reference->productImage[0]->path)}}" alt=""></p>
												@else
													<p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
												@endif
												<div class="info">
													<p>{{ $proposal->chatroom->reference->title }}</p>
												</div>
											</div>
										</td>
										<td>¥{!! number_format($proposal->price) !!}</td>
									</tr>
									<tr>
										<td>
											<big>商品代金</big>
											{{-- <br>手数料  手数料は出品者負担に変更のため一旦コメントアウト--}}
										</td>
										<td>
											<big>¥{!! number_format($proposal->price) !!}</big>
											{{-- <br>¥{!! number_format($commission) !!} --}}
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td>合計</td>
										<td>¥{!! number_format($proposal->price) !!}</td>
										{{-- <td>¥{!! number_format($proposal->price + $commission) !!}</td> --}}
									</tr>
								</tfoot>
							</table>
						</div>{{-- /.payment --}}
                        <div class="warnNotes">
                            <p class="danger">ご注意！</p>
                            <p>※ポイントとクーポンの併用はできません。</p>
                            <p>※クーポンは他のクーポンとの併用はできません。</p>
                            <p>※決済後はポイント、クーポンのご利用はできません。</p>
                            <p>※ポイントは取引金額の10%までご利用いただけます。</p>
                        </div>

						@if($user_has_coupons->isEmpty())
						<p style="margin-top:5%;">現在ご利用いただけるクーポンはありません。</p>
						@else
						<div class="coupons">
							<div class="checkbox">
								@error('coupon_id')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                <p class="checkChoice"><label><input type="checkbox" name="coupon_use" value="1" @if(old('coupon_use') == 1) checked @endif>クーポンを利用する</label></p>
                                <div class="pointInput mt12">
                                    <p class="mr18">
                                        <select name="coupon_id" style="padding: 10px;" class="js-coupon">
                                            <option value="">選択してください</option>
                                            @foreach ($user_has_coupons as $coupon)
                                                <option value="{{$coupon->id}}" @if(old('coupon_id') == $coupon->id) selected @endif>{{$coupon->name}}:{{$coupon->content}}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                    {{-- <p class="adoptionBtn"><input type="button" value="適用"></p> --}}
                                </div>{{-- /.pointInput --}}

								<p class="detail">クーポンが選択されていません。</p>
								{{-- 最低利用金額などはこっちでやる、仕様未決定のため、一旦飛ばす --}}

                            </div>{{-- /.checkbox --}}
						</div>{{-- /.coupons --}}
						@endif

						<div class="radio">
							<p class="tit">ポイントの利用@error('user_use_point')<span>{{ $message }}</span>@enderror</p>
							<ul class="radioChoice">
								@error('point_use')<span>{{ $message }}</span>@enderror
								<li><label><input type="radio" name="point_use" value="0" @if(old('point_use') == 0 || old('point_use') === null) checked @endif>利用しない</label></li>
								<li><label><input type="radio" name="point_use" value="1" @if(old('point_use') == 1) checked @endif >利用する</label>
									<p class="point">利用可能ポイント：{{$user_has_point}}P</p>
									<div class="pointInput mt12">
										<p><input type="text" value="{{ old('user_use_point')}}" name="user_use_point"></p>
										{{-- <p class="adoptionBtn"><input type="button" value="適用"></p> --}}
									</div>
								</li>
							</ul>
						</div>{{-- /.radio --}}

						<div class="method">
							<p class="tit">お支払い方法@error('card_id')<span>{{ $message }}</span>@enderror</p>

							<div class="radioChoice">
								<label><input type="radio" name="payment_type" value="credit_card" checked>クレジット決済</label>
								<div class="marks">
									<img src="/img/cart_buy/ico_mark01.svg" alt="">
									<img src="/img/cart_buy/ico_mark02.svg" alt="">
									<img src="/img/cart_buy/ico_mark03.svg" alt="">
									<img src="/img/cart_buy/ico_mark04.svg" alt="">
									<img src="/img/cart_buy/ico_mark05.svg" alt="">
								</div>
							</div>{{-- /.radioChoice --}}

							@if(!empty($cards))
								<ul class="radioChoice" style="display:block;">
									@foreach($cards as $card)
										<div class="bl_credit-card-info">
											<input type="radio" name="card_id" value="{{ $card['id'] }}" @if(old('card_id', $cards[0]['id']) === $card['id']) checked @endif>
											<span class="credit-card-info-number">************{{ $card['last4'] }}</span>
											<span>{{ $card['name'] }}</span>
										</div>
									@endforeach
								</ul>
							@endif

							<div class="credit">
								<div class="radioChoice"><input id="immediate" type="radio" name="card_id" value="immediate" @if(old('card_id') === 'immediate') checked @endif>新しいカード
								@error('stripeToken')<div style="margin-left:10px;" class="alert alert-danger">{{ $message }}</div>@enderror
								<div id="card-error" class="alert alert-danger" style="margin-left:5px;" role="alert"></div>
							</div>

							<div style="padding: 10px;border: 1px solid #ccc;">

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
                                <div class="checkboxChoice">
                                    <label><input type="checkbox" name="is_credit_save" value="1">カードの情報を登録する</label>
                                </div>
							</div>{{-- /. --}}
							<p class="click"><a href="">登録できない場合はこちら</a></p>
						</div>{{-- /.method --}}
						<div class="functeBtns">
							<input type="hidden" class="" name="chatroom_id" value="{{$proposal->chatroom->id}}">
							<input type="submit" class="orange full loading-disabled" value="確認する">
						</div>
					</form>
				</div>{{-- /.inner --}}
			</div>{{-- /.cancelWrap --}}
		</div>{{-- /#contents --}}
    </article>
</x-layout>

<script>
let user_has_coupons = @json($user_has_coupons);

	if('{{ config('stripe.stripe_public_key') }}') {

		// publishable API keyをセットする
		const stripe = Stripe('{{ config('stripe.stripe_public_key') }}');
		const elements = stripe.elements();

		const elementStyles = { 
			base: {
				// 入力した文字のサイズ
				fontSize: '16px',
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
				fontSize: '16px',
				color: "#111111",
				width: "30px",
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

		// カードの有効期限
		const cardExpiry = elements.create('cardExpiry', {style: elementStyles});
		cardExpiry.mount('#card-expiry');

		// カードのCVC入力
		const cardCvc = elements.create('cardCvc', {style: elementSmallStyles});
		cardCvc.mount('#card-cvc');

		const form = document.getElementById('paymentform');

        // 新しいカードを選択している時、Stripeトークン生成
        form.addEventListener('submit', function(event) {
            const checkValue = $('input:radio[name="card_id"]:checked').val();
            event.preventDefault();
            if(checkValue == 'immediate'){
                stripe.createToken(cardNumber,{name: document.querySelector('#cardName').value}).then(function(result) {
                    if (result.error) {
                        // エラーがあった場合、エラーを表示
                        const errorElement = document.getElementById('card-error');
                        errorElement.textContent = result.error.message;
                        // form.submit();
                    } else {
                        // エラーがない場合、トークン送信
                        stripeTokenHandler(result.token);
                    }
                });
            }else{
                const form = document.getElementById('paymentform');
                form.submit();
            }
        });
        
        function stripeTokenHandler(token) {
            // トークンIDを付加してフォームデータをサブミット
            const form = document.getElementById('paymentform');
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            preventEvent = false;

            // フォーム送信
            form.submit();
        }
	} else {
	// stripe key未設定の時
		const form = document.getElementById('paymentform');
		
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

	//セレクトボックスが切り替わったら発動
	$('.js-coupon').change(function() {
	
		//選択したvalue値を変数に格納
		var id = $(this).val();
		
		user_has_coupons.forEach(function(val){
			if(val.id == id){
				//選択したvalue値をp要素に出力
				$('p.detail').text(val.discount + '円割引クーポン(合計' + val.min_price + '円以上のサービスでご利用可能)' + val.deadline + 'まで');
			} else {
				$('p.detail').text('クーポンが選択されていません。');
			}
		});

	})
</script>