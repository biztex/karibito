<p>{{ $user->name }} 様</p>

<p>日頃よりカリビトをご利用いただきありがとうございます。</p><br>
<p>クーポンが付与されましたのでご確認ください！</p><br>
<a href="{{ route('coupon.index') }}">{{ route('coupon.index') }}</a><br>
<p>お得なクーポンで気になるサービスをぜひお試しください。</p><br>

<p>ご不明な点・ご質問などは「<a href="{{ route('contact') }}">お問合せ</a>」よりご連絡ください。</p>

@include('mail.text.footer')
