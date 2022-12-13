<x-layout>
    <x-parts.post-button/>
    <div id="blog">
        <div id="breadcrumb">
            <div class="inner">
                <a href="{{ route('home') }}">ホーム</a>　>　<span>ブログ</span>
            </div>
        </div><!-- /.breadcrumb -->
        <x-parts.ban-msg/>
        <x-parts.flash-msg/>
		<div id="contents" class="otherPage">
			<div class="inner02 clearfix">
				<div id="main">
					<div class="blogWrap">
						<p class="mypageHd02"><span>ブログ</span></p>
						<div class="mypageEditBox">
							<div class="mypageEditList">
								<p class="mypageEditHd">タイトル</p>
								<div class="mypageEditInput"><input type="text" name="" placeholder="タイトルを入力してください"></div>
							</div>
							<div class="mypageEditList">
								<p class="mypageEditHd">投稿する内容をご記入ください</p>
								<div class="postFunction">
									<a href="#"><img src="img/blog/ico_post01.svg" alt=""></a>
									<a href="#"><img src="img/blog/ico_post02.svg" alt=""></a>
									<a href="#"><img src="img/blog/ico_post03.svg" alt=""></a>
									<a href="#"><img src="img/blog/ico_post04.svg" alt=""></a>
								</div>
								<div class="mypageEditInput"><textarea placeholder="000文字以上で入力してください"></textarea></div>
							</div>
							<div class="mypageEditList">
								<p class="mypageEditHd">投稿を選択してください</p>
								<div class="mypageEditInput">
									<select class="middle_ipt">
										<option>選択してください</option>
										<option>選択してください1</option>
										<option>選択してください2</option>
										<option>選択してください3</option>
									</select>
								</div>
							</div>
							<div class="fancyPersonBtn">
								<a href="#" class="fancyPersonCancel">キャンセル</a>
								<a href="#" class="fancyPersonSign">登録する</a>
							</div>
						</div>
					</div>
				</div><!-- /#main -->
				<x-side-menu/>
			</div><!--inner-->
		</div><!--contents-->
	<x-hide-modal/>
</x-layout>