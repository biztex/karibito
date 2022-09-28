<a href="{{ route('job_request.show',$chatroom->reference_id) }}" class="after-none">
    <div class="publicate">
        <div class="cont">
            <p class="img"><img src="/img/common/img_request@2x.jpg" alt=""></p>
            <p class="txt">{{ $chatroom->reference->title }}</p>
        </div>
        <div class="amount">
            <p>予算額</p>
            <p class="num">¥{{ number_format($chatroom->reference->price) }}</p>
        </div>
    </div>
</a>