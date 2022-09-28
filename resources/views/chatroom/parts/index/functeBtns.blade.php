<div class="functeBtns st2">

    @if ($value->referencePurchased !== null)
        @if ($value->purchased_reference_type === 'App\Models\PurchasedProduct')
            <a href="{{route('purchased_product', $value->purchased_reference_id)}}" class="blue_o">チケット詳細</a>
        @elseif ($value->purchased_reference_type === 'App\Models\PurchasedJobRequest')
            <a href="{{route('purchased_job_request', $value->purchased_reference_id)}}" class="blue_o">チケット詳細</a>
        @endif
    @else
        @if($value->reference === null)

        @elseif($value->reference_type === 'App\Models\Product')
            <a href="{{route('product.show', $value->reference_id)}}" class="blue_o">チケット詳細</a>
        @else
            <a href="{{route('job_request.show', $value->reference_id)}}" class="blue_o">チケット詳細</a>
        @endif
    @endif

        <a href="{{route('chatroom.show', $value->id)}}" class="green">チャットを開始</a>
</div>