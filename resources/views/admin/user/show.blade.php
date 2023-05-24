<x-admin.app>
    <div id="contents" class="oneColumnPage02 mt-5" style="margin-left:25%;margin-right:25%">
    <x-admin.flash_msg/>


        <div class="col-md-12">
            <div class="blog-entry ftco-animate d-md-flex fadeInUp ftco-animated">
                @if(empty($user->icon))
                    <img src="/img/mypage/no_image.jpg" class="rounded-circle" style="width: 140px;height: 140px;object-fit: cover;">
                @else
                    <img src="{{ asset('/storage/'.$user->icon) }}" class="rounded-circle" style="width: 140px;height: 140px;object-fit: cover;">
                @endif
                <div class="text text-2 pl-md-4">
                    <h6 class="mb-0">ユーザー名</h6>
                    <h3><a href="{{ route('user.mypage', $user->id) }}">{{ $user->user->name }}</a></h3>
                    <span><i class="bi bi-envelope"> Email</i>：{{ $user->user->email }}</span>
                    @if ($user->deleted_at !== null)
                        <span class="badge badge-pill badge-danger">退会済</span>
                    @endif
                    @if ($user->is_ban === 0)
                        <form action="{{ route('admin.limit.account', $user->user_id) }}" method="post">
                        <input type="submit" id="js-limit_alert" name="is_ban" value="利用を制限する" class="full btn btn-secondary mr-3">
                    @elseif ($user->is_ban === 1)
                        <form action="{{ route('admin.cancel.limit.account', $user->user_id) }}" method="post">
                        <button onclick='return confirm("利用制限を解除しますか？");' type="submit" class="full btn btn-secondary mr-3">利用制限を解除する</button>
                    @endif
                        @csrf
                        </form>
                    <div class="meta-wrap">
                        <p class="meta">
                            @if(!empty($user->identification_path))
                                <p>
                                    <a href="" class="text-dark" data-toggle="modal" data-target="#exampleModalCenter">本人確認証</a>
                                    @if($user->is_identify == 1)
                                        <span class="badge badge-pill badge-primary">承認済</span>
                                    @else
                                        <span class="badge badge-pill badge-secondary">未承認</span>
                                    @endif
                                </p>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex"><p class="mb-0 mr-4"><span class="font-weight-bold">氏名</span>：{{ $user->first_name." ".$user->last_name }}</p></li>
            <li class="list-group-item d-flex"><p class="mb-0 mr-4"><span class="font-weight-bold">Facebook id</span>：@if(isset($user->user->facebook_id)) ○ @endif</p><p class="mb-0 mr-4"><span class="font-weight-bold">Google id</span>：@if(isset($user->user->google_id)) ○ @endif</p></li>
            <li class="list-group-item d-flex"><p class="mb-0 mr-4"><span class="font-weight-bold">性別</span>：{{App\Models\UserProfile::GENDER[$user->gender] ?? ''}}</p></li>
            <li class="list-group-item d-flex"><p class="mb-0 mr-4"><span class="font-weight-bold">制限</span>：@if ($user->is_ban == App\Models\UserProfile::NOT_BAN) 制限なし @elseif ($user->is_ban == App\Models\UserProfile::IS_BAN) 制限中@endif</p><p class="mb-0 mr-4"><span class="font-weight-bold">制限した時間</span>：{{ $user->is_banned_at }}</p></li>
            <li class="list-group-item d-flex"><p class="mb-0 mr-4"><span class="font-weight-bold">生年月日</span>：{{ $user->birthday }}</p><p class="mb-0 mr-4"><span class="font-weight-bold">年齢</span>：@if(isset($user->birthday)){{ $user->now_age }}歳@else未設定@endif</p><span class="font-weight-bold">年代</span>：{{ $user->age }}</p></li>
            <li class="list-group-item d-flex"><p class="mb-0 mr-4"><span class="font-weight-bold">郵便番号</span>：〒{{ substr($user->zip, 0, 3).'-'.substr($user->zip, 3, 7) }}</p><p class="mb-0 mr-4"><span class="font-weight-bold">都道府県</span>：{{ $user->prefecture?->name }}</p></li>
            <li class="list-group-item"><span class="font-weight-bold">住所</span>：{{ $user->address }}</li>
            <li class="list-group-item"><span class="font-weight-bold">電話番号</span>：{{ $user->user->tel }}</li>
            <li class="list-group-item"><span class="font-weight-bold">自己紹介</span><br>{!! nl2br(e($user->introduction)) !!}</li>
            <li class="list-group-item"><span class="font-weight-bold">メモ</span>
                <button type="button" class="btn btn-info btn-sm" id="js-memo_btn" data-toggle="modal" data-target="#memoModalCenter{{ $user->user_id }}">
                    編集
                </button>
                <br>{!! nl2br(e($user->user->memo)) !!}
            </li>
        </ul>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="memoModalCenter{{ $user->user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.user.updateMemo', $user->user_id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">メモ編集</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                        @include('components.form.edit_textarea', ['name' => 'memo', 'value' => $user->user->memo,'required' => false, 'placeholder' => '', 'cols' => 30, 'rows' => 3])
                        @include('components.form.error', ['name' => 'memo'])
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

</x-admin.app>
<script>
    // 確認ボタンをクリックするとイベント発動
$('#js-limit_alert').click(function() {

    if (!confirm('このユーザーに制限をつけますか？制限をつけるとユーザーにメールが送信され、一部の機能が利用できなくなります。')) {
        return false;
    }
});
$(function(){
		// バリデーションエラーの際、モーダルを最初から表示する
        if (@json($errors->has('memo'))){
            $('#js-memo_btn').trigger('click');
        }
    });
</script>