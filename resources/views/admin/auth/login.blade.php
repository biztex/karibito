<x-app>
<article>
	<body id="admin-login">
	<header> <div id="header">
                <div id="headerLinks">
                    <div class="inner">
                        <div class="item">
                            <h1 id="headerLogo"><a href="/"><img class="pc" src="/../img/common/logo.svg" alt="LOGO" style="min-width:93px;"><img class="sp" src="/img/common/logo_sp.svg" alt="LOGO"></a></h1>                            
                        </div>
                    </div>
                </div><!-- /.headLinks -->
               
                
              
                
                
            </div><!-- /#header -->
        </header>
		@if($errors->has('error_msg'))
			<div class="error-txt">{{ $errors->first('error_msg') }}</div>
		@endif
            {{-- {{ $error_msg}}; --}}
			
		<div id="contents" class="oneColumnPage02" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);">
			<div class="inner">
				<div id="main">
					<div class="loginWrap">
						<h2 class="subPagesHd">ログイン</h2>

						@if (session('flash_alert'))
							<div class="alert alert-danger mb05" style="z-index: 9999;">
								{{ session('flash_alert') }}
							</div>
						@endif

						
						<div class="contactBox">

							<form method="POST" action="{{ route('admin.login') }}">
            				@csrf
								<div class="labelCategory">
									<p>ID</p>
									@error('email')
										<div class="alert alert-danger">{{ $message }}</div>
                            		@enderror
									<p><input type="text" name="email" value="{{old('email')}}" required></p>
								</div>
								<div class="labelCategory">
									<p>パスワード</p>
									@error('password')
										<div class="alert alert-danger">{{ $message }}</div>
                            		@enderror
									<p><input type="password" name="password" placeholder="" required></p>
								</div>
								<ul class="loginFormBtn" >
									<li><input type="submit" class="submit" value="ログイン" style="background-color:#17A2B8;"></li>
								</ul>
							</form>
							<!-- <div class="loginBottom">
								<p class="loginBottomPswd">パスワードを変更したい方、または忘れた方は <a href="{{ route('admin.password.request') }}">こちら</a></p>
							</div> -->
						</div>
					</div>
				</div><!-- /#main -->
			</div><!--inner-->
		</div><!-- /#contents -->
	</body>
</article>
</x-app>