<x-admin.app>
    <div class="container my-5">

    <x-admin.flash_msg/>
<div class="d-flex">

    <x-admin.side_menu/>
    <div class="row col-10 ml-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb border bg-white shadow-sm">
            {{-- <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Home</a></li>--}}
                <li class="breadcrumb-item active" aria-current="page">ユーザー一覧
                    <form action="{{ route('admin.user.search') }}" class="mt-2" method="get">
                        @csrf
                        <div class="d-flex">
                            <input class="form-control col-4" type="text" name="search" value="{{ $request->search ?? "" }}">
                            <button class="btn btn-secondary btn-block col-2 ml-2 content-end" type="submit">検索</button>
                        </div>
                        <div class="mt-2 ml-2">
                            <label for="is_approve">未承認：</label>
                            <input type="checkbox" id="is_approve" name="is_approve" value="1" {{ $request->is_approve ?? "" == 1 ? 'checked' : "" }}>
                            <label for="is_ban">制限：</label>
                            <input type="checkbox" id="is_ban" name="is_ban" value="1" {{ $request->is_ban ?? "" == 1 ? 'checked' : "" }}>
                        </div>
                    </form>
                    <div>※ユーザー名に部分一致で検索 / チェックを付けて検索で未承認のみ表示</div>
                </li>
            </ol>
            {{ $users->links() }}
        </nav>

        <table class="table table-sm table-hover mt-2">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">ニックネーム</th>
                <th scope="col">氏名(姓 名)</th>
                <th scope="col">本人確認</th>
                <th scope="col">身分証明証</th>
                <th scope="col">制限</th>
                <th scope="col">メモ</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <a href="{{ route('admin.users.show',$user->user_id) }}"><th scope="row" class="@if ($user->deleted_at) text-danger @endif">{{ $user->user_id }}</th></a>
                        <td>{{ $user->user->name }}</td>
                        <td>{{ $user->first_name.' '.$user->last_name }}</td>
                        <td @if ($user->is_identify == 2) style="color: red;" @endif>{{ App\Models\UserProfile::IDENTIFY[$user->is_identify] }}</td>
                        @if(is_null($user->identification_path))
                            <td><button type="button" class="btn btn-sm" disabled>-</button></td>
                        @elseif($user->is_identify == 0)
                            <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalCenter{{ $user->user_id }}">身分証明証</button></td>
                        @else
                            <td><button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModalCenter{{ $user->user_id }}">身分証明証</button></td>
                        @endif
                        <td>{{ App\Models\UserProfile::BAN[$user->is_ban] }}</td>
                        <td class="text-wrap px-2" style="max-width: 100px">{{mb_substr($user->user->memo, 0, 50)}}
                        <!-- Button trigger modal -->

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
                                            <form action="{{ route('admin.revokeApproval', $user->user_id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-light btn-sm">承認しない</button>
                                            </form>
                                        @elseif ($user->is_identify == 2)
                                            <span>承認を拒否しました。拒否した画像が表示されています。</span>
                                        @else
                                            <form action="{{ route('admin.revokeApproval', $user->user_id) }}" method="POST">
                                                @csrf
                                                <button onclick='return confirm("本人確認の承認を取り消しますか？");' type="submit" class="btn btn-light btn-sm">承認取消</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
</x-admin.app>
