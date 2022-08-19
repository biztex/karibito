<div class="mypageSec04">
    <p class="mypageHd02"><span>スキル・経歴・職務</span><a href="{{ route('resume.show') }}" class="more">スキル・経歴・職務を編集する</a>
    </p>
    <div class="mypageItem">
        <p class="mypageHd03">スキル</p>
        @if(Auth::user()->userSkills->isEmpty())
            スキルの登録がありません。
        @else
            <div class="mypageBox">
                <dl class="mypageDl02">
                    <dt>スキル詳細</dt>
                    <dd>
                        <ul class="mypageUl03">
                            @foreach (Auth::user()->userSkills as $value)
                                <li><span>{{ $value->name }}</span>経験：15年</li>
                            @endforeach
                        </ul>
                    </dd>
                </dl>
            </div>
        @endif
    </div>

    <div class="mypageItem">
        <p class="mypageHd03">経歴</p>
        @if(Auth::user()->userCareers->isEmpty())
            経歴の登録がありません。
        @else
            <div class="mypageBox">
                <ul class="mypageUl03">
                    @foreach(Auth::user()->userCareers as $value)
                        <li>
                            <dl class="mypageDl02">
                                <dt>経歴名</dt>
                                <dd><span>{{ $value->name }}</span></dd>
                            </dl>
                            <dl class="mypageDl02">
                                <dt>在籍期間</dt>
                                <dd>{{ $value->first }} ~ @if($value->last_year == null)現在@else{{ $value->last }}@endif</dd>
                            </dl>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="mypageItem">
        <p class="mypageHd03">職務</p>
        @if(!Auth::user()->userJob)
            職務の登録がありません。
        @else
            <div class="mypageBox">
                <div class="mypageDuties">
                    <p>{!!nl2br(Auth::user()->userJob->content)!!}</p>
                </div>
            </div>
        @endif
    </div>
</div>