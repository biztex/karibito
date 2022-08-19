<x-layout>
	<x-parts.post-button/>
		<article>
		<body id="resume">
			<div id="breadcrumb">
				<div class="inner">
					<a href="{{ route('home') }}">ホーム</a>　>　<span>スキル・経歴</span>
				</div>
			</div><!-- /.breadcrumb -->
			<x-parts.ban-msg/>
			<x-parts.post-button/>
			<x-parts.flash-msg/>
	
			<div id="contents" class="otherPage">
				<div class="inner02 clearfix">
					<div id="main">
						<div class="mypageWrap">
							<div class="mypageSec04">
								<p class="mypageHd02"><span>スキル・経歴</span></p>
								<div class="mypageItem">
									<p class="mypageHd03">スキル</p>
									<div class="mypageBox">
										@if(Auth::user()->userSkills->isNotEmpty())
											<ul class="mypageUl03">
												@foreach(Auth::user()->userSkills as $skill)
													<li>
														<dl class="mypageDl02" style="word-wrap: break-word;">
															<dt>スキル名</dt>
															<dd><span>{{ $skill->name }}</span></dd>
														</dl>
														<dl class="mypageDl02">
															<dt>経験年数</dt>
															<dd>{{ $skill->year }}年</dd>
														</dl>
														<form method="post"  action="{{route('skill.destroy',$skill->id)}}" enctype="multipart/form-data">
															@csrf
															<div class="mypageCtrl"><button type="submit" onclick='return confirm("削除しますか？");'>削除</button></div>
														</form>
													</li>
												@endforeach
											</ul>
										@endif
											@if(Auth::user()->userSkills->count() < 10)
											<p class="specialtyBtn"><a href="{{route('skill.show')}}"><img src="img/mypage/icon_add.svg" alt="">スキルを追加</a></p>
										@endif
									</div>
									<p class="taRResume">＊スキルは10個まで追加できます。</p>
								</div>
	
	
								<div class="mypageItem">
									<p class="mypageHd03">経歴</p>
									<div class="mypageBox">
										@if(Auth::user()->userCareers->isNotEmpty())
											<ul class="mypageUl03">
												@foreach(Auth::user()->userCareers as $career)
													<li>
														<dl class="mypageDl02" style="word-wrap: break-word;">
															<dt>経歴名</dt>
															<dd><span>{{ $career->name }}</span></dd>
														</dl>
														<dl class="mypageDl02">
															<dt>在籍期間</dt>
															<dd>{{$career->first}} ~ @if($career->last_year == null)現在@else{{ $career->last }}@endif</dd>
														</dl>
														<form method="post"  action="{{route('career.destroy',$career->id)}}" enctype="multipart/form-data">
															@csrf
															<div class="mypageCtrl"><button type="submit" onclick='return confirm("削除しますか？");'>削除</button></div>
														</form>
													</li>
												@endforeach
											</ul>
										@endif
										@if(Auth::user()->userCareers->count() < 10)
											<p class="specialtyBtn"><a href="{{route('career.create')}}"><img src="/img/mypage/icon_add.svg" alt="">経歴を追加</a></p>
										@endif
									</div>
									<p class="taRResume">＊経歴は10個まで追加できます。</p>
								</div>
	
	
	
								<div class="mypageItem">
									<p class="mypageHd03">職務</p>
									<div class="mypageBox">
										@if(Auth::user()->userJob)
											<div class="mypageDuties" style="word-wrap: break-word;">
												<p>{!!nl2br(Auth::user()->userJob->content)!!}</p>
											</div>
											<p class="specialtyBtn"><a href="{{route('job.create')}}"><img src="img/mypage/icon_edit.svg" alt="">職務を編集</a></p>
										@else
											<p class="specialtyBtn"><a href="{{route('job.create')}}"><img src="img/mypage/icon_edit.svg" alt="">職務を登録</a></p>
										@endif
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
	