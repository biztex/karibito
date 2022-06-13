<x-admin.app>
    <div class="container my-5">

    <x-admin.flash_msg/>
       
    <table class="table table-sm table-hover">
        <thead>
            <tr>
            <th scope="col">user_id</th>
            <th scope="col">Name</th>
            <th scope="col">本人確認</th>
            <th scope="col">身分証明証</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user) 
                <tr>
                <a href="{{ route('admin.users.show',$user->user_id) }}"><th scope="row">{{ $user->user_id }}</th></a>
                <td>{{ $user->first_name.' '.$user->last_name }}</td>
                <td>{{ App\Models\UserProfile::IDENTIFY[$user->is_identify] }}</td>

                @if(is_null($user->identification_path))
                    <td><button type="button" class="btn btn-sm" disabled>-</button></td>
                @elseif($user->is_identify == 0)
                    <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter{{ $user->user_id }}">身分証明証</button></td>
                @else
                    <td><button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModalCenter{{ $user->user_id }}">身分証明証</button></td>
                @endif

                <td><a href="{{ route('admin.users.show',$user->user_id) }}" class="btn btn-outline-primary btn-sm" >詳細</a></td>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter{{ $user->user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">{{ $user->first_name.' '.$user->last_name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @if(empty($user->zip))
                                    <p class="m-0">郵便番号が登録されていません。</p>
                                @else
                                    <p class="m-0">〒 {{ substr($user->zip, 0, 3).'-'.substr($user->zip, 3, 7) }}</p>
                                @endif

                                @if(empty($user->address))
                                    <p class="m-0">住所が登録されていません。</p>
                                @else
                                    <p class="m-0">{{ $user->address }}</p>
                                @endif

                            <hr>
                                @if(!is_null($user->identification_path))
                                    <img src="{{asset('/storage/'.$user->identification_path ) }}" alt="" style="width:100%;heigh:auto">
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                @if($user->is_identify == 0)
                                    <form action="{{ route('admin.approve', $user->user_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-sm">承認する</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.revokeApproval', $user->user_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-light btn-sm">承認取消</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                </tr>
            @endforeach
            {{ $users->links() }} 
        </tbody>
    </table>
    {{ $users->links() }} 

    </div>
</x-admin.app>