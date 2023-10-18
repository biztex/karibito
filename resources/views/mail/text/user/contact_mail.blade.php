<p>{{ $request->name }} 様</p>

<p>日頃よりカリビトをご利用いただきありがとうございます。</p><br>
<p>お客様からのお問合せメールを受け付けました。</p><br>

<p>名前：{{ $request->name }}</p><br>
<p>メールアドレス：{{ $request->mail }}</p><br>
<p>タイプ：{{ \App\Models\ContactMailHistory::CONTACT_TYPES[$request->type] }}</p><br>
<p>内容：{{ $request->message }}</p><br><br>

<p>事務局で内容を確認しまして、順次ご返信いたします。今しばらくお待ちください。</p><br>

<p>よろしくお願い致します。</p>
<p>＊このメールは配信専用です。ご返信いただいてもお返事できませんので、あらかじめご了承ください。</p><br>
<p>＊メールのサービス変更・停止は<a href="{{ route('setting.index') }}">こちら</a>からお願いします。</p><br>

<p>━━━━━━━━━━━━━━━━━━━━━━━━━</p><br>
<p>カリビト事務局</p><br>
<p>──────────────────────────────</p><br>
<p>Email: info@karibito.co.jp</p><br>
<p>URL: https://karibito.co.jp/</p><br>
<p>━━━━━━━━━━━━━━━━━━━━━━━━━━━━</p><br>
