<x-layout>
<body id="transfer-show">
    <x-parts.post-button/>
    <article>
        <div id="breadcrumb">
                <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　<span>売上管理・振込申請</span>
            </div>
        </div><!-- /.breadcrumb -->
        <x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">

					<div class="subPagesWrap evaluationWrap">
						<h2 class="subPagesHd">売上管理・振込申請</h2>
						<div class="memberConfigBox bankTransferBox bankTransferHistoryBox">
							<div class="memberConfigItem">
								<ul class="bankTransferList">
									<li class="bankTransferItem">
										<div class="bankTransferHalf">
											<p class="bankTransferDate">申請日：{{ date('Y年n月j日', strtotime($transfer_request->requested_at)) }}</p>
											<p class="bankTransferText">{{ \App\Models\TransferRequest::STATUS[$transfer_request->status] }}</p>
										</div>
										<div class="bankTransferHalf">
											<span class="bankTransferPrice">{{ number_format($transfer_request->amount) }}円</span>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>

					
						<div class="subPagesWrap evaluationWrap">
							<h2 class="subPagesHd">売上金内訳</h2>
							<div class="memberConfigBox bankTransferBox bankTransferHistoryBox">
							<div class="memberConfigItem">
								<ul class="bankTransferList">
									@foreach($transfer_request_details as $value)
										@if($value->profit->chatroom_id === null && $value->profit->amount === -390)
										<a href="" class="bankTransferItem">
											<div class="bankTransferHalf">
												<p class="bankTransferType">手数料</p>
												<p class="bankTransferDate">{{ date('Y年n月j日 H:i', strtotime($value->profit->created_at)) }}</p>
												<p class="bankTransferText">振込手数料</p>
											</div>
											<div class="bankTransferHalf">
												<span class="bankTransferPrice">{{ number_format($value->profit->amount) }}円</span>
											</div>
										</a>
										@else
											<a href="{{ route('chatroom.show', $value->profit->chatroom_id) }}" class="bankTransferItem">
												<div class="bankTransferHalf">
													@if($value->profit->chatroom->reference_type === 'App\Models\Product')
														<p class="bankTransferType">提供</p>
													@else
														<p class="bankTransferType">リクエスト</p>
													@endif
													<p class="bankTransferDate">取引完了日：{{ date('Y年n月j日 H:i', strtotime($value->profit->created_at)) }}</p>
													<p class="bankTransferText">{{ $value->profit->chatroom->reference->title }}</p>
												</div>
												<div class="bankTransferHalf">
													
													<span class="bankTransferPrice">{{ number_format($value->profit->amount) }}円</span>
												</div>
											</a>
										@endif
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>

			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>