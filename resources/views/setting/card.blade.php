<x-layout>
<body id="setting-page">
<x-parts.post-button/>
	<article>
		<div id="breadcrumb">
                <div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<a href="{{ route('setting.index') }}">会員情報</a>　>　<span>クレジットカード情報</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
            <div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">クレジットカード</h2>
							<div class="configEditBox">
								<div class="configEditList" style="margin-bottom:35px;">
									@if(!empty($cards))
										<h3 class="mypageEditHd">現在のカード情報</h3>
										@foreach($cards as $card)
											<div class="configEditTable">
												<table>
													<tr>
														<th>カード番号</th>
														<td>************{{ $card['last4'] }}</td>
													</tr>
													<tr>
														<th>カード名義人</th>
														<td>{{ $card['name'] }}</td>
													</tr>
												</table>
												<form action="{{ route('setting.card.destroy', $card['id']) }}" method="post" class="configEditDeleteBtn">
													@csrf @method('delete')
													<button type="submit" onclick='return confirm("削除してもよろしいですか？");'>削除</button>
												</form>
											</div>
										@endforeach
									@endif
								</div>
								<form id="form" action="{{ route('setting.card.store') }}" method="post">
									@csrf
									<div class="configEditList">
										<h3 class="mypageEditHd">新しいカード情報　@if($errors->any())<span>※正しい情報を入力してください</span>@endif</h3>
										<div class="configEditTable">
											<table>
												<tr>
													<th>カード番号</th>
													<td>
														<div class="mypageEditInput"><input type="tell" name="cc_number" placeholder="" maxlength="16" pattern="([0-9]| )*"></div>
														<p class="noticeP">例）1234567890123456</p>
													</td>
												</tr>
												<tr>
													<th>有効期限</th>
													<td>
														<div class="mypageEditInput flexLine02">
															<select name="exp_month">
																@for($i=1; $i<=12; $i++)
																	<option value="{{$i}}" @if($i == old('exp_month')) selected @endif>{{sprintf('%02d', $i)}}</option>
																@endfor
															</select>
															<span class="span">/</span>
															<select name="exp_year">
																@for($i=2022; $i<=2030; $i++)
																	<option value="{{$i}}" @if($i == old('exp_year')) selected @endif>{{$i}}</option>
																@endfor
															</select>
														</div>
														<p class="noticeP">※カードに刻印されている表記のとおりにご選択ください。</p>
													</td>
												</tr>
												<tr>
													<th>カード名義</th>
													<td>
														<div class="mypageEditInput"><input type="text" name="cc_name" placeholder=""></div>
													<p class="noticeP">※カードに刻印されている表記のとおりにご選択ください。</p>
													</td>
												</tr>
												<tr>
													<th>セキュリティコード</th>
													<td class="creditCode">
														<input type="tell" name="cvc" class="small" maxlength="4">
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
										</div>
									</div>

									<div class="configEditButton">
										<input class="loading-disabled" type="submit" value="登録">
									</div>
								</form>
							</div>
						</div>

					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>
