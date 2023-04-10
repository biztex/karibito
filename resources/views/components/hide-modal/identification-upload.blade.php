@if(Session::has('identify_upload'))
    <div id="identify_upload" class="fancyboxWrap" style="display: none">
        <div class="alertWrap">
            <div class="alertTitle">
                <h2>本人確認申請を受け付けました！</h2>
            </div>
            <div class="alertText">
                <p>
                    本人確認には、申請を頂いてから5～7営業日かかります。<br/>
                    確認終了後、プロフィール画面に本人確認済みのアイコンが表示されます。
                </p>
            </div>
        </div>
    </div>
    <style>
        .alertWrap {
            text-align: left;
        }
        .alertWrap h2 {
            padding-top: 40px;
            font-size: 2.6rem;
            font-weight: bold;
        }
        .alertTitle {
            margin: 0 auto;
            text-align: center;
        }
        .alertText {
            font-size: 16px;
            padding: 40px;
        }
    </style>
    <script>
        window.addEventListener("load", (event) => {
            $.fancybox.open([{
                    href: '#identify_upload',
                }],
                {
                    width: 800,
                    height: 600
                });
        });

    </script>
@endif
