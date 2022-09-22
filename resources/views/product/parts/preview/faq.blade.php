<div class="optional faq">
    <h2 class="hdM">よくあるご質問</h2>
    <ul class="toggleWrapPC">
        @for($i = 0; $i < 10; $i++)
            @if(isset($request->question_title[$i]))
                <li>
                    <p class="quest toggleBtn break-word"><span>{{$request->question_title[$i]}}</span><span class="more">回答を見る</span></p>
                    <p class="answer toggleBox break-word" style="width:100%;">{{$request->answer[$i]}}</p>
                    <input type="hidden" value="@if(!is_null($request->question_title[$i])){{ $request->question_title[$i] }}@endif" name="question_title[{{$i}}]">
                    <input type="hidden" value="@if(!is_null($request->answer[$i])){{ $request->answer[$i] }}@endif" name="answer[{{$i}}]">
                </li>
            @endif
        @endfor
    </ul>
</div>