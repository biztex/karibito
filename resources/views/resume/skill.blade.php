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
                            <form action="{{ route('skill.store') }}" method="post" id="form" enctype="multipart/form-data">
                            @csrf
                                <div class="mypageItem">
                                    <p class="mypageHd03">スキル</p>
                                    <div class="mypageBox">
                                        <div class="mypageEditBox">
                                            <div class="flexLine01">
                                                <div class="mypageEditList flexLineLeft01">
                                                    <p class="mypageEditHd">スキル名</p>
                                                    <div class="mypageEditInput"><input type="text" name="skill_name" value="{{ old('skill_name') }}" placeholder="資格、特技、趣味、具体的スキル、他など" required></div>
                                                    <p class="taRResume">30</p>
                                                    @error('skill_name')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="mypageEditList flexLineRight01">
                                                    <p class="mypageEditHd">経験年数</p>
                                                    @error('year')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                                    <div class="mypageEditInput flexLine02">
                                                        <select name="year">
                                                            @for($year = 1; $year <= 20; $year++)
                                                                <option value="{{$year}}" @if(old('year') == $year) selected @endif>{{$year}}</option>;
                                                            @endfor
                                                        </select>
                                                        <span class="date_span">年</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fancyPersonBtn">
                                                <a href="{{ route('resume.show') }}" class="fancyPersonCancel">キャンセル</a>
                                                <input type="submit" class="fancyPersonSign loading-disabled" value="登録する">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
						</div>
					</div>
				</div><!-- /#main -->
                <x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>