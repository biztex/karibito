<p>{{ $user->userProfile->full_name }} 様</p>

<span>このたびは本人確認のための資料をご提出いただきありがとうございます。</span><br>
<span>今回頂いた書類を確認させていただきましたが、書類に不備があり承認できませんでした。お手数ですが、再度書類の提出をお願いいたします。</span><br>
<span>本人確認書類の注意事項については下記のガイドをご確認ください。</span><br>

<p><a href="{{ route('karibitoguide_identification') }}">本人確認について</a></p>
<span>＊申請から確認・承認までは5～7営業日ほどお時間を頂きます。</span><br>
<span>＊アップロードできる画像形式はJPEG/ PEGとなります。</span><br>
<span>＊このメールからお申し込みは出来ません。</span><br>

<p>ご不明点・ご質問などは「<a href="{{ route('contact') }}">お問合せ</a>」よりご連絡ください。</p>

@include('mail.text.footer')