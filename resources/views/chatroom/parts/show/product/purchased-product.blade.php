<div class="publicate">
    <a href="{{ route('chatroom.show.purchased_product',$chatroom->referencePurchased->id) }}">
        <div class="cont">
            @if(isset($chatroom->referencePurchased->productImage[0]))
                <p class="img"><img src="{{ asset('/storage/'.$chatroom->referencePurchased->productImage[0]->path)}}" alt="" style="width: 75px;height: 62.5px;object-fit: cover;"></p>
            @else
                <p class="img"><img src="/img/common/img_work01@2x.jpg" alt=""></p>
            @endif
            <p class="txt">{{ $chatroom->referencePurchased->title }}</p>
        </div>
    </a>
    <div class="amount">
        <p>購入金額</p>
        <p class="num">¥{{ number_format($chatroom->referencePurchased->price) }}</p>
    </div>
</div>