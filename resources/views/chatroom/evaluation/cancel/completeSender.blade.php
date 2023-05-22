<x-layout>
    <article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('chatroom.index') }}">やりとり一覧</a>　>　
                <a href="{{ route('chatroom.show', $chatroom->id) }}">{{ $chatroom->referencePurchased->title }}</a>　>　
				<span>評価</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div id="contents" style="margin-bottom:35px;">
			<div class="cancelWrap">
				<div class="inner inner05">
					<div class="cancelTitle">
						<h2>評価が完了しました！</h2>
					</div>
                    <div class="cancelSubText">
                        <p>お相手の方への評価が完了しました。　</p>
                        <p>この後、お相手の方からの評価が完了するとキャンセル完了となります。</p>
                        <br>
                        <br>
                    </div>
					<div class="cancelRea"></div>
                    <div class="cancelRea st2">
                        <p class="reason">アンケートに答えてクーポンゲット！！</p>
                        <p>カリビトをご利用いただきありがとうございます。</p>
                        <p>今後より良いサービスにするために、カリビトを利用してのご感想やご要望をお聞かせください。</p>
                        <p>ご協力いただくと100円OFFクーポンプレゼント！</p><br>
                        <p class="logo"><img src="/img/cart_buy/logo.svg" alt=""></p>
                        <div class="functeBtns">
                            <a href="{{ route('survey.create',$chatroom) }}" class="red">アンケートに答える</a>
                        </div>
                    </div>
				</div>
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>
