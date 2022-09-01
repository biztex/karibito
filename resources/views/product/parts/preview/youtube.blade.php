<div class="content">
    <div class="optional">
        <h2 class="hdM">参考動画</h2>
        @if(isset($iframe_urls))
            @foreach($iframe_urls as $iframe_url)
                <iframe class="" height="400" width="100%" src="{{ $iframe_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            @endforeach
        @endif
    </div>
</div>
@if (!is_null($request->youtube_link))
    @foreach ($request->youtube_link as $v)
        <input type="hidden" value="{{$v}}" name="youtube_link[]">
    @endforeach
@endif