<x-admin.app>
<div class="container my-5">
    <x-admin.flash_msg/>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-sm mb-5">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center">
                        <h5 class="text-white mb-0">
                            子カテゴリ登録
                        </h5>
                        <div>
                            <a href="{{ route('admin.child_categories.index') }}" class="btn btn-warning btn-sm mr-3">一覧</a>
                        </div>
                    </div>
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('admin.child_categories.store') }}">
                            @csrf
                            {{-- カテゴリ名称 --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">カテゴリ名<span class="badge badge-danger ml-1">必須</span></label>
                                <div class="col-md-6">
                                    @include('components.form.text', ['name' => 'name', 'required' => true, 'value' => ''])
                                    @include('components.form.error', ['name' => 'name'])
                                </div>
                            </div>
                            {{-- 親カテゴリ --}}
                            <div class="form-group row">
                                <label for="parent_category_id" class="col-md-4 col-form-label text-md-right">親カテゴリ<span class="badge badge-danger ml-1">必須</span></label>
                                <div class="col-md-6">
                                    @include('components.form.select_default_collection', ['name' => 'parent_category_id', 'data' => $categories, 'id' => 'id', 'str' => 'name', 'value' => '', 'defaultStr' => '選択してください'])
                                    @include('components.form.error', ['name' => 'parent_category_id'])
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
