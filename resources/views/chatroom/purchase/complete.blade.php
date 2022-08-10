<x-layout>
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

					<x-parts.chatroom-step :value="$proposal->chatroom"/>

					<div class="cancelTitle">
						<h2>お支払いが完了いたしました</h2>
					</div>
					<div class="cancelRea">
						<p class="reason">チケットの購入が完了しました。</p>
					</div>
					<div class="functeBtns">
						<a href="{{route('chatroom.show', $proposal->chatroom->id)}}">やりとり画面に戻る</a>
					</div>
				</div>
			</div>
		</div>
    </article>
</x-layout>