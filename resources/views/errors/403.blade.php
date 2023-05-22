<x-layout>
    <article>
        <div class="error_page">
            <div class="error-card">
                <div class="error-header">403エラー</div>
                <div class="error-body">
                    <p style="margin-bottom: 15px;">許可されていません。</p>
                    {{-- <a class="btn btn-dark" href="javascript:history.back();" style="text-decoration: underline; margin-right: 15px; margin-top: 15px;">一つ前に戻る</a> --}}
                    <a class="btn btn-dark" href="{{route('home')}}" style="text-decoration: underline;">トップ画面に戻る</a>
                </div>
            </div>
        </div>
    </article>
</x-layout>