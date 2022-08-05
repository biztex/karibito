<div id="main">
    <div class="title">
        <div class="fun">
            <div class="single">
                <a href="#" tabindex="0"> {{ App\Models\JobRequest::IS_ONLINE[$job_request->is_online] }} </a>
            </div>
            <!-- <a href="#" class="favorite">お気に入り(11)</a> -->
        </div>
        <div class="datas">
            <span class="data">電話相談の受付：{{ App\Models\JobRequest::IS_CALL[$job_request->is_call] }}</span>
            <!-- <span class="data">閲覧：1000</span> -->
            @if(!is_null($job_request->prefecture_id))
                <span class="data">エリア：{{ App\Models\Prefecture::find($job_request->prefecture_id)->name }}</span>
            @endif
        </div>
    </div>
    <div class="drawIllustration">
        <h2 class="hdM">{{ $job_request->title }}</h2>
        <table>
            <tr>
                <th><span class="th">予算</span></th>
                <td><big>{{ number_format($job_request->price) }}円〜</big></td>
            </tr>
            <tr>
                <th><span class="th">残り時間</span></th>
                <td><big>{{ rtrim($diff_time, '後') }}</big></td>
            </tr>
            @if(!is_null($job_request->required_date))
            <tr>
                <th><span class="th">納品希望日</span></th>
                <td>{{ date('Y年m月d日',strtotime($job_request->required_date)) }}</td>
            </tr>
            @endif
            <tr>
                <th><span class="th">掲載日</span></th>
                <td>{{ date('Y年m月d日', strtotime($job_request->created_at)) }}</td>
            </tr>
            <tr>
                <th><span class="th">締切日</span></th>
                <td>{{ date('Y年m月d日',strtotime($job_request->application_deadline)) }}</td>
            </tr>
            <!-- <tr>
                <th><span class="th">提案人数</span></th>
                <td>20人</td>
            </tr> -->
        </table>
    </div>
    <div class="content">
        <h2 class="hdM">サービス内容</h2>
        <p style="overflow-wrap: break-word;">{!! nl2br(e($job_request->content)) !!}</p>
    </div>
</div>