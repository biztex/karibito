<p>{{ $request->name }} 様</p>

<p>日頃よりカリビトをご利用いただきありがとうございます。</p>

<span>名前：{{ $request->name }}</span><br>
<span>メールアドレス：{{ $request->mail }}</span><br>
<span>タイプ：{{ \App\Models\ContactMailHistory::CONTACT_TYPES[$request->type] }}</span><br>
<span>内容：{{ $request->message }}</span><br><br>

<span>事務局で内容を確認しまして、順次ご返信いたします。今しばらくお待ちください。</span><br>

<p>よろしくお願い致します。</p>
<span>＊このメールは配信専用です。ご返信いただいてもお返事できませんので、あらかじめご了承ください。</span><br>
<span>＊メールのサービス変更・停止は<a href="{{ route('setting.index') }}">こちら</a>からお願いします。</span><br>

<span>━━━━━━━━━━━━━━━━━━━━━━━━━</span><br>
<span>カリビト事務局</span><br>
<span>──────────────────────────────</span><br>
<span>Email: info@karibito.co.jp</span><br>
<span>URL: https://karibito.co.jp/</span><br>
<span>━━━━━━━━━━━━━━━━━━━━━━━━━━━━</span><br>