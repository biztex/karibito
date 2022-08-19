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

<link rel="shortcut icon" href="/favicon.ico">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<link rel="stylesheet" type="text/css" href="/css/common-custom.css" media="all">

</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="{{ route('admin.dashboard') }}">Karibito</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav">
				<!-- <a class="nav-item nav-link active" href="{{ route('admin.dashboard') }}">Home <span class="sr-only">(current)</span></a> -->
				<a class="nav-item nav-link active" href="{{ route('admin.users.index') }}">Users</a>
				<!-- @if(\Auth::guard('admin')->user()->role == 1)<a class="nav-item nav-link" href="{{ route('admin.index') }}">Admin</a>@endif -->
				<a class="nav-item nav-link active" href="{{ route('admin.news.index') }}">News</a>
				<a class="nav-item nav-link active" href="{{ route('admin.products.index') }}">Products</a>
				<a class="nav-item nav-link active" href="{{ route('admin.job_requests.index') }}">JobRequests</a>
				<a class="nav-item nav-link active" href="{{ route('admin.m_commission_rates.index') }}">手数料</a>
				<a class="nav-item nav-link active" href="{{ route('admin.survey.index') }}">アンケート</a>
				<a class="nav-item nav-link active" href="{{ route('admin.payment.index') }}">決済</a>
				<a class="nav-item nav-link" href="{{ route('admin.logout') }}">LOGOUT</a>
				</div>
			</div>
		</nav>
	</header>

{{ $slot }}

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script type="text/javascript" src="/js/custom.js"></script>
</body>
</html>
