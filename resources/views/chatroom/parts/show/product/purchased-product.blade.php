<a href="{{ route('purchased_product',$chatroom->purchased_reference_id) }}"  class="after-none">
    <div class="publicate">
        <div class="cont">
            @if(isset($chatroom->referencePurchased->productImage[0]))
                <p class="img"><img src="{{ asset('/storage/'.$chatroom->referencePurchased->productImage[0]->path)}}" alt="" style="width: 75px;height: 62.5px;object-fit: cover;"></p>
            @else
                <p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
            @endif
            <p class="txt">{{ $chatroom->referencePurchased->title }}</p>
        </div>
        <div class="amount">
            <p>契約価格</p>
            <p class="num">¥{{ number_format($chatroom->purchase->proposal->price) }}</p>
        </div>
    </div>
</a>