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
					{{-- 修正必要 --}}
					<ul id="chatroomStepUl" class="stepUl">
						<li class="is_active">
							<p class="stepDot"></p>
							<p class="stepTxt">チャット開始</p>
						</li>
						<li @if($purchased_cancel->purchase->chatroom->status >= App\Models\Chatroom::STATUS_PROPOSAL) class="is_active" @endif>
							<p class="stepDot"></p>
							<p class="stepTxt">契約</p>
						</li>
						<li @if($purchased_cancel->purchase->chatroom->status >= App\Models\Chatroom::STATUS_BUYER_EVALUATION) class="is_active" @endif>
							<p class="stepDot"></p>
							<p class="stepTxt">評価</p>
						</li>
					</ul>

					<div class="cancelTitle">
						<h2>キャンセル申請を承認しました！</h2>
					</div>
					<div class="cancelRea">
						<p>キャンセルは双方の評価入力をもって完了します。<br>チャット画面からお相手の方の評価を入力してください。</p>
					</div>
					<div class="functeBtns">
						<a href="{{ route('chatroom.show', $purchased_cancel->purchase->chatroom_id) }}">チャット画面に戻る</a>
					</div>
				</div>
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>
