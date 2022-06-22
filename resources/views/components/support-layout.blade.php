<x-app>
    <body>
    <div id="wrapper" class="st2 bg02">
        <header>
            <div id="header" class="">
                <div id="headerLinks">
                    <div class="inner">
                        <div class="item">
                            <h1 id="headerLogo"><a href="{{ route('home') }}"><img class="pc" src="/img/common/logo.svg" alt="LOGO"><img class="sp" src="/img/common/logo_sp.svg" alt="LOGO"></a></h1> 
                        </div>
                        <p class="custTit">CUSTOMER SUPPORT</p>
                    </div> 
                </div><!-- /.headLinks -->   
            </div><!-- /#header -->
        </header>
    {{$slot}}	
        <footer>
            <div id="footer">
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
                        <div class="img"><img src="/img/common/img_download.png" srcset="img/common/img_download.png 1x, img/common/img_download@2x.png 2x" alt=""><a href="#" target="_blank" class="logo sp"><img src="/img/common/ico_sns_logo.svg" alt="LOGO"></a></div>
                        <div class="info">
                            <h2 class="tit">さあ、はじめよう！<span class="foucs">今すぐ無料ダウンロード！</span></h2>
                            <div class="links">
                                <a href="#" target="_blank" class="logo pc"><img src="/img/common/ico_sns_logo.svg" alt="LOGO"></a>
                                <a href="#" target="_blank"><img src="/img/common/btn_app.svg" alt="App Store"></a>
                                <a href="#" target="_blank"><img src="/img/common/btn_google.svg" alt="Google"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom">
                    <div class="inner">
                        <div class="serviceLinks">
                            <a href="{{ route('company') }}">運営会社</a>
                            <a href="#">採用情報</a>
                            <a href="#">約款特定</a>
                            <a href="#">商取引法に基づく表示</a>
                            <a href="#">よくある質問</a>
                            <a href="#">お問い合わせ</a>
                        </div>
                        <div class="sns sp">
                            <a href="#" target="_blank"><img src="/img/common/ico_facebook.png" alt="Facebook"></a>
                            <a href="#" target="_blank"><img src="/img/common/ico_twitter.png" alt="Twitter"></a>
                            <a href="#" target="_blank"><img src="/img/common/ico_instragram.png" alt="Instragram"></a>
                            <a href="#" target="_blank"><img src="/img/common/ico_line.png" alt="LINE"></a>
                        </div>
                        <p id="copyright">©{{ now()->year }} karibito, Inc.</p>
                    </div>
                </div>
            </div><!-- /#footer -->
        </footer>
    </div><!-- /#wrapper -->
    </body>
</x-app>