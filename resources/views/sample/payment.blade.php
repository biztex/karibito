<h3>決済デモ</h3>
<h4>決済実行</h4>
<a href="https://pay.jp/docs/api/?php#%E6%94%AF%E6%89%95%E3%81%84%E3%82%92%E4%BD%9C%E6%88%90">https://pay.jp/docs/api/?php#%E6%94%AF%E6%89%95%E3%81%84%E3%82%92%E4%BD%9C%E6%88%90</a>
<form action="{{ route('sample.createCharge') }}" method="post">
    @csrf
    @if(config('payjp.secret_key'))
        <script
                src="https://checkout.pay.jp/"
                class="payjp-button"
                data-key="{{ config('payjp.public_key') }}"
                data-text="カード情報を入力"
                data-submit-text="カードを登録する"
        ></script>
    @else
        <input type="hidden" name="payjp-token" value="stub">
        <button>決済</button>
    @endif
</form>



<h4>クレカ登録</h4>
<a href="https://pay.jp/docs/api/?php#%E9%A1%A7%E5%AE%A2%E3%82%92%E4%BD%9C%E6%88%90">https://pay.jp/docs/api/?php#%E9%A1%A7%E5%AE%A2%E3%82%92%E4%BD%9C%E6%88%90</a>
<script src="https://js.pay.jp/v2/pay.js"></script>
<style>
    /* 必要に応じてフォームの外側のデザインを用意します */
    div.payjs-outer {
        border: thin solid #198fcc;
    }
</style>
<form action="{{ route('sample.createCard') }}" method="post" name="createCustomer">
    @csrf
    @if(config('payjp.secret_key'))
        <input type="hidden" id='payjp-token' name="createCustomer-payjp-token">
        <div id="v2-demo" class="payjs-outer"><!-- ここにフォームが生成されます --></div>
        <button onclick="onSubmit(event)">トークン作成</button>
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

<h4>クレカ一覧取得</h4>
<a href="https://pay.jp/docs/api/?php#%E9%A1%A7%E5%AE%A2%E6%83%85%E5%A0%B1%E3%82%92%E5%8F%96%E5%BE%97">https://pay.jp/docs/api/?php#%E9%A1%A7%E5%AE%A2%E6%83%85%E5%A0%B1%E3%82%92%E5%8F%96%E5%BE%97</a>
<div>
    <a href="{{ route('sample.getCardList') }}">クレカ一覧取得</a>
</div>