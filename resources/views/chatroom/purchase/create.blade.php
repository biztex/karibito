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
										<td><big>¥{!! number_format($proposal->price) !!}</big><br>¥{!! number_format($commission) !!}</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td>合計</td>
										<td>¥{!! number_format($proposal->price + $commission) !!}</td>
									</tr>
								</tfoot>
							</table>
						</div>

						<div class="coupons">
							<div class="checkbox">
								@error('coupon_number')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                <p class="checkChoice"><label><input type="checkbox" name="coupon_use" value="1" @if(old('coupon_use') == 1) checked @endif>クーポンを利用する</label></p>
                                <div class="pointInput mt12">
                                    <p class="mr18">
                                        <select name="coupon_number" style="padding: 10px;">
                                            <option value="">選択してください</option>
                                            @foreach ($user_has_coupons as $coupon)
                                                <option value="{{$coupon->coupon_number}}" @if(old('coupon_number') == $coupon->coupon_number) selected @endif>{{$coupon->name}}:{{$coupon->content}}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                        <!-- <p class="adoptionBtn"><input type="button" value="適用"></p> -->
                                    </div>
									{{--
										<!-- <p class="detail">{{$coupon->discount}}円割引クーポン(合計{{$coupon->min_price}}円以上のサービスでご利用可能){{date('Y年m月d日', strtotime($coupon->deadline))}}まで</p> -->
										<!-- 最低利用金額などはこっちでやる、仕様未決定のため、一旦飛ばす -->
									--}}
                                <div class="warnNotes">
                                    <p class="danger">ご注意！</p>
                                    <p>※他のクーポンと併用はできません。</p>
                                </div>
                            </div>


							<div class="radio">
								<p class="tit">ポイントの利用@error('user_use_point')<span>{{ $message }}</span>@enderror</p>
								<ul class="radioChoice">
									@error('point_use')<span>{{ $message }}</span>@enderror
									<li><label><input type="radio" name="point_use" value="0" @if(old('point_use') == 0 || old('point_use') === null) checked @endif>利用しない</label></li>
									<li><label><input type="radio" name="point_use" value="1" @if(old('point_use') == 1) checked @endif >利用する</label>
										<p class="point">利用可能ポイント：{{$user_has_point}}P</p>
										<div class="pointInput mt12">
											<p><input type="text" value="{{ old('user_use_point')}}" name="user_use_point"></p>
											{{-- <p class="adoptionBtn"><input type="button" value="適用"></p> --}}
										</div>
									</li>
								</ul>
							</div>


							<div class="method">
								<p class="tit">お支払い方法@error('card_id')<span>{{ $message }}</span>@enderror</p>

								<div class="radioChoice">
									<label><input type="radio" name="payment_type" value="credit_card" checked>クレジット決済</label>
									<div class="marks">
										<img src="/img/cart_buy/ico_mark01.svg" alt="">
										<img src="/img/cart_buy/ico_mark02.svg" alt="">
										<img src="/img/cart_buy/ico_mark03.svg" alt="">
										<img src="/img/cart_buy/ico_mark04.svg" alt="">
										<img src="/img/cart_buy/ico_mark05.svg" alt="">
									</div>
								</div>

								@if(!empty($cards))
								<ul class="radioChoice" style="display:block;">
									@foreach($cards as $card)
										<div class="bl_credit-card-info">
											<input type="radio" name="card_id" value="{{ $card['id'] }}" @if(old('card_id', $cards[0]['id']) === $card['id']) checked @endif>
											<span class="credit-card-info-number">************{{ $card['last4'] }}</span>
											<span>{{ $card['name'] }}</span>
										</div>
									@endforeach
								</ul>
								@endif
								<div class="credit">
									<div class="radioChoice"><input type="radio" name="card_id" value="immediate" @if(old('card_id') === 'immediate') checked @endif>新しいカード
									@if($errors->has('cc_name') || $errors->has('cc_number') || $errors->has('exp') || $errors->has('cvc'))<span class="alert alert-danger">※正しい情報を入力してください</span>@endif</div>


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
								<input type="hidden" class="" name="chatroom_id" value="{{$proposal->chatroom->id}}">
								<input type="submit" class="orange full loading-disabled" value="確認する">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
    </article>
</x-layout>