<x-admin.app>
	<div id="contents" class="oneColumnPage02 w-75 align-item-center" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);">
			
		<div class="d-flex justify-content-center mb-3"><h5 class="text-dark font-weight-bold">管理者アカウント 新規作成</h5></div>
			<form method="POST" action="{{ route('admin.register') }}">
				@csrf

				<div class="form-group row">
					<label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

					<div class="col-md-6">
						<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>

						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

					<div class="col-md-6">
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>

						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="email_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Email</label>

					<div class="col-md-6">
						<input id="email_confirmation" type="email" class="form-control @error('email_confirmation') is-invalid @enderror" name="email_confirmation" value="{{ old('email_confirmation') }}" required>

						@error('email_confirmation')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

					<div class="col-md-6">
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>

						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>
				<div class="form-group row">
					<label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

					<div class="col-md-6">
						<input id="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required>

						@error('password_confirmation')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				<div class="form-group row mb-0">
					<div class="col-md-8 offset-md-4 me-0">
						<button type="submit" class="btn btn-primary">登録</button>						
						<a type="button" class="btn btn-light" href="{{ route('admin.index') }}">戻る</a>						
					</div>
				</div>
			</form>

	</div><!-- /#contents -->
</x-admin.app>