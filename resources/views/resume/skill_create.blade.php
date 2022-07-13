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
                            <form method="post" class="contactForm" enctype="multipart/form-data">
                            @csrf
                                <div class="mypageItem">
                                    <p class="mypageHd03">スキル</p>
                                    <div class="mypageBox">
                                        <div class="mypageEditBox">
                                            <div class="flexLine01">
                                                <div class="mypageEditList flexLineLeft01">
                                                    <p class="mypageEditHd">スキル名</p>
                                                    <div class="mypageEditInput"><input type="text" name="name" placeholder="スキル名を入力してください"></div>
                                                </div>
                                                <div class="mypageEditList flexLineRight01">
                                                    <p class="mypageEditHd">経験年数</p>
                                                    <div class="mypageEditInput flexLine02">
                                                        <select name="year">
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                        </select>
                                                        <span class="date_span">年</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="fancyPersonBtn">
                                                <a href="#" class="fancyPersonCancel">キャンセル</a>
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