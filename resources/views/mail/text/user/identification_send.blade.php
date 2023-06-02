<p>{{Auth::user()->name}}様</p>

<span>このたびは本人確認のための資料を提出いただきありがとうございます。</span><br>
<span>事務局で確認後、審査結果をお知らせと通知にてご連絡いたしますので、今しばらくお待ちください。</span><br>
<span>＊審査には通常5～7営業日ほどお時間を頂きます。</span><br>

<p>ご不明な点・ご質問などは「<a href="{{ route('contact') }}">お問合せ</a>」よりご連絡ください。</p>

@include('mail.text.footer')