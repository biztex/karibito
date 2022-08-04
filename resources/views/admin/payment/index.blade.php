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
                        <li class="breadcrumb-item active" aria-current="page">決済一覧</li>
                    </ol>
                </nav>
                <div class="card shadow-sm mb-5">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center">
                        <h5 class="text-white mb-0">
                            <i class="fas fa-info mr-2">決済一覧</i>
                        </h5>
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive-md">
                            <thead class="text-secondary">
                                <tr>
                                    <th scope="col" class="text-nowrap">id</th>
                                    <th scope="col" class="text-nowrap">user_id</th>
                                    <th scope="col" class="text-nowrap">Payjp決済ID</th>
                                    <th scope="col" class="text-nowrap">決済金額</th>
                                    <th scope="col" class="text-nowrap">決済完了日</th>
                                    <th scope="col" class="text-nowrap">返金金額</th>
                                    <th scope="col" class="text-nowrap">返金完了日</th>
                                    <th scope="col" class="text-nowrap">返金失敗日</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $value)
                                    <tr>
                                        <td class="px-2">{!! $value->id !!}</td>
                                        <td class="px-2"><a href="{{ route('admin.users.show',$value->user_id) }}">{!! $value->user_id !!}</a></td>
                                        <td class="px-2">{!! $value->payjp_charge_id !!}</td>
                                        <td class="px-2">¥{!! number_format($value->amount) !!}</p></td>
                                        <td class="px-2">{!! $value->created_at !!}</td>
                                        <td class="px-2">@if($value->refunded_amount !== null)¥{!! number_format($value->refunded_amount) !!}@endif</td>
                                        <td class="px-2">{!! $value->refunded_at !!}</td>
                                        <td class="px-2">{!! $value->refunded_failed_at !!}</td>
                                    </tr>
                                @endforeach
                                {{ $payments->links() }}
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $payments->links() }}
            </div>
        </div>
    </div>
    </div>
</x-admin.app>
