<p>{{ $request->full_name }} 様</p>


<span>日頃よりカリビトをご利用いただきありがとうございます。</span><br>
<span>当社のセキュリティ観点により、こちらのアカウントの一部機能を制限いたしました。</span><br>
<span>【制限されている機能】</span><br>
<span>出品・リクエスト・チャット・振込申請・いいね 他</span><br>
<p>制限を解除するには、お手数ではございますが「<a href="{{ route('terms-of-service') }}">利用規約</a>」及び「<a href="{{route('karibitoguide')}}">カリビトガイド</a>」をご確認の上、お問合せよりご連絡ください。</p>

@include('mail.text.footer')