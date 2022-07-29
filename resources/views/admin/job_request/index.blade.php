<x-admin.app>
    <div class="container my-5">
    <x-admin.flash_msg/>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb border bg-white shadow-sm">
{{--                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Home</a></li>--}}
                        <li class="breadcrumb-item active" aria-current="page">job_request一覧
                            <form action="{{ route('admin.job_request.search') }}" class="mt-2 d-flex" method="GET">
                                @csrf
                                <input class="form-control" type="text" name="search" value="{{ $request->search ?? "" }}">
                                <button class="btn btn-secondary btn-block w-25 ml-2" type="submit">検索</button>
                            </form>
                            <div class="mt-2">※商品名かユーザー名に部分一致で検索</div>
                        </li>
                    </ol>
                </nav>
                <div class="card shadow-sm mb-5">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center">
                        <h5 class="text-white mb-0">
                            job_request一覧
                        </h5>
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive-md">
                            <thead class="text-secondary">
                            <tr>
                                <th scope="col" class="text-nowrap">id</th>
                                <th scope="col" class="text-nowrap">カテゴリー名</th>
                                <th scope="col" class="text-nowrap">商品名</th>
                                <th scope="col" class="text-nowrap">ユーザー名</th>
                                <th scope="col" class="text-nowrap">仕事体系</th>
                                <th scope="col" class="text-nowrap">エリア</th>
                                <th scope="col" class="text-nowrap">ステータス</th>
                                <th scope="col" class="text-nowrap">登録日</th>
                                <th scope="col" class="text-nowrap">更新日</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($job_requests as $job_request)
                                    <tr>
                                        <td class="px-2">{{ $job_request->id }}</td>
                                        <td class="px-2">{{ $job_request->mProductChildCategory?->name }}</td>
                                        @if (($job_request->status == 2) || ($job_request->is_draft == 1))
                                            <td class="px-2">{{  $job_request->title  }}</td>
                                        @else
                                            <td class="px-2"><a href="{{ route('job_request.show', $job_request->id) }}" target="_blank">{{  $job_request->title  }}</a></td>
                                        @endif
                                        <td class="px-2"><a href="{{ route('user.mypage', $job_request->user->id) }}" target="_blank">{{ $job_request->user->name }}</a></td>
                                        <td class="px-2">{{ App\Models\Product::IS_ONLINE[$job_request->is_online] ?? "" }}</td>
                                        <td class="px-2">{{ $job_request->prefecture?->name }}</td>
                                        @if ($job_request->is_draft == 1)
                                            <td class="px-2">{{ App\Models\Product::DRAFT_STATUS[$job_request->is_draft] }}</td>
                                        @else
                                            <td class="px-2">{{ App\Models\Product::SALES_STATUS[$job_request->status] }}</td>
                                        @endif
                                        <td class="px-2">{{ $job_request->created_at }}</td>
                                        <td class="px-2">{{ $job_request->updated_at }}</td>
                                    </tr>
                                @endforeach
                                {{ $job_requests->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $job_requests->links() }}
            </div>
        </div>
    </div>
    </div>
</x-admin.app>
