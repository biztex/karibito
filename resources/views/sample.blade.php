<x-layout>
	<article>
		<div class="btnFixed"><a href="{{ route('post') }}"><img src="img/common/btn_fix.svg" alt="投稿"></a></div>
		
		<div id="contents" class="oneColumnPage02">
			<div class="inner">
				<div id="main">
					<div class="loginWrap">
						<h2 class="subPagesHd">会員登録</h2>
						<ul class="stepUl">
							<li class="is_active">
								<p class="stepDot"></p>
								<p class="stepTxt">ログイン</p>
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
							<form action="{{ route('user_profile.store') }}" method="post" enctype="multipart/form-data" name="form1">
								@csrf
								<div class="labelCategory">
									<p>ニックネーム（00字以内）</p>
										@error('name')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
									<p><input type="text" name="name" placeholder="" class="@error('name') is-invalid @enderror" value="{{ old('name') }}"></p>
								</div>
								<div class="labelCategory inlineFlex">
									<p>姓</p>
									@if($errors->has('first_name') || $errors->has('last_name'))
										<div class="alert alert-danger" style="padding-bottom:0;">姓名は必ず指定してください。</div>
									@endif
									<p><input type="text" name="first_name" placeholder="" class="@error('first_name') is-invalid @enderror" value="{{ old('first_name') }}"></p>
								</div>
								<div class="labelCategory inlineFlex">
									<p>名</p>
									@if($errors->has('first_name') || $errors->has('last_name'))
										<div class="alert alert-danger" style="padding-bottom:0;"><br></div>
									@endif
									<p><input type="text" name="last_name" placeholder="" class="@error('last_name') is-invalid @enderror" value="{{ old('last_name') }}"></p>
								</div>
								<div class="labelCategory">
									<div class="radioBox">
										<label><input type="radio" value="1" name="gender" @if(1 == old('gender')) selected @endif>男性</label>
										<label><input type="radio" value="2" name="gender" @if(2 == old('gender')) selected @endif>女性</label>
									</div>
								</div>
								<div class="labelCategory">
									<p>都道府県</p>
										@error('prefecture')
											<div class="alert alert-danger">{{ $message }}</div>
										@enderror
										<div>
											<select name="prefecture" class="@error('prefecture') is-invalid @enderror">
												<option selected="" disabled="">選択してください</option>
												@foreach ( $prefectures as $prefecture )
													<option value="{{$prefecture->id}}"  @if($prefecture->id == old('prefecture')) selected @endif>{{$prefecture->name}}</option>
												@endforeach
											</select>
										</div>
								</div>
								<ul class="loginFormBtn">
									<li><input type="submit" class="submit" value="次へ"></li>
							</form>
									<li><input type="submit" class="submit gray" value="戻る"></li>
								</ul>
						</div>
					</div>
				</div><!-- /#main -->

			</div><!--inner-->
		</div><!-- /#contents -->
	</article>
</x-layout>