<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="format-detection" content="telephone=no">
<!-- <meta name=”robots” content=”noindex”/> -->


<title>【カリビト 】知識・スキル・経験を商品化できるマッチングプラットフォーム！</title>
<meta name="keywords" content="カリビト,知識,スキル,経験,マッチング,プラットフォーム">
<meta name="description" content="知識・スキル・経験を商品化できるマッチングプラットフォーム「カリビト」。">
<!-- [if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif] -->

<meta property="og:url" content="{{ config('app.url') }}">
<meta property="og:type" content="website">
<meta property="og:title" content="【カリビト 】知識・スキル・経験を商品化できるマッチングプラットフォーム！ ">
<meta property="og:description" content="知識・スキル・経験を商品化できるマッチングプラットフォーム「カリビト」。">
<meta property="og:site_name" content="カリビト">
<meta property="og:image" content="{{ asset('OGP.jpg') }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<meta name="twitter:title" content="【カリビト 】知識・スキル・経験を商品化できるマッチングプラットフォーム！ ">
<meta name="twitter:description" content="知識・スキル・経験を商品化できるマッチングプラットフォーム「カリビト」。">
<meta name="twitter:image" content="{{ asset('OGP.jpg') }}">
<meta name="twitter:card" content="summary_large_image">


<link rel="shortcut icon" href="/favicon.ico">

<link rel="stylesheet" type="text/css" href="/css/slick.css" media="all">
<link rel="stylesheet" type="text/css" href="/css/slick-theme.css" media="all">
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all">
<link rel="stylesheet" href="/css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.css" media="all">
<link rel="stylesheet" type="text/css" href="/css/common-custom.css" media="all">
</head>

{{ $slot }}

<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="/js/jquery.biggerlink.min.js"></script>
<script type="text/javascript" src="/js/jquery.fancybox.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/jquery.ui.datepicker-ja.min.js"></script>
<script type="text/javascript" src="/js/slick.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
<script type="text/javascript" src="/js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.9.6/lottie.min.js" integrity="sha512-yAr4fN9WZH6hESbOwoFZGtSgOP+LSZbs/JeoDr02pOX4yUFfI++qC9YwIQXIGffhnzliykJtdWTV/v3PxSz8aw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://jpostal-1006.appspot.com/jquery.jpostal.js"></script>
<script>
	$(function(){

		// フラッシュメッセージ閉じるボタン
		$('.flash_close').on('click',function(){
			$('.flash_msg').fadeOut(400);
			@json(\Session::put('flash_msg',null));
		})
	});
</script>

@if(isset($errors))
	<script>
		$(function(){

			if ($('body').attr('class') == 'none-modal') {

			} else if (@json($errors->has('identification_path'))){
					$('.fancybox_register').click();
					
			} else if (@json($errors->has('name') || $errors->has('first_name') || $errors->has('last_name') || $errors->has('gender') || $errors->has('birthday') || $errors->has('prefecture') || $errors->has('zip') || $errors->has('address') || $errors->has('introduction') || $errors->has('icon') || $errors->has('cover') || $errors->has('profile_content.*') || $errors->has('arr_content') )) {
						$('.fancybox').click();
						
			} else if (@json($errors->has('base64_text.0'))) {
				$("#preview_product0").attr('src', '/img/service/img_provide.jpg');
			}
		})
	</script>
@endif
</html>
