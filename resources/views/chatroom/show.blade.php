<x-layout>
    <article>
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('chatroom.index') }}">やりとり一覧</a>　>　
                <span>チャットを開始</span>
            </div>
        </div><!-- /.breadcrumb -->

        <x-parts.flash-msg/>
        <div id="contents" class="otherPage otherPage2">
            <div class="inner02 clearfix">
                <div id="main">

                    <!-- 取引相手の情報 -->
                    @include('chatroom.parts.show.partner')

                    <h2 class="hdM">チャット<a href="#" class="more st2">契約後のキャンセルについて</a></h2>
                    <div class="subPagesTab">
                        <div class="chatPages">
                            <div class="item">
                                <div class="warnBox">
                                    <p class="tit">取引内容を入力し交渉をしましょう</p>
                                    <p>履歴を残すため、カリビト内でのやりとりを推奨しております。</p>
                                    <p class="note">※返信は3日以内にお願いします</p>
                                </div>
                                <ul class="communicate">
                                    <!-- メッセージ内容 -->
                                    @include('chatroom.parts.show.message')
                                </ul>
                            </div>

                            <!-- 入力エリア -->
                            @include('chatroom.parts.show.form')
                            
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
                @include('chatroom.parts.show.side')
                
            </div><!--/.inner02-->
        </div><!-- /#contents -->
    </article>
</x-layout>
<script>
	$(function(){

        if (@json($errors->has('price'))) {
            $('.fancybox').trigger('click');
            $('html').addClass('fancybox-margin fancybox-lock');
        };

    });
</script>