<x-layout>
    <x-parts.post-button/>
    <div id="blog">
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　<span>ブログ</span>
            </div>
        </div><!-- /.breadcrumb -->
        <x-parts.ban-msg/>
        <x-parts.flash-msg/>

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="blogWrap">
						<p class="mypageHd02"><span>ブログ</span></p>
						<div class="blogAdd">
							<a href="blog_edit.html"><img src="img/mypage/edit_blog.svg" alt="ブログを追加"></a>
						</div>
						<div class="blogItem">
							<p class="blogItemImg"><img src="img/blog/img_detail01_01.jpg" alt=""></p>
							<p class="blogItemHd">イラストレーター(ai)の不明な点にお答えします</p>
							<p class="blogItemBread"><a href="#">デザイン </a>　>　<span>その他デザイン</span></p>
							<div class="blogItemCont">
								<p>参考書やネットを見てもわからない点を是非、ご質問ください！イラストレーターは年々、更新されており、常に新機能が追加されています。参考書やネット見ても自分のバージョンとは違って、よくわからないことがよくああああ</p>
							</div>
							<dl class="blogItemPerson">
								<dt><img src="img/blog/head_detail01_01.png" alt=""></dt>
								<dd>
									<p class="nameP">クリエイター名</p>
									<p class="dateP">2021年7月26日</p>
								</dd>
							</dl>
							<p class="specialtyBtn addBtn02"><a href="blog_edit.html"><img src="img/mypage/icon_edit.svg" alt="">ブログを編集</a></p>
						</div>
						<div class="blogItem">
							<p class="blogItemImg"><img src="img/blog/img_detail02_01.jpg" alt=""></p>
							<p class="blogItemHd">目的に沿って画像加工いたします</p>
							<p class="blogItemBread"><a href="#">デザイン </a>　>　<span>その他デザイン</span></p>
							<div class="blogItemCont">
								<p>プロが行います！【 切り抜き／ 画像レタッチ／ 合成など】デザイナー歴10年以上の実績があります！ 画像加工のことならお任せください！ここ最近、メルカリやヤフオク出品にも背景を写したくない、自分で撮影あああああああ…</p>
							</div>
							<dl class="blogItemPerson">
								<dt><img src="img/blog/head_detail01_01.png" alt=""></dt>
								<dd>
									<p class="nameP">クリエイター名</p>
									<!-- <p class="dateP">2021年7月26日</p> -->
								</dd>
							</dl>
							<p class="specialtyBtn addBtn02"><a href="blog_edit.html"><img src="img/mypage/icon_edit.svg" alt="">ブログを編集</a></p>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>

			</div><!--inner-->
		</div><!--contents-->
		</div><!--blog-->
	<x-hide-modal/>
</x-layout>