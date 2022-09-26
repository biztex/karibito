<x-layout>
<body id="transfer">
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
						<div class="memberConfigBox bankTransferBox">
							<div class="memberConfigItem">
								<p class="memberConfigHd">現在：{{ date('Y年n月j日 ', strtotime(today())) }}</p>
								<ul class="bankTransferList">
									<li class="bankTransferItem">
										<p class="bankTransferLabel">提供の売上金残高</p>
										<p class="bankTransferPrice"><span class="bankTransferNum">{{ number_format($profit['product']) }}</span>円</p>
									</li>
									<li class="bankTransferItem">
										<p class="bankTransferLabel">リクエストの売上金残高</p>
										<p class="bankTransferPrice"><span class="bankTransferNum">{{  number_format($profit['job_request']) }}</span>円</p>
									</li>
									<li class="bankTransferItem">
										<p class="bankTransferLabel">合計売上金残高</p>
										<p class="bankTransferPrice"><span class="bankTransferNum">{{  number_format($profit['total']) }}</span>円</p>
									</li>
								</ul>
								<div class="bankTransferBtnWrap">
									{{-- <a href="" class="bankTransferBtn">ポイントに交換する</a> --}}
									@if($profit['total'] <= 0)
										<a href="" onclick='return confirm("売上金残高がございません");' class="bankTransferBtn">振り込み申請をする</a>
									@elseif(Auth::user()->bankAccount !== null)
										<form action="{{ route('transfer_request.store') }}" method="post">
											@csrf
											<button type="submit" onclick='return confirm("合計売上金残高の振込を申請しますか？");'  class="bankTransferBtn">振り込み申請をする</button>
										</form>
									@else
										<a href="{{ route('setting.bank.edit') }}" onclick='return confirm("振込口座の登録が必要です");' class="bankTransferBtn">振り込み申請をする</a>
									@endif
								</div>
								<div class="bankTransferAttention">
									<p>※終了した取引のみ売り上げに反映されます。</p>
									<p>※売上金額は金額から5.5%のサイトの手数料が引かれた金額が表示されています。</p>
									<p>振込日は「15日締め翌月1日払い」「月末締め翌月16日払い」の月2回です。（土日祝の場合は翌営業日中）</p>
									<p>※1回の振込に振込手数料390円がかかります。</p>
									<p>※振込申請期限内（報酬確定後から3ヶ月以内）に必ず振込申請してください。</p>
									<p>※振込先口座が未記入の場合、振込申請期限が過ぎると報酬を受理する権利が失効します。</p>
									<p>※振込口座情報の入力に誤りがあり振込に失敗した場合、再度振込手数料の390円がかかりますのでご注意ください。</p>
									@if($exist_fail)
										<p>※合計売上残高には振込失敗された回数分の手数料が差し引かれた金額が表示されています。</p>
									@endif
								</div>
							</div>
						</div>
					</div>
					@if(count($transfer_request) > 0)
						<div class="subPagesWrap evaluationWrap">
							<h2 class="subPagesHd">振込申請履歴</h2>
							<div class="memberConfigBox bankTransferBox bankTransferHistoryBox">
								<ul class="bankTransferList">
									@foreach($transfer_request as $value)
										<a href="{{ route('transfer_request.show', $value->id) }}" class="bankTransferItem">
											<div class="bankTransferHalf">
												<p class="bankTransferDate">{{ date('Y年n月j日 H:i', strtotime($value->requested_at)) }}</p>
												<p class="bankTransferText">{{ \App\Models\TransferRequest::STATUS[$value->status] }}</p>
											</div>
											<div class="bankTransferHalf">
												<span class="bankTransferPrice">{{ number_format($value->amount) }}円</span>
											</div>
										</a>
									@endforeach
								</ul>
							</div>
						</div>
					@endif
				</div><!-- /#main -->
				<x-side-menu/>

			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>