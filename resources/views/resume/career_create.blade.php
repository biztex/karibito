<x-layout>
<x-parts.post-button/>
    <article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home')}}">ホーム</a>　>　<span>スキル・経歴</span>
			</div>
		</div><!-- /.breadcrumb -->
		
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="mypageWrap">
						<div class="mypageSec04">
							<p class="mypageHd02"><span>スキル・経歴</span></p>
							<div class="mypageItem">
								<p class="mypageHd03">経歴</p>
								<div class="mypageBox">
									<ul class="mypageUl03">
										<li>
											<dl class="mypageDl02">
												<dt>経歴名</dt>
												<dd><span>アパレルメーカー アパレルデザイナー</span></dd>
											</dl>
											<dl class="mypageDl02">
												<dt>在籍期間</dt>
												<dd>2012年 4月 ～ 2016年 3月</dd>
											</dl>
											<div class="mypageCtrl"><a href="#">削除</a></div>
										</li>
										<li>
											<dl class="mypageDl02">
												<dt>経歴名</dt>
												<dd><span>デザイン事務所 デザイナー</span></dd>
											</dl>
											<dl class="mypageDl02">
												<dt>在籍期間</dt>
												<dd>2016年 4月 ～ 現在</dd>
											</dl>
											<div class="mypageCtrl"><a href="#">削除</a></div>
										</li>
									</ul>

									<div class="mypageEditBox">
										<div class="mypageEditList">
											<p class="mypageEditHd">経歴名</p>
											<div class="mypageEditInput"><input type="text" name="" placeholder="経歴を入力してください"></div>
										</div>
										<div class="mypageEditList">
											<p class="mypageEditHd">在籍期間</p>
											<div class="mypageEditDate">
												<div class="mypageEditHalf">
													<p class="mypageEditDateHd">開始</p>
													<div class="mypageEditInput flexLine01">
														<select>
															<option>2022年</option>
															<option>2021年</option>
															<option>2020年</option>
														</select>
														<select>
															<option>11月</option>
															<option>12月</option>
															<option>01月</option>
														</select>
													</div>
												</div>
												<span class="date_span02 pc">〜</span>
												<div class="mypageEditHalf">
													<p class="mypageEditDateHd">終了</p>
													<div class="mypageEditInput flexLine01">
														<select>
															<option>2022年</option>
															<option>2021年</option>
															<option>2020年</option>
														</select>
														<select>
															<option>12月</option>
															<option>01月</option>
															<option>02月</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="fancyPersonBtn">
											<a href="#" class="fancyPersonCancel">キャンセル</a>
											<a href="#" class="fancyPersonSign">登録する</a>
										</div>
									</div>
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