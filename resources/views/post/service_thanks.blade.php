<x-layout>
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                {{--                {{dd(url()->previous())}}--}}
                @if(str_replace(url(''), "", $_SERVER['HTTP_REFERER']) == '/product/create') {{--提供-完了--}}
                    <a href="{{ route('product.index') }}">投稿する</a>　>　
                    <a href="{{ route('product.create') }}">サービスを提供する</a>　>　
                @elseif(str_replace(url(''), "", $_SERVER['HTTP_REFERER']) == '/product/preview') {{--提供-プレビュー-完了--}}
                    <a href="{{ route('product.index') }}">投稿する</a>　>　
                    <a href="{{ route('product.create') }}">サービスを提供する</a>　>　
                    <a href="{{(url()->previous())}}">プレビュー</a>　>　
                @elseif(str_replace(url(''), "", $_SERVER['HTTP_REFERER']) == '/job_request/create') {{--リクエスト-完了--}}
                    <a href="{{ route('product.index') }}">投稿する</a>　>　
                    <a href="{{route('job_request.create')}}">サービスをリクエストする</a>　>　
                @elseif(str_replace(url(''), "", $_SERVER['HTTP_REFERER']) == '/job_request/preview') {{--リクエスト-プレビュー-完了--}}
                    <a href="{{ route('product.index') }}">投稿する</a>　>　
                    <a href="{{ route('product.create') }}">サービスをリクエストする</a>　>　
                    <a href="{{(url()->previous())}}">プレビュー</a>　>　
                @else
                    <a href="{{route('publication')}}">掲載内容一覧</a>　>　
{{--                    <a href="{{(url()->previous())}}">リクエストを編集する</a>　>　--}}
                @endif
                <span>投稿完了</span>
{{--                {{(str_replace(url(''), "", $_SERVER['HTTP_REFERER']))}}--}}
			</div>
        </div><!-- /.breadcrumb -->
		<div id="contents">
			<div class="cancelWrap">
				<div class="inner inner05">
					<div class="cancelTitle">
						<h2>おめでとうございます！</h2>
						<p class="cancelRea">チケットの作成が完了しました。<br>チケットはSNSなどでみんなにシェアすることもできます。</p>
					</div>
					<div class="shareSnsEmail">
						<h3>SNSやメールでチケットをシェアする</h3>
						<div class="sns">
							<a href="#" target="_blank"><img src="img/mypage/ico_facebook.svg" alt=""></a>
							<a href="#" target="_blank"><img src="img/mypage/ico_line.svg" alt=""></a>
							<a href="#" target="_blank"><img src="img/mypage/ico_twitter.svg" alt=""></a>
							<a href="#" target="_blank"><img src="img/mypage/ico_mail.svg" alt=""></a>
						</div>
						<form>
							<table>
								<tr>
									<th>あなたの招待コードURL</th>
									<td>
										<div class="copy">
											<input type="text" class="url" id="copyInput" value="https://1111111">
											<span class="btn" onclick="copy()">コピーする</span>
										</div>
									</td>
								</tr>
								<tr>
									<th>あなたの招待コード</th>
									<td><input type="text" class="small" value="a8358d0dj1j"></td>
								</tr>
							</table>
						</form>
					</div>
					<div class="postLinks">
						<div class="common">
							<a href="#" class="st2">ブログを投稿する</a>
							<a href="#" class="st2">ポートフォリオを投稿する</a>
						</div>
					</div>
					<div class="functeBtns">
						<a href="{{ route('home') }}" class="red">TOPに戻る</a>
					</div>
				</div>
			</div>

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
</x-layout>

<script>
function copy() {
  /* Get the text field */
  var copyText = document.getElementById("copyInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /* For mobile devices */

  /* Copy the text inside the text field */
  navigator.clipboard.writeText(copyText.value);

  /* Alert the copied text */
  alert('コピーしました。');
}
	// product画像 localStrageリセット
	$(function(){
		for (let i = 0; i < 10; i++){
			localStorage.removeItem("pic"+i);
            localStorage.removeItem("status" + i);
		}
	});
</script>
