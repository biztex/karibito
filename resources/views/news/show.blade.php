{{-- <x-support-layout> --}}
    <x-app>
    <div id="wrapper" class="st2 bg04 bg-customer-gray">
        <header>
            <div id="header" class="">
                <div id="headerLinks">
                    <div class="inner">
                        <div class="item">
                            <h1 id="headerLogo"><a href="{{ route('home') }}"><img class="pc" src="/img/common/logo.svg" alt="LOGO"><img class="sp" src="/img/common/logo_sp.svg" alt="LOGO"></a></h1>
                        </div>
                        <p class="custTit">カリビトからのお知らせ詳細</p>
                    </div>
                </div><!-- /.headLinks -->
            </div><!-- /#header -->
        </header>
        <article>
            <div id="contents">
                <div class="supportNewsWrap">
                    <div class="inner">
                        <div class="supportNewsDetail">
                            <h2 class="title">{{$news->title}}</h2>
                            <p class="date">{{date('Y/m/d', strtotime($news->created_at))}}</p>
                            <div class="message">
                                <p>{!!$news->content!!}</p>
                            </div>
                        </div>
                        <div class="supportNewsBtn"><a href="{{ route('news.index') }}">CLOSE</a></div>
                    </div>
                </div>
            </div><!-- /#contents -->
        </article>
    </div><!-- /#wrapper -->

{{-- </x-support-layout> --}}
</x-app>