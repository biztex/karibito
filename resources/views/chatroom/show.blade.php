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

                    <h2 class="hdM">チャット<a href="{{ route('karibitoguide_cancel_send') }}" class="more st2" target="_blank">契約後のキャンセルについて</a></h2>
                    <div class="subPagesTab">
                        <div class="chatPages">
                            <div class="item">
                                <div class="warnBox">
                                    <p class="warnBoxTitle" style="color:red;">【注意事項】</p>
                                    <p class="warnBoxText">メッセージのやり取りは、必ず「カリビトチャット」を通じて行ってください。<br>・メールアドレス・LINE・電話など外部連絡先の交換、またそれらを用いてのやり取り<br>・カリビト外での直接取引を促す行為<br>カリビトではこれらの行為を禁止しております。<br>確認した場合、アカウントの停止など、今後のご利用をお断りさせていただくことがございますので、ご注意ください。</p>
                                </div>
                                <ul class="communicate">
                                    <!-- メッセージ内容 -->
                                    @include('chatroom.parts.show.message')
                                </ul>
                                @if (($chatroom->status !== \App\Models\Chatroom::STATUS_COMPLETE && $chatroom->status !== \App\Models\Chatroom::STATUS_CANCEL_RECEIVE_EVALUATION) || null !== $partner->deleted_at)
                                        @include('chatroom.parts.show.form')
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
