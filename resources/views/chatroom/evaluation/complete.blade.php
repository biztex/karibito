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
					<div class="cancelRea">
						@if($chatroom->status === App\Models\Chatroom::STATUS_SELLER_EVALUATION)
							<p class="reason" style="text-align: left">出品者の方への評価が完了しました。<br>この後、出品者の方からの評価が完了すると取引完了となります。</p>
						@else
							<p class="reason" style="text-align: left">
                                購入者の方への評価が完了しました。<br />
                                これをもって取引完了となります。お疲れ様でした。<br />
                                振込申請は期限内に忘れずに行ってください。
                            </p>
						@endif
					</div>
					@if($survey->isEmpty())
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
					@else
						<div class="functeBtns">
							<a href="{{ route('chatroom.show', $chatroom->id) }}" class="red">チャットに戻る</a>
						</div>
					@endif
				</div>
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>