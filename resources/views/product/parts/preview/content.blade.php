<div class="content">
    <h2 class="hdM">サービス内容</h2>
    <p style="overflow-wrap: break-word;">
        @if(!is_null($request->content)){!! nl2br(e($request->content)) !!}@endif
    </p>
    <textarea style="display:none;" name="content">
        @if(!is_null($request->content)){{ $request->content }}@endif
    </textarea>
</div>