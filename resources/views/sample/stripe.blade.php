<x-layout>
    <script src="https://js.stripe.com/v3"></script>
	<style>
		.field {
            display: flex;
            padding: 2px;
        }
        #label  {
            font-size: 12px;
            padding: 17px 20px;
            width: 174px;
            text-align: right;
            background-color: #F5F5F5;
            vertical-align: middle;
            white-space: nowrap;
        }
		/* カード情報入力欄 */
		.StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            /* box-shadow: 0 1px 3px 0 #e6ebf1; */
            /* -webkit-transition: box-shadow 150ms ease; */
            /* transition: box-shadow 150ms ease; */
            border: 1px solid #DDDDDD;
            background-color: #fff;
            border-radius: 3px;
            /* font-size: 1.4rem; */
            /* width: auto; */
            height: 40px;
		}
		/* ボタン */
		#btn {
		  display: inline-block;
		  height: 40px;
		  line-height: 40px;
		}
		
		/* 入力欄にフォーカスされた時 */
		.StripeElement--focus {
		}
		/* エラー時の入力欄枠線の色 */
		.StripeElement--invalid {
		  border-color: #ff5f3f;
		}
		/* オートコンプリートで入力した時 */
		.StripeElement--webkit-autofill {
		  background-color: #beddf9 !important;
		}
		/* 入力欄の下に出るエラーメッセージの文字色 */
		#card-errors {
			color: #ff5f3f;
		}
	</style>
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
                                <div class="configEditBox"> {{-- .card-body --}}
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
                                    <form action="{{ route('stripe.create.card') }}" method="post" id="payment-form">
                                        @csrf
                                        <div class="configEditList">
										    <h3 class="mypageEditHd">新しいカード情報　@if($errors->any())<span>※正しい情報を入力してください</span>@endif</h3>
                                            <div style="padding: 10px;border: 1px solid #ccc;" class="">
                                                <div class="field">
                                                    <div id="label">カード番号</div>
                                                    <div style="padding:10px;width:70%;">
                                                        <div id="card-number"></div>
                                                        <p class="noticeP" style="color: #737878;font-size: 1.3rem;margin-top: 3px;">例）1234567890123456</p>
                                                    </div>
                                                </div>

                                                <div class="field">
                                                    <div id="label">有効期限</div>
                                                    <div style="padding:10px;width:70%;">
                                                        <div id="card-expiry"></div>
                                                        <p class="noticeP" style="color: #737878;font-size: 1.3rem;margin-top: 3px;">※カードに刻印されている表記のとおりにご選択ください。</p>
                                                    </div>
                                                </div>

                                                <div class="field">
                                                    <div id="label">カード名義</div>
                                                    <div style="padding:10px;width:70%;">
														<div class="mypageEditInput"><input type="text" name="cardName" id="cardName" placeholder=""></div>
                                                        <p class="noticeP" style="color: #737878;font-size: 1.3rem;margin-top: 3px;">※カードに刻印されている表記のとおりにご選択ください。</p>
                                                    </div>
                                                </div>

                                                <div class="field" style="align-items:center">
                                                    <div id="label">セキュリティーコード</div>
                                                    <div style="padding:10px;width:30%;">
                                                        <div id="card-cvc"></div>
                                                        
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
  	// publishable API keyをセットする
  	const stripe = Stripe('{{ config('stripe.stripe_public_key') }}');
	const elements = stripe.elements();

    const elementStyles = { 
        base: {
	  	// 入力した文字のサイズ
	    fontSize: '16px',
	    // 入力した文字の色
	    color: "#1847a2",
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
     const elementSmallStyles = {
        base: {
            // 入力した文字のサイズ
            fontSize: '16px',
            // 入力した文字の色
            color: "#1847a2",
            width: "30px",
            // プレースホルダーの文字色
            '::placeholder': {
            color: '#fff'
            }
        }
        // エラー時の入力した文字色と左のカードアイコンの色
        ,invalid: {
            color: '#ff5f3f',
            iconColor: '#ff5f3f'
        }
     }


    // カード番号
    const cardNumber = elements.create('cardNumber', {
    style: elementStyles,
    // classes: elementClasses,
    });
    cardNumber.mount('#card-number');

    // カードの有効期限
    const cardExpiry = elements.create('cardExpiry', {
    style: elementStyles,
    // classes: elementClasses,
    });
    cardExpiry.mount('#card-expiry');

    // カードのCVC入力
    const cardCvc = elements.create('cardCvc', {
    style: elementSmallStyles,
    // classes: elementClasses,
    });
    cardCvc.mount('#card-cvc');

	// トークンの生成、またはサブミット時のエラーを表示
	const form = document.getElementById('payment-form');
	form.addEventListener('submit', function(event) {
	  // デフォルトのsubmit動作を止める
      console.log(cardNumber);
	  event.preventDefault();
	  stripe.createToken(cardNumber,{name: document.querySelector('#cardName').value}).then(function(result) {
	    if (result.error) {
            console.log(result.error);
	      // エラーがあった場合、エラーを表示
	      const errorElement = document.getElementById('card-errors');
	      errorElement.textContent = result.error.message;
	    } else {
            console.log('token');
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
   </script>