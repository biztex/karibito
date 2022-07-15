<x-layout>
    <article>
        <div id="breadcrumb">
            <div class="inner">
                @if($service_type === 'Product')
                    <a href="{{ route('home') }}">ホーム</a>　>　
                    <a href="{{ route('product.show', $service->id) }}">{{$service->title}}</a>　>　
                @else <!-- JobRequest-->
                    <a href="{{ route('home') }}">ホーム</a>　>　
                    <a href="{{ route('job_request.show', $service->id) }}">{{$service->title}}</a>　>　
                @endif
                    <span>チャットを開始</span>
            </div>
        </div><!-- /.breadcrumb -->
        <div id="contents" class="otherPage otherPage2">
            <div class="inner02 clearfix">
                <div id="main">

                    <!-- 掲載者情報 -->
                    @include('chatroom.parts.create.partner')

                    <h2 class="hdM">チャット<a href="#" class="more st2">契約後のキャンセルについて</a></h2>
                    <div class="subPagesTab">
                        <div class="chatPages">
                            <div class="item">
                                <div class="warnBox">
                                    <p class="tit">取引内容を入力し交渉をしましょう</p>
                                    <p>履歴を残すため、カリビト内でのやりとりを推奨しております。</p>
                                    <p class="note">※返信は3日以内にお願いします</p>
                                </div>
                                <ul class="communicate"></ul>
                            </div>

                            <!-- 入力エリア -->
                            @include('chatroom.parts.create.form')

                            <div class="item">
                                <div class="about">
                                    <p class="danger">ご注意！</p>
                                    <p>・履歴を残すため、カリビト内でのやりとりを推奨しております。<br>・トラブルの際は 警察等の捜査依頼に積極的に協力しております 。<br>・直接お会いしての取引は、人目のつく場所か複数人で行いましょう。<br>・ 無断でキャンセル、公序良俗に反する行為、誹謗中傷などは利用停止となることがあります。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /#main -->

                <!-- 掲載内容 -->
                @include('chatroom.parts.create.side')
                
            </div><!--inner-->
        </div><!-- /#contents -->
    </article>
</x-layout>