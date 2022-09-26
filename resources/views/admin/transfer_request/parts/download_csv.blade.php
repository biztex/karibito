<div class="card mb-3">
    <div class="card-header border-0 bg-dark">
        <h5 class="text-white mb-0 float-left">GMOあおぞら用のCSVダウンロード</h5>
    </div>
    <div class="m-3">
        <form class="form-inline" action="{{ route('admin.transfer_request.download') }}" method="POST">
            @csrf
            <div class="form-group mr-3">
                <div class="input-group">
                    <input class="form-control" type="date" name="date_from" value="{{ old('from_date', $now_season['from']) }}" required>
                </div>
            </div>
            <div class="form-group mr-3">
                <div class="input-group"> ~ </div>
            </div>
            <div class="form-group mr-3">
                <div class="input-group">
                    <input class="form-control" type="date" name="date_to" value="{{ old('to_date', $now_season['to']) }}" required>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary">ダウンロード</button>
            </div>
        </form>
    </div>
</div>