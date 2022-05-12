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
                            <form method="POST" action="{{ route('createUser') }}" enctype="multipart/form-data" name="form1">
                                @csrf
                                <div class="fancyPersonTable">
                                    <dl class="">
                                        <dt>ニックネーム</dt>
                                        <dd><input type="text" name="name"></dd>
                                    </dl>
                                    <dl class=" inlineFlex">
                                        <dt>姓<span>(本名は非公開です)</span></dt>
                                        <dd><input type="text" name="first_name"></dd>
                                    </dl>
                                    <dl class=" inlineFlex">
                                        <dt>名<span>(本名は非公開です)</span></dt>
                                        <dd><input type="text" name="last_name"></dd>
                                    </dl>
                                    <dl>
                                        <dt>性別</dt>
                                        <dd>
                                            <select name="gender">
                                                <option selected="" disabled="">選択してください</option>
                                                <option value="1">男</option>
                                                <option value="2">女</option>
                                            </select>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>都道府県</dt>
                                        <dd>
                                            <select name="prefecture">
                                                <option selected="" disabled="">選択してください</option>
                                                @foreach ( $prefectures as $prefecture )
                                                    <option value="{{$prefecture->id}}">{{$prefecture->name}}</option>
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