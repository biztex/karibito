<div class="d-xl-block d-none mr-2">
    <ul class="list-group">
        <li class="list-group-item"><p class="m-0"><a href="{{ route('admin.users.index') }}" class="text-secondary">user list</a></p></li>
        <li class="list-group-item"><p class="m-0"><a href="{{ route('admin.products.index') }}" class="text-secondary">product list</a></p></li>
        <li class="list-group-item"><p class="m-0"><a href="{{ route('admin.job_requests.index') }}" class="text-secondary">job_request list</a></p></li>
        <li class="list-group-item"><p class="m-0"><a href="{{ route('admin.m_commission_rates.index') }}" class="text-secondary">手数料</a></p></li>
        <li class="list-group-item"><p class="m-0"><a href="{{ route('admin.survey.index') }}" class="text-secondary">アンケート</a></p></li>
        <li class="list-group-item"><p class="m-0"><a href="{{ route('admin.payment.index') }}" class="text-secondary">決済</a></p></li>
        <!-- @if(Auth::guard('admin')->user()->role == 1)
            <li class="list-group-item"><p class="m-0"><a href="{{ route('admin.index') }}" class="text-secondary">admin list</a></p></li>
        @endif
        <li class="list-group-item">###</li>
        <li class="list-group-item">###</li>
        <li class="list-group-item">###</li> -->
    </ul>
</div>
