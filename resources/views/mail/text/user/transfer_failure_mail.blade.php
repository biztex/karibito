
<p>{{ $user_notification->user->name }} 様</p>

<p>日頃よりカリビトをご利用いただきありがとうございます。</p><br>
<p>お客様に申請いただきましたお振込みですが、エラーとなりましたのでお知らせいたします。下記よりご確認お願いします。</p><br>
{{-- <span><a href="{{ route('profit.index') }}">{{ route('profit.index') }}</a></span><br> どちらかわからないため一応残しておく--}}
<p><a href="{{ route('transfer_request.show', $transfer_request) }}">{{ route('transfer_request.show', $transfer_request) }}</a></p><br>

<p>お手数ではございますが、再度振込申請をお願いいたします。</p><br>
<p>＊振込手数料¥200はお客様にご負担いただいております。</p><br>
<p>ご不明な点・ご質問などは「<a href="{{ route('contact') }}">お問合せ</a>」よりご連絡ください。</p>

@include('mail.text.footer')
