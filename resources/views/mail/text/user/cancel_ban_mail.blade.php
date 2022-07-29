{{ $request->name }} 様

アカウントの制限が解除されました。

名前：{{ $request->name }}

メールアドレス：{{ $request->mail }}


@include('mail.text.footer')