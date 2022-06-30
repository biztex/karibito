{{ $request->name }} 様

お問い合わせメールの送信が完了致しました。
以下の内容でお問い合わせを受け付けました。
運営からの返信までしばらくお待ちください。

名前：{{ $request->name }}

メールアドレス：{{ $request->mail }}

タイプ：{{ \App\Models\ContactMailHistory::CONTACT_TYPES[$request->type] }}

内容
{{ $request->message }}



@include('mail.text.footer')
