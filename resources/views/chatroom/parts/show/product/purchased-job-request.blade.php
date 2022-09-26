<div class="publicate">
    <a href="{{ route('chatroom.show.purchased_job_request',$chatroom->referencePurchased->id) }}">
        <div class="cont">
            <p class="img"><img src="/img/common/img_request@2x.jpg" alt=""></p>
            <p class="txt">{{ $chatroom->referencePurchased->title }}</p>
        </div>
    </a>
    <div class="amount">
        <p>購入金額</p>
        <p class="num">¥{{ number_format($chatroom->referencePurchased->price) }}</p>
    </div>
</div>