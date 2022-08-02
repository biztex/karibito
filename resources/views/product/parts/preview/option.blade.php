<div class="optional">
    <h2 class="hdM">オプション追加料金</h2>
    <ul>
        @for($i = 0; $i < 10; $i++)
            @if(isset($request->option_name[$i]))
                @if ($request->option_is_public[$i] == App\Models\AdditionalOption::STATUS_PUBLISH)
                    <li>
                        <span class="add">＋ {{$request->option_name[$i]}}</span>
                        <span class="price">￥{{ number_format(App\Models\AdditionalOption::OPTION_PRICE[$request->option_price[$i]])}}</span>
                    </li>
                @endif
                <input type="hidden" value="@if(!is_null($request->option_name[$i])){{ $request->option_name[$i] }}@endif" name="option_name[{{$i}}]">
                <input type="hidden" value="@if(!is_null($request->option_price[$i])){{ $request->option_price[$i] }}@endif" name="option_price[{{$i}}]">
                <input type="hidden" value="@if(!is_null($request->option_is_public[$i])){{ $request->option_is_public[$i] }}@endif" name="option_is_public[{{$i}}]">
            @endif
        @endfor
    </ul>
</div>