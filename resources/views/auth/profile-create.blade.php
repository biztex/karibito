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
								<form action="{{ route('friend_code') }}" method="get" id="form" enctype="multipart/form-data" name="form1">
									@csrf
									<div class="labelCategory">
										<p>ニックネーム（24字以内）</p>
											@error('name')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
										<p><input type="text" name="name" placeholder="" class="@error('name') is-invalid @enderror" value="{{ old('name') }}" required></p>
									</div>

										@if($errors->has('first_name'))
											<div class="alert alert-danger" style="padding-bottom:0;">{{$errors->first('first_name')}}</div>
										@elseif($errors->has('last_name'))
											<div class="alert alert-danger" style="padding-bottom:0;">{{$errors->first('last_name')}}</div>
										@else
											<!--  -->
										@endif
									<div class="labelCategory inlineFlex">
										<p>姓</p>
										<p><input type="text" name="first_name" placeholder="" class="@error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required></p>
									</div>
									<div class="labelCategory inlineFlex">
										<p>名</p>
										<p><input type="text" name="last_name" placeholder="" class="@error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required></p>
									</div>
									<div class="labelCategory">
										<div class="radioBox">
											@error('gender')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
											<label><input type="radio" value="1" name="gender" @if(1 == old('gender')) checked @endif required>男性</label>
											<label><input type="radio" value="2" name="gender" @if(2 == old('gender')) checked @endif>女性</label>
										</div>
									</div>
									<div class="labelCategory">
										<p>都道府県</p>
											@error('prefecture')
												<div class="alert alert-danger">{{ $message }}</div>
											@enderror
											<div>
												<select name="prefecture_id" class="@error('prefecture') is-invalid @enderror" required>
													<option value="">選択してください</option>
													@foreach ( App\Models\Prefecture::all() as $prefecture )
														<option value="{{$prefecture->id}}"  @if($prefecture->id == old('prefecture_id')) selected @endif>{{$prefecture->name}}</option>
													@endforeach
												</select>
											</div>
									</div>
									<p style="font-size:12px;">※ニックネームは公開されます。<br>　本人認証に利用されるものと同じ姓名でご記入ください。</p>
									<ul class="loginFormBtn">
										<li><input type="submit" class="submit loading-disabled" value="次へ"></li>
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
