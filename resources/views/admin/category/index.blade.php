<x-admin.app>
    <div class="container my-5">
    <x-admin.flash_msg/>
    <div class="container">
        <div class="row justify-content-center">
            <x-admin.side_menu/>
            <div class="col-md-10">
                <div class="card shadow-sm mb-5">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center">
                        <h5 class="text-white mb-0">
                            親カテゴリ一覧
                        </h5>
                        <div>
                            <a href="{{ route('admin.child_categories.index') }}" class="btn btn-warning btn-sm mr-3">子カテゴリ一覧</a>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm mr-3">登録</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md">
                            <thead class="text-secondary">
                            <tr>
                                <th scope="col" class="text-nowrap">id</th>
                                <th scope="col" class="text-nowrap">カテゴリー名</th>
                                <th scope="col" class="text-nowrap">登録日</th>
                                <th scope="col" class="text-nowrap">更新日</th>
                                <th scope="col" class="text-nowrap">編集</th>
                                <th scope="col" class="text-nowrap">削除</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td class="px-2">{{ $category->id }}</td>
                                        <td class="px-2">{{ $category->name }}</td>
                                        <td class="px-2">{{ $category->created_at }}</td>
                                        <td class="px-2">{{ $category->updated_at }}</td>
                                        <td class="px-2"><a class="btn btn-sm btn-outline-primary" href="{{ route('admin.categories.edit', $category->id) }}">編集</a></td>
                                        <td class="px-2">
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('本当に削除しますか？')"
                                                >削除</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                {{ $categories->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-admin.app>
