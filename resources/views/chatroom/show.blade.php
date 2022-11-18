<x-layout>
    <article>
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　
                <a href="{{ route('chatroom.index') }}">やりとり一覧</a>　>　
                @if($chatroom->referencePurchased !== null)
                    <span>{{ $chatroom->referencePurchased->title }}</span>
                @elseif($chatroom->reference !== null)
                    <span>{{ $chatroom->reference->title }}</span>
                @else
                    <span>削除された商品</span>
                @endif
            </div>
        </div><!-- /.breadcrumb -->

        <x-parts.flash-msg/>
        <div id="contents" class="otherPage otherPage2">
            <div class="inner02 clearfix">
                <div id="main">

                    <!-- 取引相手の情報 -->
                    @include('chatroom.parts.show.partner')

                    <h2 class="hdM">チャット<a href="{{ route('support') }}" class="more st2">契約後のキャンセルについて</a></h2>
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
                                @if ($chatroom->status === 6)
                                    <div class="finish_massage">
                                        <p>取引終了となります。ありがとうございました。</p>
                                    </div>
                                @else
                            </div>
                            <!-- 入力エリア -->
                            @if(empty($partner->deleted_at))
                                @include('chatroom.parts.show.form')
                            @endif

                            <div class="item">
                                <div class="about">
                                    <p class="danger">ご注意！</p>
                                    <p>・履歴を残すため、カリビト内でのやりとりを推奨しております。<br>・トラブルの際は 警察等の捜査依頼に積極的に協力しております 。<br>・直接お会いしての取引は、人目のつく場所か複数人で行いましょう。<br>・ 無断でキャンセル、公序良俗に反する行為、誹謗中傷などは利用停止となることがあります。</p>
                                </div>
                                @endif
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

        $('#wrapper').addClass('visible');
    });
</script>
