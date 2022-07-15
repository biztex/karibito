<p>

    {{$user_notification->user->name}}様<br><br>

    {{$user_notification->title}}<br><br>

    {{-- {{$user_notification->content}} --}}
    <a href="{{route('user_notification.show', $user_notification->id)}}">{{route('user_notification.show', $user_notification->id)}}</a><br><br><br><br>


@include('mail.text.footer')