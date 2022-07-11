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
					<div class="cancelTitle">
						<h2>お支払いが完了いたしました</h2>
					</div>
					<div class="cancelRea">
						<p class="reason">チケットの購入が完了しました。</p>
					</div>
					<div class="functeBtns">
						<a href="{{route('chatroom.product.show', $product_proposal->productChatroom->id)}}">やりとり画面に戻る</a>
					</div>
				</div>
			</div>
		</div>
    </article>
</x-layout>