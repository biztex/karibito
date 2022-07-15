
{{$user_notification->user->name}}様

{{$user_notification->title}}

{{ route('user_notification.show', $user_notification->id) }}


@include('mail.text.footer')