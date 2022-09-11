
{{$user_notification->user->name}}様

日頃よりカリビトをご利用いただきありがとうございます。


{{$user_notification->title}}
早速確認してみましょう！

{{ route('user_notification.index') }}


@include('mail.text.footer')