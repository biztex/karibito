<p>{{ $user->name }} 様</p>

<p>日頃よりカリビトをご利用いただきありがとうございます。</p><br>
<p>カリビトポイントが付与されましたのでご確認ください！</p><br>
<a href="{{ route('point.index') }}">{{ route('point.index') }}</a><br>
<p>ポイントを使って気になるサービスをぜひお試しください。</p><br>

<p>ご不明な点・ご質問などは「<a href="{{ route('contact') }}">お問合せ</a>」よりご連絡ください。</p>

@include('mail.text.footer')
