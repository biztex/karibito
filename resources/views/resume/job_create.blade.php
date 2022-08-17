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
							<p class="mypageHd02"><span>職務</span></p>
							<div class="mypageItem">
								<form method="post" id="form" enctype="multipart/form-data">
								@csrf
									<p class="mypageHd03">職務</p>
									@error('content')<div class="alert alert-danger">{{ $message }}</div>@enderror
									<div class="mypageBox">
										<div class="mypageEditBox">
											<div class="mypageDuties mypageEditInput">
												<textarea type="text" name="content">@if(!is_null($jobs)){{ old('content', $jobs->content)}} @endif</textarea>
												<p class="taR">0-3000</p>
											</div>
											<div class="fancyPersonBtn">
                                                <a href="{{ route('resume.show') }}" class="fancyPersonCancel">キャンセル</a>
												@if(is_null($jobs))
                                                <input type="submit" class="fancyPersonSign loading-disabled" formaction="{{ route('store.job') }}" value="登録する">
												@else
												<input type="submit" class="fancyPersonSign" formaction="{{ route('update.job') }}" value="編集する">
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