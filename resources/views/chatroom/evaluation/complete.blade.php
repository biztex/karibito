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
				
					<x-parts.chatroom-step :value="$chatroom"/>

					<div class="cancelTitle">
						<h2>評価が完了しました</h2>
					</div>
					<div class="cancelRea">
						@if($chatroom->status === App\Models\Chatroom::STATUS_SELLER_EVALUATION)
							<p class="reason">契約者からの評価が終わると取引完了となります。<br>しばらくお待ちください。</p>
						@else
							<p class="reason">取引が完了しました。</p>
						@endif
					</div>
					@if($survey->isEmpty())
						<div class="cancelRea st2">
							<p class="reason">カリビトアプリを利用してみていかがだったでしょうか？<br>カリビトへの評価をお願いします。</p>
							<p class="logo"><img src="/img/cart_buy/logo.svg" alt=""></p>
							<div class="functeBtns">
								<a href="{{ route('survey.create',$chatroom) }}" class="red">評価を投稿する</a>
							</div>
						</div>
					@else
						<div class="functeBtns">
							<a href="{{ route('chatroom.show', $chatroom->id); }}" class="red">チャットに戻る</a>
						</div>
					@endif
				</div>
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>