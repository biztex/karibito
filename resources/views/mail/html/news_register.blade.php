
{{$user_notification->user->name}}様

{{$user_notification->title}}

{{ route('already_read.show', $user_notification) }}


@include('mail.text.footer')