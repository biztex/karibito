{{ $request->name }} 様

アカウントの一部機能が制限されました。異議を申し立てる場合はお問い合わせからご連絡ください。

名前：{{ $request->name }}

メールアドレス：{{ $request->mail }}


@include('mail.text.footer')
