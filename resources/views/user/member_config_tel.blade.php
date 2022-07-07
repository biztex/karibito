<x-layout>
    <x-parts.post-button/>{{--投稿ボタンの読み込み--}}
        <article>
            <x-parts.flash-msg/>
            <div id="contents" class="otherPage">
                <div class="inner02 clearfix">
                    <div id="main">
                        <div class="configEditWrap">
                            <div class="configEditItem">
                                <h2 class="subPagesHd">電話番号の登録</h2>
                                <form method="POST" action="{{ route('tel.regist') }}">
                                    @csrf
                                    <div class="configEditBox">
                                        <dl class="configEditDl01">
                                            <dt>電話番号</dt>
                                            <dd>
                                                <div class="mypageEditInput">
                                                    @error('tel')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                    <input type="tel" name="tel" autocomplete="tel" required>
                                                </div>
                                            </dd>
                                        </dl>
                                        <div class="configEditButton">
                                            <input type="submit" value="登録する">
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
    <x-hide-modal/>
</x-layout>

{{-- <!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="format-detection" content="telephone=no">
<title>知識・スキル・経験を商品化マッチングプラットフォーム！</title>
<meta name="keywords" content="キーワード">
<meta name="description" content="ディスクリプション">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->

<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" media="all">
<link rel="stylesheet" type="text/css" href="css/slick.css" media="all">
<link rel="stylesheet" type="text/css" href="css/slick-theme.css" media="all">
<link rel="stylesheet" href="css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="style.css" media="all">
</head>
<body id="member">
<div id="wrapper">
	<?php
		include('header.php');
	?>
	<article>
		<div class="btnFixed"><a href="#"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
		<div class="unregisteredP emailConfirm">確認メールを送信しました </div>

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="configEditWrap">
						<div class="configEditItem">
							<h2 class="subPagesHd">電話番号</h2>
							<div class="configEditBox">
								<dl class="configEditDl01">
									<dt>電話番号</dt>
									<dd>
										<div class="mypageEditInput"><input type="text" name="" placeholder=""></div>
										<p class="noticeP">※電話番号はハイフンなしで入力してください。</p>
									</dd>
								</dl>
								<div class="configEditButton">
									<input type="submit" value="登録" name="">
								</div>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				<aside id="side" class="pc">
					<div class="sideItem">
						<ul class="sideUl01">
							<li><a href="#" class="">マイページ</a></li>
							<li><a href="#" class="">お気に入り</a></li>
							<li><a href="#" class="">進行中の取引</a></li>
							<li><a href="#" class="">過去の取引</a></li>
							<li><a href="#" class="">決済履歴</a></li>
							<li><a href="#" class="">ポイント取得・利用履歴</a></li>
							<li><a href="#" class="">フォロー・フォロワー</a></li>
							<li><a href="#" class="is_active">お知らせ</a></li>
							<li><a href="#" class="">カリビト知恵袋</a></li>
							<li><a href="#" class="">クーポン</a></li>
							<li><a href="#" class="">DM</a></li>
							<li><a href="#" class="">会員情報</a></li>
						</ul>
					</div>
					<div class="sideItem">
						<p class="sideHd">出品者向け</p>
						<ul class="sideUl01">
							<li><a href="#">スキル / 経歴</a></li>
							<li><a href="#">ポートフォリオ</a></li>
							<li><a href="#">ブログ</a></li>
							<li><a href="#">掲載内容一覧</a></li>
							<li><a href="#">掲載内容の下書き</a></li>
						</ul>
					</div>
					<div class="sideItem">
						<p class="sideHd">カリビトについて</p>
						<ul class="sideUl01">
							<li><a href="#">お問い合わせ</a></li>
							<li><a href="#">ご利用ガイド</a></li>
							<li><a href="#">カテゴリー項目追加依頼</a></li>
							<li><a href="#">個人情報の取り扱いについて</a></li>
							<li><a href="#">特定商取引法に基づく表記</a></li>
							<li><a href="#">利用規約</a></li>
							<li><a href="#">運営会社について</a></li>
							<li><div class="edition">バージョン <span>00.0000,00</span></div></li>
						</ul>
					</div>
				</aside><!-- /#side -->
			</div><!--inner-->
			<div class="aboutFeatures">
				<div class="inner">
					<h2 class="hdM">カリビトの特徴</h2>
					<div class="slider">
						<div><div class="item hlg01">
							<h3 class="tit">カリビトチャット</h3>
							<p class="ico ico_feat01"></p>
							<p>条件交渉でチャットができます。<br>また、PDFや画像ファイルを<br>送信する事も可能です。</p>
						</div></div>
						<div><div class="item hlg01">
							<h3 class="tit">検索機能</h3>
							<p class="ico ico_feat02"></p>
							<p>あなたの見たい情報を簡単に探せる<br>ために検索機能があります。<br>条件を入力するだけで簡単です。</p>
						</div></div>
						<div><div class="item hlg01">
							<h3 class="tit">シェア機能</h3>
							<p class="ico ico_feat03"></p>
							<p>いいなと思った仕事をSNSを使って<br>シェアすることができます。<br>仲の良いメンバーに知らせる時に便利。</p>
						</div></div>
						<div><div class="item hlg01">
							<h3 class="tit">お気に入り機能</h3>
							<p class="ico ico_feat04"></p>
							<p>気になる仕事や人材を<br>お気に入り登録をする事で<br>分からなくなることがありません。</p>
						</div></div>
						<div><div class="item hlg01">
							<h3 class="tit">カリビトチャット</h3>
							<p class="ico ico_feat01"></p>
							<p>条件交渉でチャットができます。<br>また、PDFや画像ファイルを<br>送信する事も可能です。</p>
						</div></div>
					</div>
				</div>
			</div>
			<div class="downloadWrap">
				<div class="inner">
					<div class="img"><img src="img/common/img_download.png" srcset="img/common/img_download.png 1x, img/common/img_download@2x.png 2x" alt=""><a href="#" target="_blank" class="logo sp"><img src="img/common/ico_sns_logo.svg" alt="LOGO"></a></div>
					<div class="info">
						<h2 class="tit">さあ、はじめよう！<span class="foucs">今すぐ無料ダウンロード！</span></h2>
						<div class="links">
							<a href="#" target="_blank" class="logo pc"><img src="img/common/ico_sns_logo.svg" alt="LOGO"></a>
							<a href="#" target="_blank"><img src="img/common/btn_app.svg" alt="App Store"></a>
							<a href="#" target="_blank"><img src="img/common/btn_google.svg" alt="Google"></a>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /#contents -->
	</article>
	<?php
		include('footer.php');
	?>
</div><!-- /#wrapper -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="js/jquery.biggerlink.min.js"></script>
<script type="text/javascript" src="js/slick.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-ja.min.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">
$(function(){

});
</script>
</body>
</html> --}}
