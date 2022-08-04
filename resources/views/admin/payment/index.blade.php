<x-admin.app>
    <div class="container my-5">
    <x-admin.flash_msg/>
    <div class="container">
        <div class="row justify-content-center">
            <x-admin.side_menu/>
            <div class="col-md-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb border bg-white shadow-sm">
{{--                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Home</a></li>--}}
                        <li class="breadcrumb-item active" aria-current="page">アンケート一覧</li>
                    </ol>
                </nav>
                <div class="card shadow-sm mb-5">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center">
                        <h5 class="text-white mb-0">
                            <i class="fas fa-info mr-2">アンケート一覧</i>
                        </h5>
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive-md">
                            <thead class="text-secondary">
                            <tr>
                                <th scope="col" class="text-nowrap">id</th>
                                <th scope="col" class="text-nowrap">user_id</th>
                                <th scope="col" class="text-nowrap">評価</th>
                                <th scope="col" class="text-nowrap">入力内容</th>
                                <th scope="col" class="text-nowrap">登録日</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($karibito_survey as $value)
                                    <tr>
                                        <td class="px-2">{!! $value->id !!}</td>
                                        <td class="px-2">{!! $value->user_id !!}</td>
                                        <td class="px-2">{!! $value->star !!}</td>
                                        <td class="px-2" style="max-width:500px;">{!! $value->comment !!}</p></td>
                                        <td class="px-2">{!! $value->created_at !!}</td>
                                    </tr>
                                @endforeach
                                {{ $karibito_survey->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $karibito_survey->links() }}
            </div>
        </div>
    </div>
    </div>
</x-admin.app>
