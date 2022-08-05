<x-admin.app>
    <div class="container my-5">
        <x-admin.flash_msg/>
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex">
                <p class="mb-0 mr-4"><span class="font-weight-bold">管理者</span>：{{ Auth::guard('admin')->user()->name }}</p>
                <p class="mb-0 mr-4"><span class="font-weight-bold">Email</span>：{{ Auth::guard('admin')->user()->email }}</p>
                <p class="mb-0 mr-4"><span class="font-weight-bold">Password</span>：<a href="{{ route('admin.password.request') }}">変更する</a></p>
            </li>
        </ul>
        <div class="d-flex">
            <x-admin.side_menu/>
        </div>
    </div>
</x-admin.app>
