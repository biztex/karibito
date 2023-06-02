<p>{{$user_notification->user->name}}様</p>

<span>{{$user_notification->title}}</span><br>

<p><a href="{{ route('already_read.show', $user_notification) }}">{{ route('already_read.show', $user_notification) }}</a></p>

<p>詳細は上記URLからご確認をお願いします。</p>

<p>ご不明な点・ご質問などは「<a href="{{ route('contact') }}">お問合せ</a>」よりご連絡ください。</p>

@include('mail.text.footer')