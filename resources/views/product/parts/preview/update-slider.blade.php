<div class="slider">
    <div class="big">
        @for($i = 0; $i < 10; $i++)
            @if($request['image_status'.$i] === "insert")
                <div class="item" style="background-color: #EFEFEF;"><img id="preview_slider{{$i}}" style="aspect-ratio:16/9; object-fit:contain;" src="{{ $request->base64_text[$i] }}" srcset="" alt=""></div>
            @elseif($request['image_status'.$i] === "delete")
            @elseif($request['image_status'.$i] === null && null !== $request->old_image[$i])
                <div class="item" style="background-color: #EFEFEF;"><img id="preview_slider{{$i}}" style="aspect-ratio:16/9; object-fit:contain;" src="{{ asset('/storage/'.$request->old_image[$i])}}" alt=""></div>
            @endif
        @endfor
    </div>

    <div class="small">
        @for($i = 0; $i < 10; $i++)
            @if($request['image_status'.$i] === "insert")
                <div class="item" style="background-color: #EFEFEF;"><img id="preview_slider{{$i.$i}}" style="aspect-ratio:16/9; object-fit:contain;" src="{{ $request->base64_text[$i] }}"  srcset="" alt=""></div>
            @elseif($request['image_status'.$i] === "delete")
            @elseif($request['image_status'.$i] === null && null !== $request->old_image[$i])
                <div class="item" style="background-color: #EFEFEF;"><img id="preview_slider{{$i.$i}}" style="aspect-ratio:16/9; object-fit:contain;" src="{{ asset('/storage/'.$request->old_image[$i])}}" srcset="" alt=""></div>
            @endif
        @endfor
    </div>
</div>

@for($i = 0; $i < 10; $i++)
    <input type="hidden" name="base64_text[{{$i}}]" value="{{ $request->base64_text[$i] }}">
    <input type="hidden" name="image_status{{$i}}" value="{{ $request['image_status'.$i] }}">
    <input type="hidden" name="old_image[{{$i}}]" value="{{ $request->old_image[$i] }}">
@endfor