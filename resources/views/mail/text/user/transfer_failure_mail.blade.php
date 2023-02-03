
{{ $user_notification->user->name }}様

日頃よりカリビトをご利用いただきありがとうございます。

{{ $user_notification->title }}詳細は下記から確認できます
{{ route('transfer_request.show', $user_notification->reference_id) }}

お手数ではございますが、再度振り込み申請をお願いいたします。

@include('mail.text.footer')
