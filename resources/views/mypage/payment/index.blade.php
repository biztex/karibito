<x-layout>
<body id="payment">
	<x-parts.post-button/>
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>支払い履歴</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.ban-msg/>
		<x-parts.post-button/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap">
						<h2 class="subPagesHd">支払い履歴</h2>
						<div class="subPagesTab tabWrap">
							{{-- <ul class="tabLink">
								<li><a href="#tab_box01" class="is_active">支払い履歴</a></li>
							</ul> --}}
							<div class="tabBox is_active" id="tab_box01">
								@if(empty($withdrawals[0]))
									<p class="name">支払い履歴はありません。</p>
								@else
									<ul class="paymentUl01">
										@foreach($withdrawals as $value)
											<li>
												<div class="box">
													<div class="cont">
														<p class="date">{{ date('Y年n月j日', strtotime($value->created_at)) }}</p>
														<p class="txt">{{ $value->purchase->chatroom->reference->title }}</p>
													</div>
													@if($value->refunded_at === null)
														<div class="price"><span>支払い</span>{{ number_format($value->amount) }}円</div>
													@else
														<div class="price-back"><span>返金</span>{{ number_format($value->amount_refunded) }}円</div>
													@endif
												</div>
											</li>
										@endforeach
									
									{{ $withdrawals->links() }}
										
									</ul>
								@endif
							</div>
							
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>

			</div><!--inner-->
		</div><!-- /#contents -->
	</div><!-- /#wrapper -->
</article>
</x-layout>