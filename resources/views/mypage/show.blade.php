<x-layout>
<x-parts.post-button/>
<article>
	<body id="mypage">

		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>マイページ</span>
			</div>
		</div><!-- /.breadcrumb -->

		<x-parts.identification-msg/>
		<x-parts.ban-msg/>
		<x-parts.flash-msg/>
		
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="mypageWrap">
						{{-- 電話対応 --}}
						<!-- 電話機能は一旦止めてほしいためコメントアウト -->
						<!-- @include('mypage.show.call') -->

						{{-- プロフィール --}}
						@include('mypage.show.profile')
						
						{{-- 友達紹介 --}}
						@include('mypage.show.share')

						{{-- お知らせ --}}
						@include('mypage.show.notification')
						
						{{-- 出品サービス --}}
						@include('mypage.show.publication')

						{{-- スキル・経歴・職務 --}}
						@include('mypage.show.skills')
						
						{{-- ポートフォリオ --}}
						@include('mypage.show.portfolio')
						
					</div>{{-- /#mypageWrap --}}
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
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
	</body>
</article>
</x-layout>
<script type="text/javascript">
    $(function () {
	// modal open sns share
		$(".mypageShare").on("click", function() {
			const $overlay = $(".overlayDetail");
			$overlay.css('display', 'block');

			$(".modal").removeClass('hidden');

			const windowHeight = $(window).height();
			const modalBoxHeight = $(".modal__box").innerHeight();
			const topPosition = ((windowHeight - modalBoxHeight) / 2) - 66;
			$(".modal__close").css('top', `${topPosition}px`);
		})

		const closeModal = function() {
			$(".modal").addClass('hidden');
			$(".overlayDetail").css('display', 'none');
		};

		$(".overlayDetail").on("click", function() {
			closeModal();
		})

		$(".modal__close").on('click', function() {
			closeModal();
		});

		
		});
</script>
