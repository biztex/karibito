{{-- @extends('layouts.app') --}}
@section('title', 'プロフィール登録完了画面')

{{-- @section('content') --}}
<div class="p-home__head p-auth__head p-profile-create__head">
    <div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-white">
                        <h2 class="mt-5 text-center h2 text-secondary">プロフィール登録完了</h2>
                        <p>{{ $user_name }}様登録ありがとうございます</p>
                        <a href="/mypage">My Page</a>
                </div>
            </div>
        </div>
    </div>
</div>