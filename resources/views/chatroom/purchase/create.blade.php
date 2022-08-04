<x-layout>
    <article>
    <div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<a href="#">やること</a>　>　<span>お支払い手続き</span>
			</div>
		</div><!-- /.breadcrumb -->
		<div id="contents" style="margin-bottom:35px;">
			<div class="cancelWrap">
				<div class="inner inner05">

					<x-parts.chatroom-step :value="$proposal->chatroom"/>

					<h2 class="subPagesHd">お支払い手続き</h2>
					<form id="form" action="{{ route('chatroom.purchase.confirm', $proposal->id) }}" method="post">
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
										<td><big>商品代金</big><br>手数料</td>
										<td><big>¥{!! number_format($proposal->price) !!}</big><br>¥500</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td>合計</td>
										<td>¥{!! number_format($proposal->price + 500) !!}</td>
										<input type="hidden" name="amount" value="{{ $proposal->price + 500 }}">
									</tr>
								</tfoot>
							</table>
						</div>
					
						<div class="coupons">
							<div class="checkbox">
								<p class="checkChoice"><label><input type="checkbox">クーポンの利用する</label></p>
								<div class="pointInput mt12">
									<p class="mr18"><input type="text" value="{{ old('number') }}"></p>
									<p class="adoptionBtn"><input type="button" value="適用"></p>
								</div>
								<p class="detail">500円割引クーポン(合計3,000円以上のサービスでご利用可能)／2022年02月08日まで</p>
								<div class="warnNotes">
									<p class="danger">ご注意！</p>
									<p>※他のクーポンと併用はできません。</p>
								</div>
							</div>
							<div class="radio">
								<p class="tit">ポイントの利用</p>
								<ul class="radioChoice">
									<li><label><input type="radio" name="point_use" value="0" @if(old('point_use') == 0 || old('point_use') === null) checked @endif>利用しない</label></li>
									<li><label><input type="radio" name="point_use" value="1" @if(old('point_use') == 1) checked @endif >利用する</label>
										<p class="point">利用可能ポイント：000P</p>
										<div class="pointInput mt12">
											<p><input type="text" value="1000"></p>
											<p class="adoptionBtn"><input type="button" value="適用"></p>
										</div>
									</li>
								</ul>
							</div>
							<div class="method">
								<p class="tit">お支払い方法</p>

								<div class="radioChoice">
									<label><input type="radio" checked>クレジット決済</label>
									<div class="marks">
										<a href="#" target="_blank"><img src="/img/cart_buy/ico_mark01.svg" alt=""></a>
										<a href="#" target="_blank"><img src="/img/cart_buy/ico_mark02.svg" alt=""></a>
										<a href="#" target="_blank"><img src="/img/cart_buy/ico_mark03.svg" alt=""></a>
										<a href="#" target="_blank"><img src="/img/cart_buy/ico_mark04.svg" alt=""></a>
										<a href="#" target="_blank"><img src="/img/cart_buy/ico_mark05.svg" alt=""></a>
									</div>
								</div>

								@if(!empty($cards))
								<ul class="radioChoice" style="display:block;">
									@foreach($cards as $card)
										<div class="bl_credit-card-info">
											<input type="radio" name="card_id" value="{{ $card['id'] }}">
											<span class="credit-card-info-number">************{{ $card['last4'] }}</span>
											<span>{{ $card['name'] }}</span>
										</div>
									@endforeach
								</ul>
								@endif
								<div class="credit">
									<div class="radioChoice"><input type="radio" name="card_id" value="new">新しいカード</div>		


									<table>
										<tr>
											<th>カード番号</th>
											<td>
												<input type="text" class="big" name="cc_number">
												<p class="case">例）1234567890123456</p>
											</td>
										</tr>
										<tr>
											<th>有効期限</th>
											<td>
												<div>
													<select name="exp_month">
														@for($i=1; $i<=12; $i++)
															<option value="{{$i}}" @if($i == old('exp_month')) selected @endif>{{sprintf('%02d', $i)}}</option>
														@endfor
													</select> /
													<select name="exp_year">
														@for($i=2022; $i<=2030; $i++)
															<option value="{{$i}}" @if($i == old('exp_year')) selected @endif>{{$i}}</option>
														@endfor
													</select>
												</div>
												<p class="note">※カードに刻印されている表記のとおりにご選択ください。</p>
											</td>
										</tr>
										<tr>
											<th>カード名義</th>
											<td>
												<input type="text" class="big" name="cc_name">
												<p class="note">※カードに刻印されている表記のとおりにご選択ください。</p>
											</td>
										</tr>
										<tr>
											<th>セキュリティコード</th>
											<td class="creditCode">
												<input type="tell" class="small">
												<a href="#" class="link">▶セキュリティコードとは？</a>
												<div class="creditCodeBox">
													<p>セキュリティコードの場所</p>
													<div class="creditCodeImg">
														<img src="/img/cart_buy/security_guide_3.png" alt="">
													</div>
													<p>※カードの裏に記載されている<br>3桁のコードをご記入ください。</p>
												</div>
											</td>
										</tr>
									</table>
									<p class="click"><a href="">登録できない場合はこちら</a></p>
								</div>
							</div>
							<div class="functeBtns">
								<input type="submit" class="orange full loading-disabled" value="確認する">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
    </article>
</x-layout>