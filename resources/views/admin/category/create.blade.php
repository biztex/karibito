<x-admin.app>
<div class="container my-5">
    <x-admin.flash_msg/>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm mb-5">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center">
                        <h5 class="text-white mb-0">
                            親カテゴリ登録
                        </h5>
                        <div>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-warning btn-sm mr-3">一覧</a>
                        </div>
                    </div>
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                            @csrf
                            {{-- カテゴリ名称 --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">カテゴリ名<span class="badge badge-danger ml-1">必須</span></label>
                                <div class="col-md-6">
                                    @include('components.form.text', ['name' => 'name', 'required' => true, 'value' => ''])
                                    @include('components.form.error', ['name' => 'name'])
                                </div>
                            </div>
                            {{-- カテゴリ説明 --}}
                            <div class="form-group row">
                                <label for="content" class="col-md-4 col-form-label text-md-right">説明</label>
                                <div class="col-md-6">
                                    @include('components.form.text', ['name' => 'content', 'required' => false, 'value' => ''])
                                    @include('components.form.error', ['name' => 'content'])
                                </div>
                            </div>
                            {{-- バナー画像 --}}
                            <div class="form-group row">
                                <label for="banner_image_path" class="col-md-4 col-form-label text-md-right">バナー画像</label>
                                <div class="col-md-6">
                                    @include('components.form.file', ['name' => 'banner_image_path', 'required' => false])
                                    @include('components.form.error', ['name' => 'banner_image_path'])
                                </div>
                            </div>
                            {{-- トップページおすすめカテゴリアイコン画像 --}}
                            <div class="form-group row">
                                <label for="top_image_path" class="col-md-4 col-form-label text-md-right">おすすめカテゴリアイコン</label>
                                <div class="col-md-6">
                                    @include('components.form.file', ['name' => 'top_image_path', 'required' => false])
                                    @include('components.form.error', ['name' => 'top_image_path'])
                                </div>
                            </div>
                            {{-- その他サービスから探すアイコン画像 --}}
                            <div class="form-group row">
                                <label for="other_image_path" class="col-md-4 col-form-label text-md-right">サービスアイコン</label>
                                <div class="col-md-6">
                                    @include('components.form.file', ['name' => 'other_image_path', 'required' => false])
                                    @include('components.form.error', ['name' => 'other_image_path'])
                                </div>
                            </div>
                            <div class="form-group row justify-content-md-center mt-5">
                                <div class="col-md-6 offset-md-4 text-center text-md-left ">
                                    <button type="submit" class="btn btn-success">
                                        登録
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
