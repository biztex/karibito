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
								<form action="{{ route('job.store') }}" method="post" id="form" enctype="multipart/form-data">
								@csrf
									<p class="mypageHd03">職務</p>
									@error('content')<div class="alert alert-danger">{{ $message }}</div>@enderror
									<div class="mypageBox">
										<div class="mypageEditBox">
											<div class="mypageDuties mypageEditInput">
												<textarea type="text" name="content" placeholder="〇スキル&#10;資格、特技、趣味、具体的スキル（WEBグラフィックデザイン制作、恋愛カウンセリング、他）など&#10;&#10;〇経歴&#10;学校名、お勤め先企業名、事業経営、教育機関勤務、行政機関勤務、海外就労経験、ボランティア、他など&#10;&#10;〇職務&#10;経歴に対するより詳細な役職、職務内容、功績、勤務場所、経験値、他など">@if(Auth::user()->userJob){{ old('content', Auth::user()->userJob->content)}} @endif</textarea>
												<p class="taRResume">3000</p>
											</div>
											<div class="fancyPersonBtn">
                                                <a href="{{ route('resume.show') }}" class="fancyPersonCancel">キャンセル</a>
												@if(!Auth::user()->userJob)
                                               		<input type="submit" class="fancyPersonSign loading-disabled" value="登録する">
												@else
													<input type="submit" class="fancyPersonSign loading-disabled" value="編集する">
												@endif
                                            </div>
										</div>
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