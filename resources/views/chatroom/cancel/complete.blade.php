<x-layout>
    <article>
		<div id="breadcrumb">
            <div class="inner">
                    <a href="{{ route('home') }}">ホーム</a>　>　
                    <a href="{{ route('chatroom.index') }}">やり取り一覧</a>　>　
				@if($purchased_cancel->purchase->chatroom->reference === 'App\Models\Product')
                    <a href="{{ route('product.show', $purchased_cancel->purchase->chatroom->reference_id) }}">{{$purchased_cancel->purchase->chatroom->referencePurchased->title}}</a>　>　
                @else <!-- JobRequest-->
                    <a href="{{ route('job_request.show', $purchased_cancel->purchase->chatroom->reference_id) }}">{{$purchased_cancel->purchase->chatroom->referencePurchased->title}}</a>　>　
                @endif
                    <span>キャンセル手続き</span>
            </div>
        </div><!-- /.breadcrumb -->
		<div id="contents" style="margin-bottom:35px;">
			<div class="cancelWrap">
				<div class="inner inner05">
					<div class="cancelTitle">
						<h2>キャンセル申請を承認しました！</h2>
					</div>
					<div class="cancelRea">
						<p>
                            キャンセルは双方の評価入力をもって完了します。<br />
                            チャット画面からお相手の方の評価を入力してください。
                        </p>
					</div>
					<div class="functeBtns">
						<a href="{{ route('chatroom.show', $purchased_cancel->purchase->chatroom_id) }}">チャット画面に戻る</a>
					</div>
				</div>
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>
