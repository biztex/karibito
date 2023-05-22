<x-admin.app>
    <div class="container my-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb border bg-white shadow-sm">
{{--                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Home</a></li>--}}
                        <li class="breadcrumb-item"><a href="{{ route('admin.news.index') }}">お知らせ一覧</a></li>
                        <li class="breadcrumb-item active" aria-current="page">お知らせ詳細</li>
                    </ol>
                </nav>
                <div class="card shadow-sm mb-5">
                    <div class="card-header border-0 bg-dark">
                        <h5 class="text-white mb-0">お知らせ詳細</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-md mt-4">
                            <tbody>
                            <tr>
                                <td>投稿日</td>
                                <td>{{ $news->created_at->format('Y/m/d') }}</td>
                            </tr>
{{--                            <tr>--}}
{{--                                <td class="text-nowrap">公開状況</td>--}}
{{--                                <td class="text-nowrap">--}}
{{--                                    @if($news->is_release === 1)公開中--}}
{{--                                    @else非公開--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                            </tr>--}}
                            <tr>
                                <td class="text-nowrap">タイトル</td>
                                <td>{{ $news->title }}</td>
                            </tr>
                            <tr>
                                <td>詳細</td>
                                <td class="pre-wrap">{{ $news->content }}</td>
                            </tr>
                            <tr>
                                <td class="text-nowrap"></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-admin.app>

