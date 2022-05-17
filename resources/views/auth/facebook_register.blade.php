@extends('layouts.app')
@section('facebook', 'Facebook会員登録')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5 ">
            <div class="text-center card">
                <div class="card-header fw-bold">Facebookアカウントで会員登録</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register.facebook.store') }}">
                        @csrf

                        <input type="hidden" name="twitter_id" value="{{ old('facebook_id', session('facebookId')) }}">

                        <div class="form-group">
                            <label for="name" class="col-form-label">ニックネーム</label>

                            <div class="">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', session('name')) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="">
                                <button type="submit" class="c-button">
                                    会員登録する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
