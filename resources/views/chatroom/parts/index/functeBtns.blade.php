<div class="functeBtns st2">
    @if($value->reference === null)

    @elseif($value->reference_type === 'App\Models\Product')
        <a href="{{route('product.show', $value->reference_id)}}" class="blue_o">チケット詳細</a>
    @else
        <a href="{{route('job_request.show', $value->reference_id)}}" class="blue_o">チケット詳細</a>
    @endif
    <a href="{{route('chatroom.show', $value->id)}}" class="green">チャットを開始</a>
</div>