<div class="indexNotice">
    <div class="inner">
        <div class="box newsList">
            <h2 class="hd">運営からのお知らせ</h2>
            @if(empty($important_news_list[0]))
                <div>運営からのお知らせは現在ありません。</div>
            @else
                @foreach ($important_news_list as $important_news)
                    <dl>
                        <dt>{{$important_news->created_at->format('Y/m/d')}}</dt>
                        <dd><a href="{{ route('news.show', $important_news->id) }}">{{$important_news->title}}</a></dd>
                    </dl>
                @endforeach
            @endif
        </div>
    </div>
</div>