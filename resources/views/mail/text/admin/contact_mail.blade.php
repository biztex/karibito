{{ $request->name }}様から
以下の内容でお問い合わせを受け付けました。

名前：{{ $request->name }}

メールアドレス：{{ $request->mail }}
タイプ：{{ \App\Models\ContactMailHistory::CONTACT_TYPES[$request->type] }}
内容
{{ $request->message }}



@include('mail.text.footer')
