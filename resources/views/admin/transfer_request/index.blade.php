<x-admin.app>
    <div class="container my-5">
    <x-admin.flash_msg/>
    <div class="container">
        <div class="row justify-content-center">
            <x-admin.side_menu/>
            <div class="col-md-10">

                {{-- GMOあおぞら用のCSVダウンロード --}}
                @include('admin.transfer_request.parts.download_csv')
                

                <div class="card shadow-sm mb-5">
                    <div class="card-header border-0 bg-dark d-flex justify-content-between align-items-center">
                        <h5 class="text-white mb-0">
                            <i class="fas fa-info mr-2">振込申請情報：全{{ $transfer_requests->total() }}件</i>
                            <i class="fas fa-info mr-2 count"></i>
                        </h5>
                        <a href="{{ route('admin.transfer_request.season', $prev_season['num']) }}" class="btn btn-outline-secondary"><< {{$prev_season['string']}}</a>
                        <a href="{{ route('admin.transfer_request.season', $next_season['num']) }}" class="btn btn-outline-secondary">{{$next_season['string']}} >></a>
                    </div>

                    <form method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="mb-2">
                                <p class="mb-0" style="font-size:10px;">※チェックしてステータスを変更</p>
                                <input type="submit" class="btn btn-outline-dark btn-sm" formaction="{{ route('admin.transfer_request.complete') }}" value="振込完了">
                                <input type="submit" class="btn btn-outline-danger btn-sm" formaction="{{ route('admin.transfer_request.fail') }}" value="振込失敗">
                                <input type="submit" class="btn btn-outline-dark btn-sm" formaction="{{ route('admin.transfer_request.back') }}" value="申請中に戻す">
                            </div>
                            <table class="table table-responsive-md">
                                <thead class="text-secondary">
                                    <tr>
                                        <th scope="col" class="text-nowrap">
                                            <div class="form-check form-check-inline" id="boxes">
                                                <input class="form-check-input" type="checkbox" id="CheckAll" value="checkall">
                                            </div>
                                        </th>
                                        <th scope="col" class="text-nowrap">id</th>
                                        <th scope="col" class="text-nowrap">user_id</th>
                                        <th scope="col" class="text-nowrap">ユーザー名</th>
                                        <th scope="col" class="text-nowrap">振込金額</th>
                                        <th scope="col" class="text-nowrap">振込申請日</th>
                                        <th scope="col" class="text-nowrap">振込状況</th>
                                        <th scope="col" class="text-nowrap">完了日/失敗日</th>
                                    </tr>
                                </thead>
                                <tbody id="check_requests">
                                    @foreach($transfer_requests as $value)
                                        <tr>
                                            <td class="px-2">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" name="transfer_request[]" type="checkbox" id="CheckAllValue" value="{{ $value->id }}">
                                                </div>
                                            </td>
                                            <td class="px-2">{!! $value->id !!}</td>
                                            <td class="px-2"><a href="{{ route('admin.users.show',$value->user_id) }}">{!! $value->user_id !!}</a></td>
                                            <td class="px-2"><a href="{{ route('admin.users.show',$value->user_id) }}">{!! $value->user->name !!}</a></td>
                                            <td class="px-2">¥{!! number_format($value->amount) !!}</p></td>
                                            <td class="px-2" style="max-width:35px">{!! $value->requested_at !!}</td>
                                            <td class="px-2" style="max-width:35px">{!! App\Models\TransferRequest::STATUS[$value->status] !!}</td>
                                            @if($value->completed_at !== null)
                                                <td class="px-2" style="max-width:35px">{!! $value->completed_at !!}</td>
                                            @else
                                                <td class="px-2" style="max-width:35px">{!! $value->failed_at !!}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    {{ $transfer_requests->links() }}
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                {{ $transfer_requests->links() }}
            </div>
        </div>
    </div>
    </div>
</x-admin.app>
<script>
    $(function() {
    // 「全選択」する
    $('#CheckAll').on('click', function() {
      $("input[name='transfer_request[]']").prop('checked', this.checked);
    });

    // 「全選択」以外のチェックボックスがクリックされたら、
    $("input[name='transfer_request[]']").on('click', function() {
      if ($('#boxes :checked').length == $('#boxes :input').length) {
        // 全てのチェックボックスにチェックが入っていたら、「全選択」 = checked
        $('#CheckAll').prop('checked', true);
      } else {
        // 1つでもチェックが入っていたら、「全選択」 = checked
        $('#CheckAll').prop('checked', false);
      }
    });
  });

  $(function() {
    $('input:checkbox').change(function() {
        var count = $('#check_requests input:checkbox:checked').length;
        $('i.count').text('選択中：' + count + '件');
    }).trigger('change');
});
</script>