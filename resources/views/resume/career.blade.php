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
										<form action="{{ route('career.store') }}" method="post" id="form" enctype="multipart/form-data">
										@csrf
											<div class="mypageEditList">
												<p class="mypageEditHd">経歴名</p>
												@error('career_name')<div class="alert alert-danger">{{ $message }}</div>@enderror
												<div class="mypageEditInput"><input type="text" name="career_name" value="{{ old('career_name') }}" placeholder="学校名、お勤め先企業名、事業経営、海外就労経験、ボランティア、他など" required></div>
												<p class="taRResume">30</p>
											</div>
											<div class="mypageEditList">
												<p class="mypageEditHd">在籍期間</p>
												@error('first')<div class="alert alert-danger">{{ $message }}</div>@enderror
												@error('last')<div class="alert alert-danger">{{ $message }}</div>@enderror
												@error('first_year')<div class="alert alert-danger">{{ $message }}</div>@enderror
												@error('first_month')<div class="alert alert-danger">{{ $message }}</div>@enderror
												@error('last_year')<div class="alert alert-danger">{{ $message }}</div>@enderror
												@error('last_month')<div class="alert alert-danger">{{ $message }}</div>@enderror
												<div class="mypageEditDate">
													<div class="mypageEditHalf">
														<p class="mypageEditDateHd">開始</p>
														<div class="mypageEditInput flexLine01">
															<select name="first_year" required>
																<option value="">年</option>
																@for($year = 1970; $year<= now()->year; $year++)
																	<option value="{{$year}}" @if(old('first_year') == $year) selected @endif>{{$year}}年</option>
																@endfor
															</select>
															<select name="first_month" required>
																<option value="">月</option>
																@for($month = 1; $month <= 12; $month++)
																<option value='{{ $month }}' @if(old('first_month') == $month) selected @endif>{{ $month }}月</option>
																@endfor
															</select>
														</div>
													</div>
													<span class="date_span02 pc">〜</span>
													<div class="mypageEditHalf">
														<p class="mypageEditDateHd">終了</p>
														<div class="mypageEditInput flexLine01">
															<select name="last_year">
																<option value="">年</option>
																@for($year = 1970; $year<= now()->year; $year++)
																	<option value="{{$year}}" @if(old('last_year') == $year) selected @endif>{{$year}}年</option>;
																@endfor
															</select>
															<select name="last_month">
																<option value="">月</option>
																@for($month = 1; $month <= 12; $month++)
																<option value='{{ $month }}' @if(old('last_month') == $month) selected @endif>{{ $month }}月</option>
																@endfor
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="fancyPersonBtn">
                                                <a href="{{ route('resume.show') }}" class="fancyPersonCancel">キャンセル</a>
                                                <input type="submit" class="fancyPersonSign loading-disabled" value="登録する">
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
	</article>
</x-layout>