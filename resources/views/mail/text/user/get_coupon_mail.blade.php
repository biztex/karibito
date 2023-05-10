<p>{{ $user_profile->full_name }} 様</p>

<span>日頃よりカリビトをご利用いただきありがとうございます。</span><br>
<span>クーポンが付与されましたのでご確認ください！</span><br>
<a href="{{ route('coupon.index') }}">{{ route('coupon.index') }}</a><br>
<span>お得なクーポンで気になるサービスをぜひお試しください。</span><br>

<p>ご不明な点・ご質問などは「<a href="{{ route('contact') }}">お問合せ</a>」よりご連絡ください。</p>

@include('mail.text.footer')
