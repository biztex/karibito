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
                            <form method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="mypageItem">
                                    <p class="mypageHd03">スキル</p>
                                    <div class="mypageBox">
                                        <div class="mypageEditBox">
                                            <div class="flexLine01">
                                                <div class="mypageEditList flexLineLeft01">
                                                    <p class="mypageEditHd">スキル名</p>
                                                    @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
                                                    <div class="mypageEditInput"><input type="text" name="name" value="{{ old('name') }}" placeholder="スキル名を入力してください" required></div>
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
                                                <input type="submit" class="fancyPersonSign" formaction="{{ route('store.skill') }}" value="登録する">
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
		<x-hide-modal/>
	</article>
</x-layout>