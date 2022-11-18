<x-layout>
	<article>
		<body id="create" class="none-modal">
			<div id="contents" class="oneColumnPage02">
				<div class="inner">
					<div id="main">
						<div class="loginWrap">
							<h2 class="subPagesHd">会員登録</h2>
							<ul class="stepUl">
								<li class="is_active">
									<p class="stepDot"></p>
									<p class="stepTxt">仮登録</p>
								</li>
								<li class="is_active">
									<p class="stepDot"></p>
									<p class="stepTxt">基本情報</p>
								</li>
								<li>
									<p class="stepDot"></p>
									<p class="stepTxt">完了</p>
								</li>
							</ul>
							<div class="contactBox">
								<form action="{{ route('user_profile.store') }}" method="post" id="form" enctype="multipart/form-data" name="form1">
									@csrf
									<div class="labelCategory">
										<p>友達招待コード</p>
											@error('friend_code')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										<p><input type="text" name="friend_code" placeholder="" class="@error('friend_code') is-invalid @enderror" value="{{ old('friend_code') }}" required></p>
									</div>
                                    <div class="labelCategory">
										<p>カリビトをどこで知り合いましたか？</p>
                                        <select name="where_know" class="@error('where_know') is-invalid @enderror" required>
                                            <option value="">選択してください</option>
                                            <option value="1" @if (old('where_know') == '1') 'selected'  @endif >Yahoo!、Googleなどで検索した</option>
											<option value="2" @if (old('where_know') == '2') 'selected'  @endif >知人が紹介してくれた（ブログ、SNS、メールなどウェブで）</option>
											<option value="3" @if (old('where_know') == '3') 'selected'  @endif >知人が紹介してくれた（直接口コミで）</option>
											<option value="4" @if (old('where_know') == '4') 'selected'  @endif >他のサイトで紹介されていた</option>
											<option value="5" @if (old('where_know') == '5') 'selected'  @endif >ウェブ上で広告をみた</option>
											<option value="6" @if (old('where_know') == '6') 'selected'  @endif >新聞・雑誌で見た</option>
											<option value="7" @if (old('where_know') == '7') 'selected'  @endif >ビラを受け取った</option>
											<option value="8" @if (old('where_know') == '8') 'selected'  @endif >その他</option>
                                        </select>
                                    </div>
									<input type="hidden" name="name" value="{{ $name }}">
									<input type="hidden" name="first_name" value="{{ $first_name }}">
									<input type="hidden" name="last_name" value="{{ $last_name }}">
									<input type="hidden" name="gender" value="{{ $gender }}">
									<input type="hidden" name="prefecture_id" value="{{ $prefecture }}">
									<ul class="loginFormBtn">
										<li><input type="submit" class="submit loading-disabled" value="登録"></li>
									</ul>
                                    <ul class="loginFormBtn">
                                        {{-- {{ route('create') }} --}}
										<li><a href="http://127.0.0.1:8000/user_profile/create">戻る</a></li>
									</ul>
								</form>
							</div>
						</div>
					</div><!-- /#main -->
				</div><!--inner-->
			</div><!-- /#contents -->
		</body>
	</article>
</x-layout>
