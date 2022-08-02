<x-admin.app>
    <div class="container my-5">
    <x-admin.flash_msg/>
    <div class="container">
        <div class="row justify-content-center">

            <x-admin.side_menu/>
            <div class="col-md-10 ml-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb border bg-white shadow-sm">
{{--                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Home</a></li>--}}
                        <li class="breadcrumb-item active" aria-current="page">ニュース一覧</li>
                    </ol>
                </nav>
                <div class="card shadow-sm mb-5">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center">
                        <h5 class="text-white mb-0">
                            <i class="fas fa-info mr-2"></i>ニュース一覧
                        </h5>
                        <a class="btn btn-primary" href="{{ route('admin.news.create') }}">登録</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive-md">
                            <thead class="text-secondary">
                            <tr>
                                <th scope="col" class="text-nowrap">投稿日</th>
                                <th scope="col" class="text-nowrap">重要なお知らせ</th>
                                <th scope="col" class="text-nowrap">タイトル</th>
{{--                                <th scope="col" class="text-nowrap">詳細</th>--}}
                                <th scope="col" class="text-nowrap">編集</th>
                                <th scope="col" class="text-nowrap">削除</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($news_list as $news)
                                    <tr>
                                        <td class="text-nowrap px-2">{{ $news->created_at->format('Y/m/d') }}</td>
                                        <td class="text-nowrap px-2">
                                            @if($news->is_important === 1)
                                                <p class="">◯</p>
                                            @endif
                                        </td>
                                        <td class="text-nowrap px-2">
                                            <a href="{{ route('admin.news.show', $news->id) }}">{{ $news->title }}</a>
                                        </td>
    {{--                                    <td class="text-nowrap px-2">--}}
    {{--                                        <a class="btn btn-primary" href="">詳細</a>--}}
    {{--                                    </td>--}}
                                        <td class="text-nowrap px-2">
                                            <a class="btn btn-primary" href="{{ route('admin.news.edit', $news->id) }}">編集</a>
                                        </td>
                                        <td class="text-nowrap px-2">
                                            <form action="{{ route('admin.news.destroy',$news->id ) }}" method="post" class="d-inline">
                                                @csrf @method('delete')
                                                <button class="btn btn-outline-danger" onclick='return confirm("削除しますか？");'>削除</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $news_list->links() }}
            </div>
        </div>
    </div>
    </div>
</x-admin.app>

