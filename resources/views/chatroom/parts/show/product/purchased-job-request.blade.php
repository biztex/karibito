<a href="{{ route('purchased_job_request',$chatroom->purchased_reference_id) }}" class="after-none">
    <div class="publicate">
        <div class="cont">
            <p class="img"><img src="/img/common/img_request@2x.jpg" alt=""></p>
            <p class="txt">{{ $chatroom->referencePurchased->title }}</p>
        </div>
        <div class="amount">
            <p>契約価格</p>
            <p class="num">¥{{ number_format($chatroom->purchase->proposal->price) }}</p>
        </div>
    </div>
</a>