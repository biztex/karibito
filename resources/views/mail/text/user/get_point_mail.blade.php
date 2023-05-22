<p>{{ $user_profile->full_name }} 様</p>

<span>日頃よりカリビトをご利用いただきありがとうございます。</span><br>
<span>カリビトポイントが付与されましたのでご確認ください！</span><br>
<a href="{{ route('point.index') }}">{{ route('point.index') }}</a><br>
<span>ポイントを使って気になるサービスをぜひお試しください。</span><br>

<p>ご不明な点・ご質問などは「<a href="{{ route('contact') }}">お問合せ</a>」よりご連絡ください。</p>

@include('mail.text.footer')
