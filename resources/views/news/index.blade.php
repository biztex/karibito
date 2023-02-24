<x-support-layout>
    <article>
        <div id="contents">
            <div class="mypageWrap supportWrap detailStyle">
                <div class="inner inner03">
                    <ul class="mypageUl02">
                        @if(empty($news_list[0]))
                            <div class="pl10">カリビトからのお知らせがありません。</div>
                        @else
                            @foreach($news_list as $news)
                                <li>
                                    <a href="{{route('news.show', $news->id)}}">
                                        <dl>
                                            <dt><img src="img/mypage/img_notice01.png" alt=""></dt>
                                            <dd>
                                                <p class="txt">{{$news->title}}</p>
                                                <p class="time">{{$news->created_at->diffForHumans()}}</p>
                                            </dd>
                                        </dl>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                    {{ $news_list->links() }}
                </div>
            </div>
        </div><!-- /#contents -->
    </article>
</x-support-layout>