<p>{{$user_notification->user->name}}様</p>

<p>日頃よりカリビトをご利用いただきありがとうございます。</p>

<p>{{$user_notification->title}}</p><br>
<p>早速確認してみましょう！</p><br>

<p><a href="{{ route('chatroom.show', $user_notification->reference_id) }}">{{ route('chatroom.show', $user_notification->reference_id) }}</a></p>


<p>ご不明な点・ご質問などは「<a href="{{ route('contact') }}">お問合せ</a>」よりご連絡ください。</p>

@include('mail.text.footer')
