
{{$user_notification->user->name}}様

日頃よりカリビトをご利用いただきありがとうございます。


{{$user_notification->title}}
{{ route('user_notification.index') }}


@include('mail.text.footer')