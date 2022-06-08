<x-layout>
	<article>
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　<span>利用規約</span>
            </div>
        </div><!-- /.breadcrumb -->
        <div class="btnFixed"><a href="{{ route('post') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>

        <div id="contents" class="oneColumnPage">
            <div class="inner">
                <div id="main">
                    <div class="subPagesWrap">
                        <h2 class="subPagesHd">利用規約</h2>
                        <p class="card-text">
                            {{!! nl2br(e(file_get_contents('./text/terms-of-service.txt'))) !!}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
		<x-hide-modal/>
	</article>
</x-layout>