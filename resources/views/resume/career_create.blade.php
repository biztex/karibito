<x-layout>
<x-parts.post-button/>
    <article class="careerCreate">
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
									<div class="mypageEditBox">
										<form method="post" enctype="multipart/form-data">
										@csrf
											<div class="mypageEditList">
												<p class="mypageEditHd">経歴名</p>
												@error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
												<div class="mypageEditInput"><input type="text" name="name" value="{{ old('name') }}" placeholder="経歴名を入力してください" required></div>
											</div>
											<div class="mypageEditList">
												<p class="mypageEditHd">在籍期間</p>
												@error('first_year')<div class="alert alert-danger">{{ $message }}</div>@enderror
												@error('first_month')<div class="alert alert-danger">{{ $message }}</div>@enderror
												@error('last_year')<div class="alert alert-danger">{{ $message }}</div>@enderror
												@error('last_month')<div class="alert alert-danger">{{ $message }}</div>@enderror
												<div class="mypageEditDate">
													<div class="mypageEditHalf">
														<p class="mypageEditDateHd">開始</p>
														<div class="mypageEditInput flexLine01">
															<select name="first_year">
																<option value="">選択してください</option>
																@for($year = 1970; $year<= now()->year; $year++)
																	<option value="{{$year}}" @if(old('first_year') == $year) selected @endif>{{$year}}</option>
																@endfor
															</select>
															<select name="first_month">
																<option value="">選択してください</option>
																@for($month = 1; $month <= 12; $month++)
																<option value='{{ $month }}' @if(old('first_month') == $month) selected @endif>{{ $month }}</option>
																@endfor
															</select>
														</div>
													</div>
													<span class="date_span02 pc">〜</span>
													<div class="mypageEditHalf">
														<p class="mypageEditDateHd">終了</p>
														<div class="mypageEditInput flexLine01">
															<select name="last_year">
																<option value="">選択してください</option>
																@for($year = 1970; $year<= now()->year; $year++)
																	<option value="{{$year}}" @if(old('last_year') == $year) selected @endif>{{$year}}</option>;
																@endfor
															</select>
															<select name="last_month">
																<option value="">選択してください</option>
																@for($month = 1; $month <= 12; $month++)
																<option value='{{ $month }}' @if(old('last_month') == $month) selected @endif>{{ $month }}</option>
																@endfor
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="fancyPersonBtn">
                                                <a href="{{ route('resume.show') }}" class="fancyPersonCancel">キャンセル</a>
                                                <input type="submit" class="fancyPersonSign" formaction="{{ route('store.career') }}" value="登録する">
                                            </div>
										</form>
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