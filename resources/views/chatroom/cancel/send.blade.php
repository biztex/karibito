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

					<x-parts.chatroom-step :value="$purchased_cancel->purchase->chatroom"/>

					<div class="cancelTitle">
						<h2>キャンセル申請が完了しました！</h2>
					</div>
                    <div class="cancelReason">
                        <p>キャンセル理由：</p>
                        <div class="cancelRea"><p class="reason">
                                @for($i=1; $i<7; $i++)
                                    @if($purchased_cancel['reason'.$i] == "1")
                                        {{App\Models\PurchasedCancel::REASON[$i]}}<br/>
                                        <input type="hidden" name="reason{{$i}}" value="on">
                                    @endif
                                @endfor
                            </p>
                        </div>
                    </div>
                    <div class="evaluation">
                        <p>キャンセル理由の詳細</p>
                        <textarea readonly>{{ $purchased_cancel->text }}</textarea>
                    </div>
					<div class="cancelRead mt20">
						<p>
                            相手の方がキャンセル申請に「承認」した場合、または「再交渉」を選択しないまま72時間が経過した場合にキャンセル成立となります。
                            <br>
                            キャンセル成立後、双方が評価を入力した時点でキャンセル完了となり、決済方法に応じてサービス手数料を含む代金が購入者の方に返金されます。
                            <br>
                            「再交渉」となった場合は、再度チャットにてすり合わせを行ってください。
                        </p>
					</div>
					<div class="functeBtns">
						<a href="{{ route('chatroom.show', $purchased_cancel->purchase->chatroom_id) }}">チャット画面に戻る</a>
					</div>
				</div>
			</div>
		</div>
    </article>
</x-layout>
