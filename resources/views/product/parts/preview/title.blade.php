<div class="title">
    <div class="fun">
        <div class="single">
            <a href="#" tabindex="0">@if(!is_null($request->is_online)){{ App\Models\Product::IS_ONLINE[$request->is_online] }}@endif</a>
            <input type="hidden" value="@if(!is_null($request->is_online)){{ $request->is_online }}@endif" name="is_online">
        </div>
        <!-- <a href="#" class="favorite">お気に入り(11)</a> -->
    </div>
    <div class="datas">
        <span class="data">電話相談の受付：@if(!is_null($request->is_call)){{ App\Models\Product::IS_CALL[$request->is_call] }}@endif</span>
        <input type="hidden" value="@if(!is_null($request->is_call)){{ $request->is_call }}@endif" name="is_call">
        <!-- <span class="data">閲覧：1000</span> -->
        @if(!is_null($request->prefecture_id))
            <span class="data">エリア：{{ App\Models\Prefecture::find($request->prefecture_id)->name }}</span>
        @endif
        <span class="data">投稿日：{{now()->format('Y/m/d')}}</span>
        <input type="hidden" value="@if(!is_null($request->prefecture_id)){{ $request->prefecture_id }}@endif" name="prefecture_id">
        <!-- <span class="data">販売数：無制限</span> -->
    </div>
    <h2><span>@if(!is_null($request->title)){{ $request->title }}@endif</span></h2>
    <input type="hidden" value="@if(!is_null($request->title)){{ $request->title }}@endif" name="title">
</div>