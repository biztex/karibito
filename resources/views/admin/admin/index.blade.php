<x-admin.app>
    <div class="container my-5">

    <x-admin.flash_msg/>
        <div class="d-flex justify-content-end">
            @if(Auth::guard('admin')->user()->role == 1) 
                <a href="{{ route('admin.register') }}">管理者追加</a>
            @endif
        </div>
    <table class="table table-sm table-hover">
        <thead>
            <tr>
            <th scope="col">管理者ID</th>
            <th scope="col">管理者</th>
            <th scope="col">email</th>
            @if(Auth::guard('admin')->user()->role == 1)           
                <th scope="col">権限</th>
                <th scope="col">編集</th>
                <th scope="col">削除</th>
            @endif
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $val) 
                <tr>
                <th scope="row">{{ $val->id }}</th>
                <td>{{ $val->name }}</td>
                <td>{{ $val->email }}</td>  
                    <!-- <td>{{ $val->role }}</td>
                    <td>編集</td>
                    <td>削除</td>          -->
                </tr>
            @endforeach
        </tbody>
    </table>

    </div>
</x-admin.app>