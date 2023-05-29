<x-support-layout>
    <article>
        <div id="contents">
            <div class="supportWrap supportDetail detailStyle">
                <div class="inner inner04">
                    <div class="title">
                        <h2 class="hdM">本人確認を申請する2ステップ</h2>
                        <p class="sub arrowFlex"><span>▶</span><span>本人確認の申請には出品者情報の登録が必須です。【マイページ＞プロフィールを編集する】から、出品者情報を入力してください。</span></p>
                        <div class="example">
                            <p class="hd02">step１  本人確認書類をアップロードします。</p>
                            <ul>
                                <li>
                                    <p>マイページ上部【本人確認未完了】の【登録する】から申請ページに移り、利用可能な書類を確認した上で、画像をアップロードします。</p>
                                </li>
                            </ul>
                        </div>
                        <div class="example">
                            <p class="hd02">step２　【申請する】をタッチします。</p>
                            <ul>
                                <li>
                                    <p>承認の可否は、申請後３～5日以内に「お知らせ」と「メール」にて通知します。承認後はプロフィールに【本人確認済み】マークが表示されます。</p>
                                    <p class="arrowFlex"><span>＊</span><span>本人確認が承認されると、プロフィールに【秘密保持契約（NDA)締結可】マークを表示出来るようになります。</span></p>
                                    <p style="text-align: end"><a href="{{route('karibitoguide_nda_mark_show')}}" class="supportLink" target="_blank">【秘密保持契約（NDA)締結可】マークの表示はこちら</a></p>
                                    <p class="arrowFlex"><span>＊</span><span>仕事体系が「対面またはどちらでも」のサービス出品は、本人確認が承認されていないとご利用いただけませんのでお気を付けください。</span></p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @include('karibitoguide.parts.to_list_btn')

                </div>
            </div>
        </div>
    </article>
</x-support-layout>
