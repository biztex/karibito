<header>
    <div id="header">
        <div id="headerLinks">
            <div class="inner">
                <div class="item">
                    <h1 id="headerLogo"><a href="/"><img class="pc" src="/img/common/logo.svg" alt="LOGO" style="min-width:93px;"><img class="sp" src="/img/common/logo_sp.svg" alt="LOGO"></a></h1>
                    <p class="searchBtnSp sp"><img src="/img/common/ico_sea.svg" alt=""></p>
                    <form method="get">
                        <div class="searchBox">
                            <select name="search_service" class="searchSelect">
                                <option value="1">サービス</option>
                                <option value="2">リクエスト</option>　{{-- どうやるかわからない。値によってroute先を変えたい--}}
                            </select>
                            <div class="search">
                                <input type="text" name="keyword" @if(isset($keyword)) value="{{$keyword}}" @endif placeholder="キーワードを入力して検索">
                                <input type="submit" class="btn" formaction="{{ route('product.search') }}" value="">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="item">
                    @auth
                        <p class="navHeadSp">
                            @if(empty($user_profile->icon))
                                <a href="{{ route('mypage') }}" class="nav_mypage navLinkA"><img src="/img/mypage/no_image.jpg" alt=""></a>
                                @else
                                <a href="{{ route('mypage') }}" class="nav_mypage navLinkA"><img src="{{asset('/storage/'.$user_profile->icon) }}" alt="" style="width: 30px;height: 30px;object-fit: cover;"></a>
                            @endif
                        </p>
                    @endauth
                    <div class="btnMenu"><span></span><span></span><span></span></div>
                    <nav id="gNavi">
                        <ul class="navUl02 pc">
                            <li><a href="{{ route('support') }}" class="nav01">サポート</a></li>
                                @auth
                                    <li class="navLink">
                                        <a href="javascript:void(0);" class="nav06 navLinkA">メッセージ
                                            <span>@if ($not_view_user_notifications->count() > 0) {{$not_view_user_notifications->count()}}@endif</span>
                                        </a>
                                        <div class="navBox">
                                            <p class="navMessageHd">メッセージ</p>
                                            <div class="navMessageUl">
                                                @if(isset($not_view_user_notifications[0]))
                                                    @foreach ($not_view_user_notifications as $not_view_user_notification)
                                                        @if ($not_view_user_notification->is_view === 0)
                                                            <a href="{{route('user_notification.show', $not_view_user_notification->id)}}">
                                                                <dl>
                                                                    <dt><img src="/img/common/img_message01.png" alt=""></dt>
                                                                    <dd>
                                                                        <p class="txt">{{$not_view_user_notification->title}}</p>
                                                                        <p class="time">{{$not_view_user_notification->created_at->diffForHumans()}}</p>
                                                                    </dd>
                                                                </dl>
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <div class="navMessageUl">
                                                        <p class="noMessage">現在、メッセージの通知はありません。</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <p class="navMessageLink"><a href="{{ route('user_notification.index') }}">すべて見る</a></p>
                                        </div>
                                    </li>
                                    <li><a href="{{ route('chatroom.index') }}" class="nav03">やりとり</a></li>
                                    <li><a href="#" class="nav02">お気に入り</a></li>
                                    <li class="navLink">
                                            @if(empty($user_profile->icon))
                                                <a href="javascript:void(0);" class="nav_mypage navLinkA" style="margin:0 0 15px 15px;"><img src="/img/mypage/no_image.jpg" alt=""></a>
                                            @else
                                                <a href="javascript:void(0);" class="nav_mypage navLinkA"><img src="{{asset('/storage/'.$user_profile->icon) }}" alt="" style="width: 40px;height: 40px;object-fit: cover;"></a>
                                            @endif
                                        <div class="navBox navMypageBox">
                                            <dl class="navMypageDl">
                                                @if(empty($user_profile->icon))
                                                    <dt><a href="{{ route('mypage')}}"><img src="/img/mypage/no_image.jpg" alt=""></a></dt>
                                                @else
                                                    <dt><a href="{{ route('mypage')}}"><img src="{{asset('/storage/'.$user_profile->icon) }}" alt="" style="width: 40px;height: 40px;object-fit: cover;"></a></dt>
                                                @endif
                                                    <dd>{{\Auth::user()->name}}</dd>
                                            </dl>
                                            @if(\App\Models\UserProfile::where([['user_id', '=', Auth::id()],['first_name', '<>', null],])->exists())
                                                <div class="navMypageUl">
                                                    <a href="{{ route('mypage') }}">マイページ</a>
                                                    @can('identify')
                                                        <a href="{{ route('publication') }}">掲載内容一覧</a>
                                                    @endcan
                                                    <a href="#fancybox_person" class="fancybox">プロフィール編集</a>
                                                    <a href="#">設定</a>
                                                </div>
                                            @endif
                                            <p class="navMypageUlLink"><a href="{{ route('logout') }}">ログアウト</a></p>
                                        </div>
                                    </li>
                                @endauth
                        </ul>
                        <div class="sp">
                            @auth
                                <dl class="navMypageDl">
                                    @if(empty($user_profile->icon))
                                        <dt><a href="{{ route('mypage')}}"><img src="/img/mypage/no_image.jpg" alt=""></a></dt>
                                        @else
                                        <dt><a href="{{ route('mypage')}}"><img src="{{asset('/storage/'.$user_profile->icon) }}" alt="" style="width: 40px;height: 40px;object-fit: cover;"></a></dt>
                                    @endif
                                    <dd>{{ \Auth::user()->name }}</dd>
                                </dl>
                                <!-- <p class="gnavEdit"><a href="#fancybox_person" class="fancybox">プロフィール編集</a></p> -->
                                <p class="gnavEdit"><a href="{{ route('mypage') }}">マイページ</a></p>
                                <div class="navMypageUl link01">
                                    <a href="{{ route('mypage') }}">マイページ</a>
                                    @can('identify')
                                        <a href="{{ route('publication') }}">掲載内容一覧</a>
                                    @endcan
                                    <a href="#">お気に入り</a>
                                    @can('identify')
                                        <a href="{{ route('publication') }}">掲載内容一覧</a>
                                        <a href="{{ route('product.index') }}" class="blueBtn">投稿する</a>
                                    @endcan
                                </div>
                            @endauth
                            <div class="navMypageUl"  @if(Auth::check()) style="margin-top:10px" @endif>
                                @guest
                                    <a href="{{route('login')}}" class="log">ログイン</a>
                                    <a href="{{route('register')}}" class="sign">新規登録</a>
                                @endguest
                                <a href="{{ route('guide') }}">ご利用ガイド</a>
                                <a href="#">カリビトQ&A</a>
                                <a href="{{ route('privacy-policy') }}">プライバシーポリシー</a>
                                <a href="#">設定</a>
                                <a href="{{ route('contact') }}">お問い合わせ</a>
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
                            <option>リクエスト</option>
                        </select>
                        <form method="get">
                            <div class="search">
                                <input type="text" name="keyword" @if(isset($keyword)) value="{{$keyword}}" @endif placeholder="キーワードを入力して検索">
                                <input type="submit" class="btn" formaction="{{ route('product.search') }}" value="">
                                <input type="submit" formaction="{{ route('product.search') }}" value="検索する">
                            </div>
                        </form>
                    </div>
                    <div class="searchClose"><img src="/img/common/search_close.svg" alt=""></div>
                </div>
                <div class="searchWrapCont">
                    {{-- <ul class="searchWrapUl01">
                        <li><a> サービスを探す</a></li>
                        <li><a>リクエストを探す</a></li>
                        <li><a>ブログを探す</a></li>
                    </ul> --}}
                    <div class="searchWrapItem">
                        <p class="searchWrapHd"><img src="/img/common/icon_search_hd.svg" alt="">サービス一覧</p>
                        <ul class="searchItemUl">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{route('product.category.index', $category->id) }}"><img src="/img/common/search_item{{$loop->iteration}}.svg" alt="">{{$category->name}}</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        @foreach($category->mProductChildCategory as $child_category)
                                            <li><a href="{{route('product.category.index.show', $child_category->id) }}">{{$child_category->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
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
                            <a class="findLinkA">サービスを探す</a>
                            <div class="findSubLink">
                                <ul class="findSubLinkUl">
                                @foreach($categories as $category)
                                    <li class="findSubLinkLi">
                                        <a href="{{route('product.category.index', $category->id) }}">{{$category->name}}</a>
                                        <div class="findThirdLink">
                                            <ul class="findThirdLinkUl">
                                            @foreach($category->mProductChildCategory as $child_category)
                                                <li><a href="{{route('product.category.index.show', $child_category->id) }}">{{$child_category->name}}</a></li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="findLink">
                            <a class="findLinkA">リクエストを探す</a>
                            <div class="findSubLink">
                                <ul class="findSubLinkUl">
                                @foreach($categories as $category)
                                    <li class="findSubLinkLi">
                                        <a href="{{route('job_request.category.index', $category->id) }}">{{$category->name}}</a>
                                        <div class="findThirdLink">
                                            <ul class="findThirdLinkUl">
                                            @foreach($category->mProductChildCategory as $child_category)
                                                <li><a href="{{route('job_request.category.index.show', $child_category->id) }}">{{$child_category->name}}</a></li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="findLink">
                            <a class="findLinkA">ブログを探す</a>
                            <div class="findSubLink">
                                <ul class="findSubLinkUl">
                                @foreach($categories as $category)
                                    <li class="findSubLinkLi">
                                        <a href="#">{{$category->name}}</a>
                                        <div class="findThirdLink">
                                            <ul class="findThirdLinkUl">
                                            @foreach($category->mProductChildCategory as $child_category)
                                                <li><a href="#">{{$child_category->name}}</a></li>
                                            @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                    @can('identify')
                    <div class="right">
                        <a href="{{ route('product.index') }}">投稿する</a>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
        <!-- <div class="serviceLink pc">
            <div class="inner">
                <div class="cont">
                    <div class="box">
                    @foreach($categories as $category)
                        <div class="link">
                            <a href="#" class="linkA">{{ $category->name }}</a>
                        </div>
                    @endforeach
                    </div>
                    <div class="span"><img src="/img/common/icon_slink.svg" alt=""></div>
                </div>
            </div>
        </div> -->
        @auth
            <div class="spFixed">
                <div class="spFixedItem">
                    <a href="{{ route('home') }}}}" class="spFixedLink">
                        <p class="linkIcon"><img src="/img/common/icon_spfixed01.svg" alt=""></p>
                        <p class="linkTxt">ホーム</p>
                    </a>
                </div>
                <div class="spFixedItem">
                    <a href="{{ route('product.index') }}" class="spFixedLink">
                        <p class="linkIcon"><img src="/img/common/icon_spfixed02.svg" alt=""></p>
                        <p class="linkTxt">投稿</p>
                    </a>
                </div>
                <div class="spFixedItem">
                    <a href="{{ route('chatroom.index') }}" class="spFixedLink">
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
                    <a href="{{ route('mypage') }}" class="spFixedLink">
                        <p class="linkIcon"><img src="/img/common/icon_spfixed05.svg" alt=""></p>
                        <p class="linkTxt">マイページ</p>
                    </a>
                </div>
            </div>
        @endauth
    </div><!-- /#header -->
</header>