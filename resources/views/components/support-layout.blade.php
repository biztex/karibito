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
            <x-parts.ban-msg/>

            {{$slot}}
            
            <x-footer/>
        </div><!-- /#wrapper -->
    </body>
</x-app>
