{{-- @extends('layouts.app') --}}
@section('title', 'プロフィール登録フォーム')

{{-- @section('content') --}}
<div class="p-home__head p-auth__head p-profile-create__head">
        <div class="container my-3">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-white">
                        <h2 class="mt-5 text-center h2 text-secondary">プロフィール登録</h2>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user_profile.store') }}" enctype="multipart/form-data" name="form1">
                                @csrf
                                <div class="fancyPersonTable">
                                    <dl class="">
                                        <dt>ニックネーム</dt>
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <dd><input type="text" name="name" class="@error('name') is-invalid @enderror" value="{{ old('name') }}"></dd>
                                    </dl>
                                    <dl class=" inlineFlex">
                                        @error('first_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <dt>姓<span>(本名は非公開です)</span></dt>
                                        <dd><input type="text" name="first_name" class="@error('first_name') is-invalid @enderror" value="{{ old('first_name') }}"></dd>
                                    </dl>
                                    <dl class=" inlineFlex">
                                        @error('last_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <dt>名<span>(本名は非公開です)</span></dt>
                                        <dd><input type="text" name="last_name" class="@error('last_name') is-invalid @enderror" value="{{ old('last_name') }}"></dd>
                                    </dl>
                                    <dl>
                                        <dt>性別</dt>
                                        @error('gender')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <dd>
                                            <select name="gender" class="@error('gender') is-invalid @enderror">
                                                <option selected="" disabled="">選択してください</option>
                                                <option value="1" @if(1 == old('gender')) selected @endif>男</option>
                                                <option value="2" @if(2 == old('gender')) selected @endif>女</option>
                                            </select>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>都道府県</dt>
                                        @error('prefecture')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <dd>
                                            <select name="prefecture" class="@error('prefecture') is-invalid @enderror">
                                                <option selected="" disabled="">選択してください</option>
                                                @foreach ( $prefectures as $prefecture )
                                                    <option value="{{$prefecture->id}}"  @if($prefecture->id == old('prefecture')) selected @endif>{{$prefecture->name}}</option>
                                                @endforeach
                                            </select>
                                        </dd>
                                    </dl>
                                </div>
                                <div class="fancyPersonBtn">
                                    <a href="#" class="fancyPersonCancel">キャンセル</a>
                                    <button class="fancyPersonSign">登録する</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>