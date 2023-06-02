
<p>{{ $user_notification->user->name }} 様</p>

<span>日頃よりカリビトをご利用いただきありがとうございます。</span><br>
<span>お客様に申請いただきましたお振込みですが、エラーとなりましたのでお知らせいたします。下記よりご確認お願いします。</span><br>
{{-- <span><a href="{{ route('profit.index') }}">{{ route('profit.index') }}</a></span><br> どちらかわからないため一応残しておく--}}
<span><a href="{{ route('transfer_request.show', $transfer_request) }}">{{ route('transfer_request.show', $transfer_request) }}</a></span><br>

<span>お手数ではございますが、再度振込申請をお願いいたします。</span><br>
<span>＊振込手数料¥200はお客様にご負担いただいております。</span><br>
<p>ご不明な点・ご質問などは「<a href="{{ route('contact') }}">お問合せ</a>」よりご連絡ください。</p>

@include('mail.text.footer')
