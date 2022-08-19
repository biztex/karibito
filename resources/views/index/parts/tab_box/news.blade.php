<div class="newsList mt60">
    <h2 class="hdM">カリビトからのお知らせ@if(!empty($news_list[0]))<a href="{{ route('news.index') }}" class="more">お知らせをもっと見る</a>@endif</h2>
    <div class=box>
        @if(empty($news_list[0]))
            <div>カリビトからのお知らせがありません。</div>
        @else
            @foreach($news_list as $news)
                <dl>
                    <dt>{{$news->created_at->format('Y/m/d')}}</dt>
                    <dd><a href="{{ route('news.show', $news->id) }}">{{$news->title}}</a></dd>
                </dl>
            @endforeach
        @endif
    </div>
</div>