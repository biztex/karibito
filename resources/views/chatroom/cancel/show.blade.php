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
						<h2>キャンセル申請が届いています！</h2>
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
                    <div class="cancelRea mt20">
                        <p>
                            「承認する」を選択した場合、キャンセル成立となります。引き続きお相手の方の評価を入力してください。双方の評価入力が完了した時点でキャンセル完了となり、決済方法に応じてサービス手数料を含む代金が購入者の方に返金されます。「再交渉する」を選択した場合は、再度チャットにてすり合わせを行ってください。72時間以内に「承認する」も「再交渉する」も選択しなかった場合は自動的に「承認する」が選択され、評価入力へと進みます。
                        </p>
                    </div>
					<div class="functeBtns">
						<form id="form" action="" method="">
						@csrf
							<input type="submit" formaction="{{ route('cancel.approval', $purchased_cancel->id) }}" formmethod="post" class="blue loading-disabled" value="承認する">
							<input type="submit" formaction="{{ route('cancel.objection', $purchased_cancel->id) }}" formmethod="get" class="loading-disabled" value="再交渉する">
						</form>
					</div>
				</div>
			</div>
		</div><!-- /#contents -->
    </article>
</x-layout>
