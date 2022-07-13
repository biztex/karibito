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
											<div class="mypageCtrl"><a href="#">削除</a></div>
										</li>
										@endforeach
									</ul>
									<p class="specialtyBtn"><a href="{{route('show.skill')}}"><img src="img/mypage/icon_add.svg" alt="">スキルを追加</a></p>
								</div>
							</div>
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
									<p class="specialtyBtn"><a href="{{route('resume.career_create')}}"><img src="img/mypage/icon_add.svg" alt="">経歴を追加</a></p>
								</div>
							</div>
							<div class="mypageItem">
								<p class="mypageHd03">職務</p>
								<div class="mypageBox">
									<div class="mypageDuties">
										<p>【プロフィール】<br>KARIS翻訳サービス代表。<br>英語翻訳家、作家。<br>上智大学グリーフケア研究所推薦、日本スピリチュアルケア学会認定スピリチュアルケア師。<br>財閥系企業のSE兼翻訳担当として3年間の翻訳業務、外務省専門調査員として2年間の通訳・翻訳業務に従事。<br>米国病院のチャプレンとして延べ2,000人超の患者様とご家族にケアを提供。<br>米国フラー神学大学院神学修士課程修了。<br>英国ウォーリック大学大学院国際関係学修士課程修了。<br>英検1級、TOEIC965、IELTS7.5、国連英検A級、VERSANT72。</p>
										<p>【主な著書】<br>『英語力アップ厳選トレーニング20選』（Amazon翻訳部門ベストセラー1位）<br>『3ヶ月で突破 TOEIC(R) L&Rテスト900点! 5つの戦略』（Amazon翻訳部門ベストセラー1位）<br>『HELLIQ、METIQ、ISPEに所属する 天才の7つの習慣』（Amazonリーダーシップ・自己啓発・倫理学3部門ベストセラー1位）<br>『アサーティブな思考と行動』（Amazonビジネスコミュニケーション部門ベストセラー2位）<br>『精神障害者へのスピリチュアルケア: キリスト教とイスラム教から学ぶ3つのアプローチ』（Amazon精神医学部門ベストセラー4位）</p>
									</div>
									<p class="specialtyBtn"><a href="{{route('resume.job_create')}}"><img src="img/mypage/icon_edit.svg" alt="">職務を編集</a></p>
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
