<x-app>
    <body>
        <div id="wrapper" class="other_user">
                <x-header>
                    <div class="otherNav">
                        <div class="inner">
                            <ul>
                                <li><a href="other_mypage.html">ホーム</a></li>
                                <li><a href="other_evaluation.html">評価</a></li>
                                <li><a href="other_resume.html">スキル・経歴</a></li>
                                <li><a href="other_portfolio.html">ポートフォリオ</a></li>
                                <li><a href="other_publication.html" class="is_active">出品サービス</a></li>
                                <li><a href="other_blog.html">ブログ</a></li>
                            </ul>
                        </div>
                    </div>
                </x-header>
                {{$slot}}
            <x-footer/>
        </div>
    </body>
</x-app>