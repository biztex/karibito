<x-layout>
<x-parts.post-button/>
    <article>
    <body id="resume">
		<div id="breadcrumb">
			<div class="inner">
				<a href="index.html">ホーム</a>　>　<span>スキル・経歴</span>
			</div>
		</div><!-- /.breadcrumb -->
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
									<ul class="mypageUl03">
										@foreach($skills as $skill)
										<li>
											<dl class="mypageDl02">
												<dt>スキル名</dt>
												<dd><span>{{ $skill->name }}</span></dd>
											</dl>
											<dl class="mypageDl02">
												<dt>経験年数</dt>
												<dd>{{ $skill->year }}年</dd>
											</dl>
												<form method="post"  action="{{route('destroy.skill',$skill->id)}}" enctype="multipart/form-data">
													@csrf
													<div class="mypageCtrl"><button type="submit" onclick='return confirm("削除しますか？");'>削除</button></div>
												</form>
											</li>
										@endforeach
									</ul>
									@if($skills->count() < 10)
										<p class="specialtyBtn"><a href="{{route('show.skill')}}"><img src="img/mypage/icon_add.svg" alt="">スキルを追加</a></p>
									@endif
								</div>
							</div>
							<div class="mypageItem">
								<p class="mypageHd03">経歴</p>
								<div class="mypageBox">
									<ul class="mypageUl03">
										@foreach($careers as $career)
										<li>
											<dl class="mypageDl02">
												<dt>経歴名</dt>
												<dd><span>{{ $career->name }}</span></dd>
											</dl>
											<dl class="mypageDl02">
												<dt>在籍期間</dt>
												<dd>{{ $career->first_year }}年 {{$career->first_month}}月 ～ @if($career->last_year == null && $career->last_month == null)現在 @else{{ $career->last_year }}年 {{$career->last_month}}月 @endif</dd>
											</dl>
											<form method="post"  action="{{route('destroy.career',$career->id)}}" enctype="multipart/form-data">
													@csrf
													<div class="mypageCtrl"><button type="submit" onclick='return confirm("削除しますか？");'>削除</button></div>
												</form>
										</li>
										@endforeach
									</ul>
									@if($careers->count() < 10)
										<p class="specialtyBtn"><a href="{{route('resume.career_create')}}"><img src="img/mypage/icon_add.svg" alt="">経歴を追加</a></p>
									@endif
								</div>
							</div>
							<div class="mypageItem">
								<p class="mypageHd03">職務</p>
								<div class="mypageBox">
									<div class="mypageDuties">
										<p>@if(!is_null($jobs)){{ $jobs->content }}@endif</p>
									</div>
									@if(is_null($jobs))
									<p class="specialtyBtn"><a href="{{route('resume.job_create')}}"><img src="img/mypage/icon_edit.svg" alt="">職務を登録</a></p>
									@else
									<p class="specialtyBtn"><a href="{{route('resume.job_create')}}"><img src="img/mypage/icon_edit.svg" alt="">職務を編集</a></p>
								    @endif
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
