<x-layout>
	<article>
	<body id="member">
		<div id="breadcrumb">
			<div class="inner">
				<a href="{{ route('home') }}">ホーム</a>　>　<span>メンバー情報</span>
			</div>
		</div><!-- /.breadcrumb -->
		<x-parts.flash-msg/>

		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="subPagesWrap">
						<h2 class="subPagesHd">メンバー情報</h2>
						<div class="">
							<ul class="mypageUl02 memberUl01">
								<li><a href="{{ route('member_config.index') }}">プロフィール</a></li>
								<li><a href="#">お支払い方法</a></li>
								<li><a href="#">受取口座の登録・変更</a></li>
								<li><a href="#">入出金履歴</a></li>
								<li><a href="{{ route('member_config.email.edit') }}">メールアドレスの変更</a></li> <!--1 追加 -->
								@can('exist.password')
									<li><a href="{{ route('member_config.password.edit') }}">パスワードの変更</a></li>
								@endcan
							</ul>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!-- /#contents -->
		<x-hide-modal/>
	</article>
</x-layout>