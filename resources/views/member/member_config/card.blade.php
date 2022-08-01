<x-layout>
<body id="member-page">
<x-parts.post-button/>
	<article>
		<x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
            <div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">クレジットカード</h2>
							<div class="configEditBox">
								<div class="configEditList">
									<h3 class="mypageEditHd">現在のカード情報</h3>
									<div class="configEditTable">
										<table>
											<tr>
												<th>カード番号</th>
												<td>************007</td>
											</tr>
											<tr>
												<th>カード名義人</th>
												<td>〇〇〇〇〇〇〇〇</td>
											</tr>
										</table>
                                        <button class="configEditDeleteBtn">削除</button>
									</div>

                                    <div class="configEditTable">
										<table>
											<tr>
												<th>カード番号</th>
												<td>************007</td>
											</tr>
											<tr>
												<th>カード名義人</th>
												<td>〇〇〇〇〇〇〇〇</td>
											</tr>
										</table>
                                        <button class="configEditDeleteBtn">削除</button>
									</div>
								</div>
								<div class="configEditList">
									<h3 class="mypageEditHd">新しいカード情報</h3>
									<div class="configEditTable">
										<table>
											<tr>
												<th>カード番号</th>
												<td>
													<div class="mypageEditInput"><input type="text" name="" placeholder=""></div>
													<p class="noticeP">例）1234567890123456</p>
												</td>
											</tr>
											<tr>
												<th>有効期限</th>
												<td>
													<div class="mypageEditInput flexLine02">
                                                        <select name="month">
                                                            @for($i=1; $i<=12; $i++)
                                                                <option value="{{$i}}" @if($i == old('month')) selected @endif>{{sprintf('%02d', $i)}}</option>
                                                            @endfor
                                                        </select>
														<span class="span">/</span>
                                                        <select name="year">
                                                            @for($i=2022; $i<=2030; $i++)
                                                                <option value="{{$i}}" @if($i == old('year')) selected @endif>{{$i}}</option>
                                                            @endfor
                                                        </select>
													</div>
													<p class="noticeP">※カードに刻印されている表記のとおりにご選択ください。</p>
												</td>
											</tr>
											<tr>
												<th>カード名義</th>
												<td>
													<div class="mypageEditInput"><input type="text" name="" placeholder=""></div>
												<p class="noticeP">※カードに刻印されている表記のとおりにご選択ください。</p>
												</td>
											</tr>
                                            <tr>
                                                <th>セキュリティコード</th>
                                                <td class="creditCode">
                                                    <input type="text" class="small">
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
									<input type="submit" value="登録" name="">
								</div>
							</div>
						</div>

					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-layout>
