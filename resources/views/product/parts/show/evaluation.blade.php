<div class="clientEvaluate">
    <h2 class="hdM">依頼者からの評価</h2>
    <div class="box">
        @if($evaluations->isEmpty())
            <p>評価はまだありません。</p>
        @else
            <div class="ftBox">
                @foreach($evaluations as $value)
                    <li>
                        <div class="img">
                            @if(empty($value->user->userProfile->icon))
                                <p class="head"><img src="/img/mypage/no_image.jpg" alt=""></p>
                            @else
                                <p class="head"><img src={{asset('/storage/'.$value->user->userProfile->icon) }} alt=""></p>
                            @endif

                            @if($value->star == App\Models\Evaluation::PITY)
                                <p class="evaluate eva03"></p>
                            @elseif($value->star == App\Models\Evaluation::USUALLY)
                                <p class="evaluate eva02"></p>
                            @else
                                <p class="evaluate eva01"></p>
                            @endif
                        </div>
                        <div class="info">
                            <p>{{ $value->user->name }}<span class="date">{{ date("Y年n月j日",strtotime($value->created_at)) }}</span></p>
                            <p>{!! nl2br(e($value->text)) !!}</p>
                        </div>
                    </li>
                @endforeach
            </div>
        @endif

        <ul>Data loading, please wait...</ul>
        @if(count($evaluations) > 5)
            <div class="go"><a href="javascript:;" onClick="moreload.loadMore();" class="more">もっと見る</a></div>
        @endif
    </div>
</div>