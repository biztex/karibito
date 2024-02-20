<x-layout>
	<article>
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('mypage') }}">マイページ</a>　>　
                {{--                {{dd(url()->previous())}}--}}
                @if(str_replace(url(''), "", $_SERVER['HTTP_REFERER']) == '/product/create') {{--提供-完了--}}
                    <a href="{{ route('post') }}">投稿する</a>　>　
                    <a href="{{ route('product.create') }}">サービスを出品する</a>　>　
                @elseif(str_replace(url(''), "", $_SERVER['HTTP_REFERER']) == '/product/preview') {{--提供-プレビュー-完了--}}
                    <a href="{{ route('post') }}">投稿する</a>　>　
                    <a href="{{ route('product.create') }}">サービスを出品する</a>　>　
                @elseif(str_replace(url(''), "", $_SERVER['HTTP_REFERER']) == '/job_request/create') {{--リクエスト-完了--}}
                    <a href="{{ route('post') }}">投稿する</a>　>　
                    <a href="{{route('job_request.create')}}">サービスをリクエストする</a>　>　
                @elseif(str_replace(url(''), "", $_SERVER['HTTP_REFERER']) == '/job_request/preview') {{--リクエスト-プレビュー-完了--}}
                    <a href="{{ route('post') }}">投稿する</a>　>　
                    <a href="{{ route('product.create') }}">サービスをリクエストする</a>　>　
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
						<p class="cancelRea">サービスの作成が完了しました。<br>サービスはSNSなどでみんなにシェアすることもできます。</p>
					</div>
					<div class="shareSnsEmail">
						<h3>SNSやメールでサービスをシェアする</h3>
						<div class="sns">
                            <div id="fb-root"></div>
							<a href="http://www.facebook.com/share.php?u={{ urlencode(session('url')) }}" target="_blank"><img src="/img/mypage/ico_facebook.svg" alt=""></a>
							<a href="https://social-plugins.line.me/lineit/share?url={{ urlencode(session('url')) }}" target="_blank"><img src="/img/mypage/ico_line.svg" alt=""></a>
							<a href="https://twitter.com/share?url={{ urlencode(session('url')) }}&text={{ urlencode(session('product_title') . ' | ' . session('name') . ' | カリビトのサービスをシェア') }}&hashtags=karibito" target="_blank"><img src="/img/mypage/ico_twitter.svg" alt=""></a>
							<a href="mailto:?subject=カリビトのサービスをシェア&body={{ urlencode(session('product_title') . ' | ' . session('name') . ' | カリビトのリクエストをシェア ' . session('url')) }}" target="_blank"><img src="/img/mypage/ico_mail.svg" alt=""></a>
						</div>

						{{-- 招待コード --}}
						@auth
							<x-parts.invitation-code/>
						@endauth

					</div>
					<div class="serviceThanksLinks">
					@if(substr(str_replace(url(''), "", $_SERVER['HTTP_REFERER']), 0, 4) == '/job')
						<p class="checkGuideOriginal"><a href="{{route('publication',['#job-request'])}}">掲載内容一覧</a></p>
					@else
					    <p class="checkGuideOriginal"><a href="{{route('publication')}}">掲載内容一覧</a></p>
					@endif
					</div>
					<div class="postLinks">
						<div class="common">
							<a href="{{ route('blog.create') }}" class="st2">ブログを投稿する</a>
							<a href="{{ route('portfolio.create') }}" class="st2">ポートフォリオを投稿する</a>
						</div>
					</div>
					<div class="functeBtns">
						<a href="{{ route('home') }}" class="red">TOPに戻る</a>
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
</script>
<script type="text/javascript" src="/js/clearIndexedDB.js"></script>
