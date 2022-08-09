<x-other-user.layout>
	<article>
        <body id="chatroom-active">
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　<span>進行中の取引</span>
            </div>
        </div><!-- /.breadcrumb -->		
        <x-parts.post-button/>
        <div id="contents" class="otherPage">
            <div class="inner02 clearfix">
                <div id="main">
                    <div class="subPagesWrap favoriteWrap">
                        <h2 class="subPagesHd">進行中の取引</h2>
                        <div class="subPagesTab tabWrap">
                            <ul class="tabLink">
                                <li><a href="#tab_box01" class="is_active">提供</a></li>
                                <li><a href="#tab_box02" id="box02">リクエスト</a></li>
                            </ul>

                            <div class="tabBox is_active" id="tab_box01">
                                <ul class="favoriteUl01 ">

                                @if($active_product_chatrooms->isEmpty())
                                    <p>進行中の取引はありません。</p>
                                @else
                                    @foreach($active_product_chatrooms as $value)
                                        @include('mypage.chatroom.product')
                                    @endforeach
                                @endif
                                </ul>
                            {{ $active_product_chatrooms->fragment('')->links() }}
                            </div>

                            <div class="tabBox" id="tab_box02">
                                <ul class="favoriteUl01 ">
                                    @if($active_job_request_chatrooms->isEmpty())
                                        <p>進行中の取引はありません。</p>
                                    @else
                                        @foreach($active_job_request_chatrooms as $value)
                                            @include('mypage.chatroom.job-request')
                                        @endforeach
                                    @endif  
                                </ul>
                            {{ $active_job_request_chatrooms->fragment('job-request')->links() }}
                            </div>
                            
                        </div>
                    </div>
                </div><!-- /#main -->
                <x-side-menu/>
            </div><!--inner-->
        </div><!-- /#contents -->
    </article>
</x-layout>