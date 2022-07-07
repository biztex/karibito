<x-admin.app>
    <div class="container my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb border bg-white shadow-sm">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">ニュース一覧</a></li>
                        <li class="breadcrumb-item active" aria-current="page">ニュース編集</li>
                    </ol>
                </nav>
                <div class="card shadow-sm mb-5">
                    <div class="card-header border-0 bg-dark text-center py-4">
                        <h5 class="text-white mb-0">
                            <i class="fa fa-user-plus mr-2"></i>ニュース編集
                        </h5>
                    </div>
                    <div class="card-body pt-5 pb-3 px-5">
                        <form method="POST" action="{{ route('admin.news.update', $news->id) }}" enctype="multipart/form-data">
                            @method("PUT")
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group row py-1">
                                <label
                                    for="is_release"
                                    class="col-md-4 col-form-label text-md-right">
                                    ステータス<span class="badge badge-danger ml-1">必須</span>
                                </label>

                                <div class="col-md-6">
                                    @include('components.form.edit_radio_k_v', ['name' => 'is_release', 'data' => [1 => '公開', 0 => '非公開'], 'value' => $news->is_release])
                                </div>
                            </div>
                            <div class="form-group row py-1">
                                <label
                                    for="title"
                                    class="col-md-4 col-form-label text-md-right">
                                    タイトル<span class="badge badge-danger ml-1">必須</span>
                                </label>

                                <div class="col-md-6">
                                    @include('components.form.edit_text', ['name' => 'title', 'value' => $news->title, 'required' => true])
                                </div>
                            </div>

                            <div class="form-group row py-1">
                                <label
                                    for="text"
                                    class="col-md-4 col-form-label text-md-right">
                                    内容<span class="badge badge-danger ml-1">必須</span>
                                </label>

                                <div class="col-md-6">
                                    @include('components.form.edit_textarea', ['name' => 'text', 'value' => $news->text, 'required' => true, 'cols' => '', 'rows' => 10])
                                </div>
                            </div>

                            <div class="form-group row py-1">
                                <label
                                    for="file1"
                                    class="col-md-4 col-form-label text-md-right"
                                >写真1</label>

                                <div class="col-md-6">
                                    <input
                                        type="file"
                                        id="path1"
                                        name="path[]"
                                        class="form-control-file"
                                    />
                                </div>
                            </div>

                            <div class="form-group row py-1">
                                <label
                                    for="file2"
                                    class="col-md-4 col-form-label text-md-right"
                                >写真2</label>

                                <div class="col-md-6">
                                    <input
                                        type="file"
                                        id="path2"
                                        name="path[]"
                                        class="form-control-file"
                                    />
                                </div>
                            </div>

                            <div class="form-group row py-1">
                                <label
                                    for="file3"
                                    class="col-md-4 col-form-label text-md-right"
                                >写真3</label>

                                <div class="col-md-6">
                                    <input
                                        type="file"
                                        id="path3"
                                        name="path[]"
                                        class="form-control-file"
                                    />
                                </div>
                            </div>

                            <div class="form-group row py-1">
                                <label
                                    for="file4"
                                    class="col-md-4 col-form-label text-md-right"
                                >写真4</label>

                                <div class="col-md-6">
                                    <input
                                        type="file"
                                        id="path4"
                                        name="path[]"
                                        class="form-control-file"
                                    />
                                </div>
                            </div>

                            <div class="form-group row py-1">
                                <label
                                    for="file5"
                                    class="col-md-4 col-form-label text-md-right"
                                >写真5</label>

                                <div class="col-md-6">
                                    <input
                                        type="file"
                                        id="path5"
                                        name="path[]"
                                        class="form-control-file"
                                    />
                                </div>
                            </div>

                            <div class="form-group text-danger small my-1 text-md-center">※JPEGまたはPNG形式のみご登録可能です。</div>

                            <div class="form-group row mt-5 mb-0">
                                <div class="col-md-6 offset-md-3 text-center">
                                    <button
                                        type="submit"
                                        class="btn btn-outline-info btn-block rounded-pill shadow-sm mb-4"
                                    >
                                        登録
                                        <i class="fa fa-check-circle ml-2"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-admin.app>

