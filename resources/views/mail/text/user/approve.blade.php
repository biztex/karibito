<p>{{ $user->name }} 様</p>

<span>このたびは本人確認のお手続きをしていただきありがとうございます。</span><br>
<span>本人確認が完了いたしましたので、プロフィールに「本人確認済み」マークが表示されます。</span><br>
<span>また、プロフィールに「秘密保持契約（NDA）」締結可」マークを表示させることができます。</span><br>
<span><a href="{{route('karibitoguide_nda_mark_show')}}">【秘密保持契約（NDA）締結可】マークを表示するには</a></span><br>
<span>安心安全のため、本人確認承認後はご住所 / 姓名/ 生年月日のご変更ができなくなっております。</span><br>
<p>今後ご変更されたい場合は「<a href="{{ route('contact') }}">お問合せ</a>」よりご連絡ください。</p>

@include('mail.text.footer')