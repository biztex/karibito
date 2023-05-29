<x-admin.app>
    <div class="container my-5">
    <x-admin.flash_msg/>
    <div class="container">
        <div class="row justify-content-center">
            <x-admin.side_menu/>
            <div class="col-md-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb border bg-white shadow-sm">
                        <li class="breadcrumb-item active" aria-current="page">子カテゴリー一覧
                            <form action="{{ route('admin.child_category.search') }}" class="mt-2" method="get">
                                @csrf
                                <div class="d-flex mb-3">
                                    <input class="form-control col-12" type="text" name="search" value="{{ $request->search ?? "" }}">
                                    <button class="btn btn-secondary col-4 ml-2" type="submit">検索</button>
                                </div>
                            </form>
                            <div>※子カテゴリー名に部分一致で検索</div>
                        </li>
                    </ol>
                </nav>
                <div class="card shadow-sm mb-5">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center">
                        <h5 class="text-white mb-0">
                            子カテゴリ一覧
                        </h5>
                        <div>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-warning btn-sm mr-3">親カテゴリ一覧</a>
                            <a href="{{ route('admin.child_categories.create') }}" class="btn btn-primary btn-sm mr-3">登録</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md">
                            <thead class="text-secondary">
                            <tr>
                                <th scope="col" class="text-nowrap">id</th>
                                <th scope="col" class="text-nowrap">子カテゴリー名</th>
                                <th scope="col" class="text-nowrap">親カテゴリー名</th>
                                <th scope="col" class="text-nowrap">登録日</th>
                                <th scope="col" class="text-nowrap">更新日</th>
                                <th scope="col" class="text-nowrap">編集</th>
                                <th scope="col" class="text-nowrap">削除</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if ($child_categories->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">一致するカテゴリーがありません</td>
                                    </tr>
                                @else
                                    @foreach($child_categories as $child_category)
                                        <tr>
                                            <td class="px-2">{{ $child_category->id }}</td>
                                            <td class="px-2">{{ $child_category->name }}</td>
                                            <td class="px-2">{{ $child_category->mProductCategory->name }}</td>
                                            <td class="px-2">{{ $child_category->created_at }}</td>
                                            <td class="px-2">{{ $child_category->updated_at }}</td>
                                            <td class="px-2">
                                                {{-- @if (App\Models\JobRequest::where('category_id', $child_category->id)->get()->isEmpty() todo:確認環境ではすべてのサービスを編集できるようにする。本番でもどす
                                                    && App\Models\Product::where('category_id', $child_category->id)->get()->isEmpty()) --}}
                                                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.child_categories.edit', $child_category->id) }}">編集</a>
                                                {{-- @endif --}}
                                            </td>
                                            <td class="px-2">
                                                @if (App\Models\JobRequest::where('category_id', $child_category->id)->get()->isEmpty()
                                                    && App\Models\Product::where('category_id', $child_category->id)->get()->isEmpty())
                                                    <form action="{{ route('admin.child_categories.destroy', $child_category->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('本当に削除しますか？')"
                                                        >削除</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{ $child_categories->links() }}
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-admin.app>
