@foreach($chatroom->chatroomMessage as $message)
    
    <!-- 提案 -->
    @if($message->reference_type === 'App\Models\Proposal')

        @include('chatroom.message.proposal')
    
    <!-- 購入 -->
    @elseif($message->reference_type === 'App\Models\Purchase')

        @include('chatroom.message.purchase')

    <!-- 作業報告 -->
    @elseif($message->is_complete_message === 1)

        @include('chatroom.message.worked')

    <!-- キャンセル -->
    @elseif($message->reference_type === 'App\Models\PurchasedCancel')

        @include('chatroom.message.cancel')

    <!-- 評価完了-->
    @elseif($message->reference_type === 'App\Models\Evaluation')

        @include('chatroom.message.evaluation')

    <!-- 通常-->
    @elseif($message->reference_type === null)
        
        @include('chatroom.message.normal')

    @endif

@endforeach