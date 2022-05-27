<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta name="viewport" content="width=device-width,height=device-height,inital-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta name="format-detection" content="telephone=no">
<!-- <meta name=”robots” content=”noindex”/> -->


<title>【カリビト 】知識・スキル・経験を商品化できるマッチングプラットフォーム！</title>
<meta name="keywords" content="キーワード">
<meta name="description" content="知識・スキル・経験を商品化できるマッチングプラットフォーム「カリビト」。">
<!-- [if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif] -->
 
<link rel="shortcut icon" href="/favicon.ico">

<link rel="stylesheet" type="text/css" href="/css/slick.css" media="all">
<link rel="stylesheet" type="text/css" href="/css/slick-theme.css" media="all">
<link rel="stylesheet" type="text/css" href="/css/style.css" media="all">
<link rel="stylesheet" href="/css/jquery.fancybox.css">
<link rel="stylesheet" type="/text/css" href="/style.css" media="all">
<link rel="stylesheet" type="text/css" href="/css/jquery-ui.css" media="all">

</head>
<body>
<div id="wrapper">
	<header> <div id="header">
            <div id="headerLinks">
                <div class="inner">
                    <div class="item">
                        <h1 id="headerLogo"><a href="/"><img class="pc" src="/img/common/logo.svg" alt="LOGO" style="min-width:93px;"><img class="sp" src="/img/common/logo_sp.svg" alt="LOGO"></a></h1>
                        <p class="searchBtnSp sp"><img src="/img/common/ico_sea.svg" alt=""></p>
                        <div class="searchBox">
                            <select class="searchSelect">
                                <option>サービス</option>
                                <option>家電</option>
                                <option>リクエストを探す</option>
                                <option>ペット</option>
                                <option>高齢者向け</option>
                            </select>
                            <div class="search">
                                <input type="text" placeholder="キーワードを入力して検索"><input type="submit" class="btn" value="">
                            </div>
                        </div>
                    </div> 
                    <div class="item">
                        @auth
                            <p class="navHeadSp">
                            
                                @if(empty(\App\Models\UserProfile::firstWhere('user_id',\Auth::id())->icon))
                                    <a href="{{ route('mypage') }}" class="nav_mypage navLinkA"><img src="/img/mypage/pic_head.png" alt=""></a>
                                    @else
                                    <a href="{{ route('mypage') }}" class="nav_mypage navLinkA"><img src="{{asset('/storage/'.\App\Models\UserProfile::firstWhere('user_id',\Auth::id())->icon) }}" alt="" style="width: 30px;height: 30px;object-fit: cover;"></a>
                                @endif
                            </p>
                        @endauth
                        <div class="btnMenu"><span></span><span></span><span></span></div> 
                        <nav id="gNavi">
                            <ul class="navUl02 pc">
                                <li><a href="#" class="nav01">サポート</a></li> 
                                @auth
                                <li class="navLink">
                                    <a href="javascript:void(0);" class="nav06 navLinkA">メッセージ<span>1</span></a>
                                    <div class="navBox">
                                        <p class="navMessageHd">メッセージ</p>
                                        <div class="navMessageUl">
                                            <a href="#">
                                                <dl>
                                                    <dt><img src="/img/common/img_message01.png" alt=""></dt>
                                                    <dd>
                                                        <p class="txt">事務局から個別メッセージ「ログイン通知」</p>
                                                        <p class="time">0時間前</p>
                                                    </dd>
                                                </dl>
                                            </a>
                                            <a href="#">
                                                <dl>
                                                    <dt><img src="/img/common/img_message02.png" alt=""></dt>
                                                    <dd>
                                                        <p class="txt">〇〇〇〇について作業完了報告が届きました</p>
                                                        <p class="time">0時間前</p>
                                                    </dd>
                                                </dl>
                                            </a>
                                            <a href="#">
                                                <dl>
                                                    <dt><img src="/img/common/img_message01.png" alt=""></dt>
                                                    <dd>
                                                        <p class="txt">事務局から個別メッセージ「ログイン通知」</p>
                                                        <p class="time">0時間前</p>
                                                    </dd>
                                                </dl>
                                            </a>
                                        </div>
                                        <!-- <div class="navMessageUl">
                                            <p class="noMessage">現在、メッセージの通知はありません。</p>
                                        </div> -->
                                        <p class="navMessageLink"><a href="#">すべて見る</a></p>
                                    </div>
                                </li>
                                <li><a href="#" class="nav03">やりとり</a></li>
                                <li><a href="#" class="nav02">お気に入り</a></li>
                                <li class="navLink">
                                        @if(empty(\App\Models\UserProfile::firstWhere('user_id',\Auth::id())->icon))
                                            <a href="javascript:void(0);" class="nav_mypage navLinkA" style="margin:0 0 15px 15px;"><img src="/img/common/nav_head.png" alt=""></a>
                                            @else
                                            <a href="javascript:void(0);" class="nav_mypage navLinkA"><img src="{{asset('/storage/'.\App\Models\UserProfile::firstWhere('user_id',\Auth::id())->icon) }}" alt="" style="width: 40px;height: 40px;object-fit: cover;"></a>
                                        @endif
                                    <div class="navBox navMypageBox">
                                        <dl class="navMypageDl">
                                            @if(empty(\App\Models\UserProfile::firstWhere('user_id',\Auth::id())->icon))
                                                <dt><img src="/img/common/nav_head.png" alt=""></dt>
                                                @else
                                                <dt><img src="{{asset('/storage/'.\App\Models\UserProfile::firstWhere('user_id',\Auth::id())->icon) }}" alt="" style="width: 40px;height: 40px;object-fit: cover;"></dt>
                                            @endif
                                            <dd>{{\Auth::user()->name}}</dd>
                                        </dl>
                                        <div class="navMypageUl">
                                            <a href="{{ route('mypage') }}">マイページ</a>
                                            <a href="#">掲載内容一覧</a>
                                            <!-- <a href="#fancybox_person" class="fancybox">プロフィール編集</a> -->
                                            <a href="#">設定</a>
                                        </div>
                                        <p class="navMypageUlLink"><a href="{{ route('logout') }}">ログアウト</a></p>
                                    </div>
                                </li>
                            @endauth
                            </ul>
                            <div class="sp">
								@auth
                                    <dl class="navMypageDl">
                                        @if(empty(\App\Models\UserProfile::firstWhere('user_id',\Auth::id())->icon))
                                            <dt><img src="/img/mypage/pic_head.png" alt=""></dt>
                                            @else
                                            <dt><img src="{{asset('/storage/'.\App\Models\UserProfile::firstWhere('user_id',\Auth::id())->icon) }}" alt="" style="width: 40px;height: 40px;object-fit: cover;"></dt>
                                        @endif
                                        <dd>{{\Auth::user()->name}}</dd>
                                    </dl>
                                    <!-- <p class="gnavEdit"><a href="#fancybox_person" class="fancybox">プロフィール編集</a></p> -->
                                    <p class="gnavEdit"><a href="{{ route('mypage') }}">マイページ</a></p>
                                    <div class="navMypageUl link01">
                                        <!-- <a href="{{ route('mypage') }}">マイページ</a> -->
                                        <a href="#">掲載内容一覧</a>
                                        <a href="#">お気に入り</a>
                                        <a href="#" class="blueBtn">投稿する</a>
                                    </div>
								@endauth
                                <div class="navMypageUl"  @if(Auth::check()) style="margin-top:10px" @endif>
								    @guest
										<a href="{{route('login')}}" class="log">ログイン</a>
										<a href="{{route('register')}}" class="sign">新規登録</a>
								    @endguest
                                    <a href="#">ご利用ガイド</a>
                                    <a href="#">カリビトQ&A</a>
                                    <a href="{{ route('privacy-policy') }}">プライバシーポリシー</a>
                                    <a href="#">設定</a>
                                    <a href="#">お問い合わせ</a>
                                </div>
                                @auth
                                    <p class="navMypageUlLink"><a href="{{ route('logout') }}">ログアウト</a></p>
                                @endauth
                            </div>
                        </nav><!-- /#gNavi -->
                        <div class="overlay"></div>
                        <div class="fun">
                            @guest
                                <a href="{{route('login')}}" class="log">ログイン</a>
                                <a href="{{route('register')}}" class="sign">新規登録</a>
                            @endguest
                        </div>
                    </div> 
                </div>
                <div class="searchWrapSp">
                    <div class="searchWrapTop">
                        <div class="searchBox">
                            <select class="searchSelect">
                                <option>サービス</option>
                                <option>家電</option>
                                <option>リクエストを探す</option>
                                <option>ペット</option>
                                <option>高齢者向け</option>
                            </select>
                            <div class="search">
                                <input type="text" placeholder="キーワードを入力して検索"><input type="submit" class="btn" value="">
                            </div>
                        </div>
                        <div class="searchClose"><img src="/img/common/search_close.svg" alt=""></div>
                    </div>
                    <div class="searchWrapCont">
                        <ul class="searchWrapUl01">
                            <li><a href="#">サービスを探す</a></li>
                            <li><a href="#">リクエストを探す</a></li>
                            <li><a href="#">ブログを探す</a></li>
                        </ul>
                        <div class="searchWrapItem">
                            <p class="searchWrapHd"><img src="/img/common/icon_search_hd.svg" alt="">サービス一覧</p>
                            <ul class="searchItemUl">
                                <li>
                                    <a href="#"><img src="/img/common/search_item01.svg" alt="">家電</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item02.svg" alt="">リクエストを探す</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item03.svg" alt="">ペット</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item04.svg" alt="">高齢者向け</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item05.svg" alt="">乗り物</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item06.svg" alt="">引越し</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item07.svg" alt="">趣味・習い事</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item08.svg" alt="">美容・ファッション</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item09.svg" alt="">写真動作制作</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item10.svg" alt="">その他</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item11.svg" alt="">インテリア</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item12.svg" alt="">デザイン</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item13.svg" alt="">パソコン</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item14.svg" alt="">ビジネスサポート</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item15.svg" alt="">冠婚葬祭</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item16.svg" alt="">料理</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item17.svg" alt="">恋愛・結婚</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item18.svg" alt="">体験・アクティビティ</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/common/search_item19.svg" alt="">出張サービス</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                        <li><a href="#">小カテゴリー</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- /.headLinks -->
            <div class="findWrap pc">
                <div class="inner">
                    <div class="flexBox">
                        <div class="left">
                            <div class="findLink">
                                <a href="#" class="findLinkA">サービスを探す</a>
                                <div class="findSubLink">
                                    <ul class="findSubLinkUl">
                                        <li class="findSubLinkLi">
                                            <a href="#">家事</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー1</a></li>
                                                    <li><a href="#">小カテゴリー1</a></li>
                                                    <li><a href="#">小カテゴリー1</a></li>
                                                    <li><a href="#">小カテゴリー1</a></li>
                                                    <li><a href="#">小カテゴリー1</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">修理組み立て</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー2</a></li>
                                                    <li><a href="#">小カテゴリー2</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">ペット</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">高齢者向け</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">乗り物</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">引越し</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">趣味・習い事</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">美容・ファッション</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">写真動作制作</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">その他</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">インテリア</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">デザイン</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">パソコン</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">ビジネスサポート</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">冠婚葬祭</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">料理</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">恋愛・結婚</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">体験・アクティビティ</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">出張サービス</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="findLink">
                                <a href="#" class="findLinkA">リクエストを探す</a>
                                <div class="findSubLink">
                                    <ul class="findSubLinkUl">
                                        <li class="findSubLinkLi">
                                            <a href="#">家事</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー1</a></li>
                                                    <li><a href="#">小カテゴリー1</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">修理組み立て</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー2</a></li>
                                                    <li><a href="#">小カテゴリー2</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">ペット</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">高齢者向け</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">乗り物</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">引越し</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">趣味・習い事</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">美容・ファッション</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">写真動作制作</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">その他</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">インテリア</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">デザイン</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">パソコン</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">ビジネスサポート</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">冠婚葬祭</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">料理</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">恋愛・結婚</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">体験・アクティビティ</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">出張サービス</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="findLink">
                                <a href="#" class="findLinkA">ブログを探す</a>
                                <div class="findSubLink">
                                    <ul class="findSubLinkUl">
                                        <li class="findSubLinkLi">
                                            <a href="#">家事</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー1</a></li>
                                                    <li><a href="#">小カテゴリー1</a></li>
                                                    <li><a href="#">小カテゴリー1</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">修理組み立て</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー2</a></li>
                                                    <li><a href="#">小カテゴリー2</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">ペット</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">高齢者向け</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">乗り物</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">引越し</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">趣味・習い事</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">美容・ファッション</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">写真動作制作</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">その他</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">インテリア</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">デザイン</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">パソコン</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">ビジネスサポート</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">冠婚葬祭</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">料理</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">恋愛・結婚</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">体験・アクティビティ</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="findSubLinkLi">
                                            <a href="#">出張サービス</a>
                                            <div class="findThirdLink">
                                                <ul class="findThirdLinkUl">
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                    <li><a href="#">小カテゴリー</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
						@if(Auth::check()) 
                        <div class="right">
                            <a href="#">投稿する</a>
                        </div>
						@endif
                    </div>
                </div>
            </div>
            <div class="serviceLink pc">
                <div class="inner">
                    <div class="cont">
                        <div class="box">
                            <div class="link">
                                <a href="#" class="linkA">家事</a>
                            </div>
                            <div class="link">
                                <a href="#" class="linkA">修理組み立て</a>
                            </div>
                            <div class="link">
                                <a href="#" class="linkA">ペット</a>
                            </div>
                            <div class="link">
                                <a href="#" class="linkA">高齢者向け</a>
                            </div>
                            <div class="link">
                                <a href="#" class="linkA">乗り物</a>
                            </div>
                            <div class="link">
                                <a href="#" class="linkA">引越し</a>
                            </div>
                            <div class="link">
                                <a href="#" class="linkA">趣味・習い事</a>
                            </div>
                            <div class="link">
                                <a href="#" class="linkA">美容・ファッション</a>
                            </div>
                            <div class="link">
                                <a href="#" class="linkA">写真動作制作</a>
                            </div>
                            <div class="link">
                                <a href="#" class="linkA">その他</a>
                            </div>
                            <div class="link">
                                <a href="#" class="linkA">インテリア</a>
                            </div>
                            <div class="link">
                                <a href="#" class="linkA">デザイン</a>
                            </div>
                            <div class="link">
                                <a href="#" class="linkA">パソコン</a>
                            </div>
                            <div class="link">
                                <a href="#" class="linkA">ビジネスサポート</a>
                            </div>
                        </div>
                        <div class="span"><img src="/img/common/icon_slink.svg" alt=""></div>
                    </div>
                </div>
            </div>
            @auth
                <div class="spFixed">
                    <div class="spFixedItem">
                        <a href="{{ route('home') }}}}" class="spFixedLink">
                            <p class="linkIcon"><img src="/img/common/icon_spfixed01.svg" alt=""></p>
                            <p class="linkTxt">ホーム</p>
                        </a>
                    </div>
                    <div class="spFixedItem">
                        <a href="#" class="spFixedLink">
                            <p class="linkIcon"><img src="/img/common/icon_spfixed02.svg" alt=""></p>
                            <p class="linkTxt">投稿</p>
                        </a>
                    </div>
                    <div class="spFixedItem">
                        <a href="#" class="spFixedLink">
                            <p class="linkIcon"><img src="/img/common/ico_talk.svg" alt=""></p>
                            <p class="linkTxt">やりとり</p>
                        </a>
                    </div>
                    <div class="spFixedItem">
                        <a href="#" class="spFixedLink">
                            <span class="newSpan">1</span>
                            <p class="linkIcon"><img src="/img/common/ico_message.svg" alt=""></p>
                            <p class="linkTxt">お知らせ</p>
                        </a>
                    </div>
                    <div class="spFixedItem">
                        <a href="#" class="spFixedLink">
                            <p class="linkIcon"><img src="/img/common/icon_spfixed05.svg" alt=""></p>
                            <p class="linkTxt">マイページ</p>
                        </a>
                    </div>
                </div>
            @endauth
        </div><!-- /#header -->
    </header>
{{$slot}}
<footer>
    	<div id="footer">
    		<div class="inner clearfix">
				<div class="sns pc">
					<a href="#" target="_blank"><img src="/img/common/ico_facebook.png" alt="Facebook"></a>
					<a href="#" target="_blank"><img src="/img/common/ico_twitter.png" alt="Twitter"></a>
					<a href="#" target="_blank"><img src="/img/common/ico_instragram.png" alt="Instragram"></a>
					<a href="#" target="_blank"><img src="/img/common/ico_line.png" alt="LINE"></a>
				</div>
    			<div class="footLinks">
    				<div class="item toggleWrap">
    					<p class="level1 toggleBtn">ワークを探す</p>
    					<ul class="level2 toggleBox">
    						<li><a href="#">エリアから探す</a></li>
    						<li><a href="#">カテゴリから探す</a></li>
    						<li><a href="#">日程から探す</a></li>
    						<li><a href="#">金額から探す</a></li>
    						<li><a href="#">〇〇〇〇から探す</a></li>
    						<li><a href="#">〇〇〇〇から探す</a></li>
    						<li><a href="#">〇〇〇〇から探す</a></li>
    					</ul>
    				</div>
    				<div class="item toggleWrap">
    					<p class="level1 toggleBtn">ご利用ガイド</p>
    					<ul class="level2 toggleBox">
    						<li><a href="#">初めての方へ</a></li>
    						<li><a href="#">ゲストの方へ</a></li>
    						<li><a href="#">ホストの方へ</a></li>
    						<li><a href="#">ワークを掲載するには</a></li> 
    					</ul>
    				</div>
    				<div class="item toggleWrap">
    					<p class="level1 toggleBtn">カリビトについて</p>
    					<ul class="level2 toggleBox">
    						<li><a href="#">法人のご利用について</a></li>
    						<li><a href="{{ route('privacy-policy') }}">プライバシーポリシー</a></li>
    						<li><a href="{{ route('terms-of-service') }}">利用規約</a></li>
    						<li><a href="#">ゲスト規約</a></li>
    						<li><a href="#">ホスト規約</a></li>
    						<li><a href="#">スマートフォンアプリ</a></li>
    					</ul>
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
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="/js/jquery.biggerlink.min.js"></script>
<script type="text/javascript" src="/js/jquery.fancybox.js"></script>
<script type="text/javascript" src="/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/js/jquery.ui.datepicker-ja.min.js"></script>
<script type="text/javascript" src="/js/slick.js"></script>
<script type="text/javascript" src="/js/common.js"></script>
</body>
</html>