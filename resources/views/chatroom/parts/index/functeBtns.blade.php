<div class="functeBtns st2">

    @if ($value->referencePurchased !== null)
        @if ($value->purchased_reference_type === 'App\Models\PurchasedProduct')
            <a href="{{route('purchased_product', $value->purchased_reference_id)}}" class="blue_o">サービス詳細</a>
        @elseif ($value->purchased_reference_type === 'App\Models\PurchasedJobRequest')
            <a href="{{route('purchased_job_request', $value->purchased_reference_id)}}" class="blue_o">サービス詳細</a>
        @endif
    @else
        @if($value->reference === null)

        @elseif($value->reference_type === 'App\Models\Product')
            <a href="{{route('product.show', $value->reference_id)}}" class="blue_o">サービス詳細</a>
        @else
            <a href="{{route('job_request.show', $value->reference_id)}}" class="blue_o">サービス詳細</a>
        @endif
    @endif
    @if ($value->status === 6)
        <a href="{{route('chatroom.show', $value->id)}}" class="green">取引詳細</a>
    @else
        <a href="{{route('chatroom.show', $value->id)}}" class="green">チャットを開始</a>
    @endif
    @if ($value->trash_flg === 1)
        <form action="{{ route('chatroom.updateTrashFlg', $value->id)}} " method="POST">
            @csrf
            <input type="hidden" name="trash_flg" value="0">
            <button type="submit" class="btn btn-primary btn-sm gray">元に戻す</button>
        </form>
    @elseif($value->trash_flg === null || $value->trash_flg === 0)
        <form action="{{ route('chatroom.updateTrashFlg', $value->id)}} " method="POST">
            @csrf
            <input type="hidden" name="trash_flg" value="1">
            <button type="submit" class="btn btn-primary btn-sm gray">ゴミ箱へ</button>
        </form>
    @endif
</div>
