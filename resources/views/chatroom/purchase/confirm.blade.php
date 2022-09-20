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
												</div>
											</div>
										</td>
										<td>¥{!! number_format($amount['price']) !!}</td>
									</tr>
									<tr>
										<td>
											<big>商品代金</big>

											@if ($request->point_use === '1' && !is_null($amount['use_point']))
												<br><font class="colorRed">ポイント利用</font>
											@endif

											@if ($request->coupon_use === '1' && !is_null($amount['coupon_discount']))
												<br><font class="colorRed">クーポン利用</font>
												<!-- <font class="colorRed">500円割引クーポン(合計3,000円以上のサービスでご利用可能)／2022年02月08日まで</font> -->
											@endif

											<br>手数料<br>
										</td>

										<td>
											<big>¥{!! number_format($amount['price']) !!}</big>

											@if ($request->point_use === '1' && !is_null($amount['use_point']))
												<br><font class="colorRed">¥-{!! number_format($amount['use_point']) !!}</font>
											@endif

											@if ($request->coupon_use === '1' && !is_null($amount['coupon_discount']))
												<br><font class="colorRed">¥-{!! number_format($amount['coupon_discount']) !!}</font>
											@endif
											<br>¥{{ number_format($amount['commission']) }}<br>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td>合計</td>
											<td>¥{!! number_format($amount['total']) !!}</td>
										<input type="hidden" name="user_use_point" value="{{ $request->user_use_point }}">
										<input type="hidden" name="coupon_number" value="{{ $request->coupon_number }}">
									</tr>
								</tfoot>
							</table>
						</div>

						<div class="coupons">
							<div class="method">
								<p class="tit">お支払い方法</p>
								<div class="credit">
									<div class="bl_credit-card-info">
										<span class="credit-card-info-number">************{{ $card['last4'] }}</span>
										<span>{{ $card['name'] }}</span>
										<input type="hidden" name="card_id" value="{{ Crypt::encryptString($card['id']) }}">
										<input type="hidden" name="customer_id" value="@if(is_null($stripe_token)){{ $card['customer'] }}@endif">
										<input type="hidden" name="stripe_token" value="@if(!is_null($stripe_token)){{ Crypt::encryptString($stripe_token) }}@endif">
									</div>
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