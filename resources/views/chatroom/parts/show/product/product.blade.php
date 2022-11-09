<a href="{{ route('product.show',$chatroom->reference_id) }}" class="after-none">
    <div class="publicate">
        <div class="cont">
            @if(isset($chatroom->reference->productImage[0]))
                <p class="img"><img src="{{ asset('/storage/'.$chatroom->reference->productImage[0]->path)}}" alt=""></p>
            @else
                <p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
            @endif
            <p class="txt">{{ $chatroom->reference->title }}</p>
        </div>
        <div class="amount">
            <p>希望報酬額</p>
            <p class="num">¥{{ number_format($chatroom->reference->price) }}</p>
        </div>
    </div>
</a>