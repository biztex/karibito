<x-admin.app>
    <div class="container my-5">
    <x-admin.flash_msg/>
    <div class="container">
        <div class="row justify-content-center">
            <x-admin.side_menu/>
            <div class="col-md-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb border bg-white shadow-sm">
                        <li class="breadcrumb-item active" aria-current="page">手数料変更画面</li>
                    </ol>
                </nav>
                <div class="card shadow-sm mb-5">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center">
                        <h5 class="text-white mb-0">
                            <i class="fas fa-info mr-2"></i>手数料変更画面
                        </h5>
                    </div>

                    <div class="card-body">
                        <table class="table table-responsive-md">
                            <thead class="text-secondary">
                            <tr>
                                <th scope="col" class="text-nowrap">手数料</th>
                                <th scope="col" class="text-nowrap">適用日</th>
                                <th scope="col" class="text-nowrap">変更</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('admin.m_commission_rates.store') }}" method="post">
                                        @csrf
                                        <td class="text-nowrap px-2">
                                            <label for="rate">現在の手数料:</label>
                                            <input type="int" name="rate" value="{{ $m_commission_rate->rate }}"></td>
                                        <td class="text-nowrap px-2">{{ $m_commission_rate->effective_datetime }}</td>
                                        <td class="text-nowrap px-2">
                                        <button class="btn btn-primary" onclick='return confirm("手数料を変更しますか？");'>変更</button>
                                    </form>
                                    </td>
                                </tr>
                                @foreach ($rate_list as $rate)
                                    <tr>
                                        @if ($rate == $m_commission_rate)
                                            @continue
                                        @else
                                            <td class="text-nowrap px-2">{{ $rate->rate }}</td>
                                            <td class="text-nowrap px-2">{{ $rate->effective_datetime }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-admin.app>

