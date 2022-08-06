<x-layout>
    <article>
    <div id="breadcrumb">
			<div class="inner">
				<a href="{{route('home')}}">ホーム</a>　>　<a href="#">やること</a>　>　<span>お支払い手続き</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div id="contents" style="margin-bottom:35px;">
			<div class="cancelWrap">
				<div class="inner inner05">
					
					<x-parts.chatroom-step :value="$proposal->chatroom"/>

					<h2 class="subPagesHd">お支払い手続き</h2>
					<form id="form" action="{{route('chatroom.purchased', $proposal->id)}}" method="post">
					@csrf
						<div class="payment">
							<table>
								<thead>
									<th width="70%">内容</th>
									<th>お支払い金額</th>
								</thead>
								<tbody>
									<tr>
										<td>
											<div class="cont">
												@if(isset($proposal->chatroom->reference->productImage[0]))
													<p class="img"><img src="{{ asset('/storage/'.$proposal->chatroom->reference->productImage[0]->path)}}" alt="" style="width: 75px;height: 62.5px;object-fit: cover;"></p>
												@else
													<p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
												@endif
												<div class="info">
													<p>{{ $proposal->chatroom->reference->title }}</p>
													<p class="link"><a href="#">機密保持契約(NDA)</a></p>
												</div>
											</div>
										</td>
										<td>¥{!! number_format($proposal->price) !!}</td>
									</tr>
									<tr>
										<td>
											<big>商品代金</big>
											@if ($request->user_use_point)
												<br>ポイント利用<br>
											@endif
											<br>手数料<br>
											<font class="colorRed">500円割引クーポン(合計3,000円以上のサービスでご利用可能)／2022年02月08日まで</font>
										</td>
										<td>
											<big>¥{!! number_format($proposal->price) !!}</big>
											@if ($request->user_use_point)
												<br><font class="colorRed">−¥{!! number_format($request->user_use_point) !!}</font><br>
											@endif
											<br>¥500<br>
											<font class="colorRed">¥-500</font>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td>合計</td>
										<td>¥{!! number_format($proposal->price + 500 - $request->user_use_point) !!}</td>
										<input type="hidden" name="amount" value="{{ $request->amount }}">
									</tr>
								</tfoot>
							</table>
						</div>
					
						<div class="coupons">
							<div class="method">
								<p class="tit">お支払い方法</p>
								<div class="credit">
									@if($card === null)
										<div class="bl_credit-card-info">
											<input type="hidden" name="immediate" value="checked">
											<span class="credit-card-info-number">************{{ substr($request->cc_number, -4) }}</span>
											<input type="hidden" name="cc_number" value="{{ $request->cc_number }}">
											
											<span>{{ $request->cc_name }}</span>
											<input type="hidden" name="cc_name" value="{{ $request->cc_name }}">

											<input type="hidden" name="exp_month" value="{{ $request->exp_month }}">
											<input type="hidden" name="exp_year" value="{{ $request->exp_year }}">
										</div>
									@else
										<div class="bl_credit-card-info">
											<span class="credit-card-info-number">************{{ $card['last4'] }}</span>
											<span>{{ $card['name'] }}</span>
											<input type="hidden" name="card_id" value="{{ $card['id'] }}">
											<input type="hidden" name="customer_id" value="{{ $card['customer'] }}">
											<input type="hidden" name="immediate" value="">
										</div>
									@endif
									<!-- <table>
										<tr>
											<th>カード番号</th>
											<td>{{ $request->card_number }}</td>
										</tr>
										<tr>
											<th>有効期限</th>
											<td>{{ date("yy",strtotime($request->year)) }}年/{{ $request->month }}月</td>
										</tr>
										<tr>
											<th>カード名義</th>
											<td>{{ $request->card_name }}</td>
										</tr>
										<tr>
											<th>セキュリティコード</th>
											<td>{{ $request->security_code }}</td>
										</tr>
									</table> -->
								</div>
							</div>
							<div class="warnNotes mt50">
								<p class="danger">ご注意！</p>
								<p>※他のクーポンと併用はできません。</p>
							</div>
							<div class="functeBtns">
								<input type="submit" class="orange full loading-disabled" value="確定する">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
    </article>
</x-layout>