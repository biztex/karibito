<x-admin.app>
    <div class="container my-5">
    <x-admin.flash_msg/>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb border bg-white shadow-sm">
{{--                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Home</a></li>--}}
                        <li class="breadcrumb-item active" aria-current="page">product一覧</li>
                    </ol>
                </nav>
                <div class="card shadow-sm mb-5">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center">
                        <h5 class="text-white mb-0">
                            <i class="fas fa-info mr-2"></i>product一覧
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
                                @foreach($products as $product)
                                    <tr>
                                        <td class="px-2">{{ $product->id }}</td>
                                        <td class="px-2">{{ $product->mProductChildCategory?->name }}</td>
                                        <td class="px-2"><a href="{{ route('product.show', $product->id) }}" target="_blank">{{  $product->title  }}</a></td>
                                        <td class="px-2"><a href="{{ route('user.mypage', $product->user->id) }}" target="_blank">{{ $product->user->name }}</a></td>
                                        <td class="px-2">{{ App\Models\Product::IS_ONLINE[$product->is_online] ?? "" }}</td>
                                        <td class="px-2">{{ $product->prefecture?->name }}</td>
                                        @if ($product->is_draft == 1)
                                            <td class="px-2">{{ App\Models\Product::DRAFT_STATUS[$product->is_draft] }}</td>
                                        @else
                                            <td class="px-2">{{ App\Models\Product::PUBLIC_STATUS[$product->status] }}</td>
                                        @endif
                                        <td class="px-2">{{ $product->created_at }}</td>
                                        <td class="px-2">{{ $product->updated_at }}</td>
                                    </tr>
                                @endforeach
                                {{ $products->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $products->links() }}
            </div>
        </div>
    </div>
    </div>
</x-admin.app>
