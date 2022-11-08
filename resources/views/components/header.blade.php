<header>
    <div id="header">
        <div id="headerLinks">
            <div class="inner">

                <div class="item">
                    <h1 id="headerLogo"><a href="/"><img class="pc" src="/img/common/logo.svg" alt="LOGO" style="min-width:93px;"><img class="sp" src="/img/common/logo_sp.svg" alt="LOGO"></a></h1>
                    <p class="searchBtnSp sp"><img src="/img/common/ico_sea.svg" alt=""></p>
                    <form method="get">
                        <div class="searchBox">
                            <select name="service_flg" class="searchSelect">
                                <option value="1" @if (isset($serviceflg) && ($serviceflg === '1')) selected @endif>サービス</option>
                                <option value="2" @if (isset($serviceflg) && ($serviceflg === '2')) selected @endif>リクエスト</option>
                            </select>
                            <div class="search">
                                <input type="text" name="keyword" @if(isset($keyword)) value="{{$keyword}}" @endif placeholder="キーワードを入力して検索">
                                <input type="hidden" name="search_flg" value="1">
                                <input type="submit" class="btn" formaction="{{ route('product.search') }}" value="">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="item">
                    @auth
                        <p class="navHeadSp">
                            @if(empty(Auth::user()->userProfile->icon))
                                <a href="{{ route('mypage') }}" class="nav_mypage navLinkA"><img src="/img/mypage/no_image.jpg" alt=""></a>
                                @else
                                <a href="{{ route('mypage') }}" class="nav_mypage navLinkA"><img src="{{asset('/storage/'.Auth::user()->userProfile->icon) }}" alt=""></a>
                            @endif
                        </p>
                    @endauth
                    <div class="btnMenu"><span></span><span></span><span></span></div>
                    <nav id="gNavi">
                        <ul class="navUl02 pc">
                            <li><a href="{{ route('support') }}" class="nav01">サポート</a></li>
                                @auth
                                    <li class="navLink">
                                        <a href="javascript:void(0);" class="nav06 navLinkA">お知らせ
                                            <span>@if ($not_view_user_notifications->count() > 0) {{$not_view_user_notifications->count()}}@endif</span>
                                        </a>
                                        <div class="navBox">
                                            <p class="navMessageHd">お知らせ</p>
                                            <div class="navMessageUl">
                                                @if(isset($not_view_user_notifications[0]))
                                                    @foreach ($not_view_user_notifications as $k => $not_view_user_notification)
                                                        @if ($not_view_user_notification->is_view === 0)
                                                            <a href="{{route('already_read.show', $not_view_user_notification->id)}}">
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
                                                        <p class="noMessage">現在、お知らせはありません。</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <p class="navMessageLink"><a href="{{ route('user_notification.index') }}">すべて見る</a></p>
                                        </div>
                                    </li>
                                    <li><a href="{{ route('chatroom.index') }}" class="nav03">やりとり</a></li>
                                    <li><a href="{{ route('favorite.index') }}" class="nav02">お気に入り</a></li>
                                    <li class="navLink">
                                            @if(empty(Auth::user()->userProfile->icon))
                                                <a href="javascript:void(0);" class="nav_mypage navLinkA" style="margin:0 0 15px 15px;"><img src="/img/mypage/no_image.jpg" alt=""></a>
                                            @else
                                                <a href="javascript:void(0);" class="nav_mypage navLinkA"><img src="{{asset('/storage/'.Auth::user()->userProfile->icon) }}" alt="" style="width: 40px;height: 40px;object-fit: cover;"></a>
                                            @endif
                                        <div class="navBox navMypageBox">
                                            <dl class="navMypageDl">
                                                @if(empty(Auth::user()->userProfile->icon))
                                                    <dt><a href="{{ route('mypage')}}"><img src="/img/mypage/no_image.jpg" alt=""></a></dt>
                                                @else
                                                    <dt><a href="{{ route('mypage')}}"><img src="{{asset('/storage/'.Auth::user()->userProfile->icon) }}" alt="" style="width: 40px;height: 40px;object-fit: cover;"></a></dt>
                                                @endif
                                                    <dd>{{\Auth::user()->name}}</dd>
                                            </dl>
                                            @if(\App\Models\UserProfile::where([['user_id', '=', Auth::id()],['first_name', '<>', null],])->exists())
                                                <div class="navMypageUl">
                                                    <a href="{{ route('mypage') }}">マイページ</a>
                                                    {{-- @can('identify') --}}
                                                        <a href="{{ route('publication') }}">掲載内容一覧</a>
                                                    {{-- @endcan --}}
                                                    <a href="#fancybox_person" class="fancybox">プロフィール編集</a>
                                                    <a href="{{ route('setting.index') }}">会員情報</a>
                                                </div>
                                            @endif
                                            <p class="navMypageUlLink"><a href="{{ route('logout') }}" class="fs12" style="font-size: 1.3rem;">ログアウト</a></p> {{--クラス反応しない。スタイルベタ書き修正--}}
                                        </div>
                                    </li>
                                @endauth
                        </ul>

                        <div class="sp">
                            @auth
                                <dl class="navMypageDl">
                                    @if(empty(Auth::user()->userProfile->icon))
                                        <dt><a href="{{ route('mypage')}}"><img src="/img/mypage/no_image.jpg" alt=""></a></dt>
                                        @else
                                        <dt><a href="{{ route('mypage')}}"><img src="{{asset('/storage/'.Auth::user()->userProfile->icon) }}" alt="" style="width: 40px;height: 40px;object-fit: cover;"></a></dt>
                                    @endif
                                    <dd>{{ \Auth::user()->name }}</dd>
                                </dl>
                                <p class="gnavEdit"><a href="#fancybox_person" class="fancybox">プロフィール編集</a></p>
                                <p class="gnavEdit"><a href="{{ route('mypage') }}">マイページ</a></p>
                                <div class="navMypageUl">
                                    <a href="{{ route('publication') }}">掲載内容一覧</a>
                                    <a href="{{ route('post') }}" class="blueBtn">投稿する</a>
                                </div>
                                <div class="navMypageUl link01">
                                    <a href="{{ route('mypage') }}" class="">マイページ</a>
                                    <a href="{{ route('favorite.index') }}" class="">お気に入り</a>
                                    <a href="{{ route('chatroom.active') }}" class="">進行中の取引</a>
                                    <a href="{{ route('chatroom.inactive') }}" class="">過去の取引</a>
                                    <a href="{{ route('evaluation') }}" class="">評価一覧</a>
                                    <a href="{{ route('payment.index') }}" class="">支払い履歴</a>
                                    <a href="{{ route('point.index') }}" class="">ポイント取得・利用履歴</a>
                                    <a href="{{ route('follow.index') }}" class="">フォロー・フォロワー</a>
                                    <a href="{{ route('user_notification.index') }}" class="">お知らせ</a>
                                    <a href="{{ route('secret01') }}" class="">マッチングする秘訣</a>
                                    <a href="{{ route('coupon.index') }}" class="">クーポン</a>
                                    <a href="{{ route('dm.index') }}" class="">DM</a>
                                    <a href="{{ route('setting.index') }}" class="">会員情報</a>
                                    <a href="{{ route('setting.index') }}">設定</a>
                                    <a href="{{ route('showWithdrawForm') }}" class="">退会</a>
                                    {{-- @can('identify') --}}
                                    {{-- @endcan --}}
                                        {{-- <li><a href="/sample/faq" class="">カリビト知恵袋</a></li> --}}
                                </div>
                                <div class="navMypageUl">
                                    <p class="fwB">出品者向け</p>
                                    <a href="{{ route('resume.show') }}" class="">スキル / 経歴</a>
                                    <a href="{{ route('portfolio.index') }}" class="">ポートフォリオ</a>
                                    {{-- <li><a href="#">ブログ</a></li> --}}
                                    <a href="{{ route('publication') }}" class="">掲載内容一覧</a>
                                    <a href="{{ route('draft') }}">掲載内容の下書き</a>
                                    <a href="{{ route('profit.index') }}" class="">売上管理・振込申請</a>
                                </div>
                                <div class="navMypageUl">
                                    <p class="fwB">カリビトについて</p>
                                        <a href="{{ route('contact') }}">お問い合わせ</a>
                                        <a href="{{ route('support') }}">ご利用ガイド</a>
                                        <a href="#">カテゴリー項目追加依頼</a>
                                        <a href="{{ route('privacy-policy') }}">個人情報の取り扱いについて</a>
                                        <a href={{ route('notation') }}>特定商取引法に基づく表記</a>
                                        <a href="{{ route('terms-of-service') }}">利用規約</a>
                                        <a href="{{ route('company') }}">運営会社について</a>
                                        <div class="edition">バージョン <span>00.0000,00</span></div>
                                </div>
                                @auth
                                    <p class="navMypageUlLink"><a href="{{ route('logout') }}">ログアウト</a></p>
                                @endauth
                            @endauth

                            <div class="navMypageUl"  @if(Auth::check()) style="margin-top:10px" @endif>
                                @guest
                                    <a href="{{route('login')}}" class="log">ログイン</a>
                                    <a href="{{route('register')}}" class="sign">新規登録</a>
                                    <a href="{{ route('support') }}">ご利用ガイド</a>
                                    {{-- <a href="#">カリビトQ&A</a> --}}
                                    <a href="{{ route('privacy-policy') }}">プライバシーポリシー</a>
                                    <a href="{{ route('contact') }}">お問い合わせ</a>
                                @endguest
                            </div>
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
                    <form method="get">
                        <div class="searchBox">
                            <select name="service_flg" class="searchSelect">
                                <option value="1" @if (isset($serviceflg) && ($serviceflg === '1')) selected @endif>サービス</option>
                                <option value="2" @if (isset($serviceflg) && ($serviceflg === '2')) selected @endif>リクエスト</option>
                            </select>
                            <div class="search">
                                <input type="text" name="keyword" @if(isset($keyword)) value="{{$keyword}}" @endif placeholder="キーワードを入力して検索">
                                <input type="hidden" name="search_flg" value="1">
                                <input type="submit" class="btn" formaction="{{ route('product.search') }}" value="">
                            </div>
                        </div>
                    </form>
                    <div class="searchClose"><img src="/img/common/search_close.svg" alt=""></div>
                </div>
                <div class="searchWrapCont">
                    {{-- <ul class="searchWrapUl01">
                        <li><a> サービスを探す</a></li>
                        <li><a>リクエストを探す</a></li>
                        <li><a>ブログを探す</a></li>
                    </ul> --}}
                    <div class="searchWrapItem">
                        <p class="searchWrapHd" style="margin-top: 10px;"><img src="/img/common/icon_search_hd.svg" alt="">サービス一覧</p> {{--仮でスタイルを入れています。問題なければそのまま--}}
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
                    <div class="searchWrapItem">
                        <p class="searchWrapHd" style="margin-top: 10px;"><img src="/img/common/icon_search_hd.svg" alt="">リクエスト一覧</p> {{--仮でスタイルを入れています。問題なければそのまま--}}
                        <ul class="searchItemUl">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{route('job_request.category.index', $category->id) }}"><img src="/img/common/search_item{{$loop->iteration}}.svg" alt="">{{$category->name}}</a>
                                    <span class="span"></span>
                                    <ul class="searchSubUl">
                                        @foreach($category->mProductChildCategory as $child_category)
                                            <li><a href="{{route('job_request.category.index.show', $child_category->id) }}">{{$child_category->name}}</a></li>
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

                    @auth
                    {{-- @can('identify') --}}
                        <div class="right">
                            <a href="{{ route('post') }}">投稿する</a>
                        </div>
                    {{-- @endcan --}}
                    @endauth
                </div>
            </div>
        </div>

        {{-- <div class="serviceLink pc">
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
        </div> --}}

        @auth
            <div class="spFixed">
                <div class="spFixedItem">
                    <a href="{{ route('home') }}" class="spFixedLink">
                        <p class="linkIcon"><img src="/img/common/icon_spfixed01.svg" alt=""></p>
                        <p class="linkTxt">ホーム</p>
                    </a>
                </div>
                {{-- @can('identify') --}}
                    <div class="spFixedItem">
                        <a href="{{ route('post') }}" class="spFixedLink">
                            <p class="linkIcon"><img src="/img/common/icon_spfixed02.svg" alt=""></p>
                            <p class="linkTxt">投稿</p>
                        </a>
                    </div>
                {{-- @endcan --}}
                <div class="spFixedItem">
                    <a href="{{ route('chatroom.index') }}" class="spFixedLink">
                        <p class="linkIcon"><img src="/img/common/ico_talk.svg" alt=""></p>
                        <p class="linkTxt">やりとり</p>
                    </a>
                </div>
                <div class="spFixedItem">
                    <a href="{{ route('user_notification.index') }}" class="spFixedLink">
                        <span class="newSpan">@if ($not_view_user_notifications->count() > 0) {{$not_view_user_notifications->count()}}@endif</span>
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
	<x-hide-modal/>
</header>