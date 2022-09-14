
{{$user_notification->user->name}}様

日頃よりカリビトをご利用いただきありがとうございます。


{{$user_notification->title}}
早速確認してみましょう！

{{ route('chatroom.show', $user_notification->reference_id) }}


@include('mail.text.footer')