{{ $request->name }}様から
以下の内容でお問い合わせを受け付けました。

名前：{{ $request->name }}

メールアドレス：{{ $request->mail }}

タイプ：{{ $request->type }}

内容
{{ $request->message }}



@include('mail.text.footer')
