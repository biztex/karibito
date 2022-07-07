{{-- インプットdateをボタンで増やせるフォーム --}}
{{--@include('components.form.date_increment', ['name' => ''])--}}
{{--
条件：
・追加ボタンのアイコンはFontAwesomeを使っています。
　プロジェクトごとに好きなアイコンに修正してください。
・追加ボタンと削除ボタンの処理は別途JSを記述してください。
　下記のスクリプトを適当なJSに記述すればそのまま使用もできます。
　(下記のスクリプトを使う場合はJqueryを読み込んでください。)
-----------------------------------------------------------------------------------------------------------
// セレクトボックスの追加・削除(商品ジャンルの追加・削除)
$(document).on('click', '.add', function() {
    $(this).closest('.select_increment').clone(true).insertAfter($(this).closest('.select_increment'));
});
$(document).on("click", ".del", function() {
    let target = $('.select_increment');
    if (target.length > 1) {
         $(this).closest('.select_increment').remove();
    }
});
-----------------------------------------------------------------------------------------------------------
--}}

@if(old($name))
    @for($index = 0; $index < count(old($name)); $index++)
        <div class="form-group row py-1  select_increment">
            <label for="end_date" class="col-md-4 col-form-label text-md-right">
            </label>

            <div class="col-md-6">
                <div class="d-flex justify-content-between">
                    <input type="date"
                           name="{{ $name . '[]' }}"
                           id="{{ $name . $index }}"
                           class="form-control @error($name . '.' . $index) is-invalid @enderror"
                           value="{{ old($name . '.' . $index) }}"
                    >
                    <button type="button" class="btn btn-outline-secondary m-1 btn-sm add">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" class="btn btn-outline-secondary m-1 btn-sm del">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>

{{--        <div class="text-danger">{{ $errors->first($name . '.' .$index) }}</div>--}}
    @endfor
@else

    <div class="form-group row py-1  select_increment">
        <label for="end_date" class="col-md-4 col-form-label text-md-right">
        </label>

        <div class="col-md-6">
            <div class="d-flex justify-content-between">
                <input type="date"
                       name="{{ $name . '[]' }}"
                       id="{{ $name }}"
                       class="form-control @error($name) is-invalid @enderror"
                       value="{{ old($name) }}"
                >
                <button type="button" class="btn btn-outline-secondary m-1 btn-sm add">
                    <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary m-1 btn-sm del">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
    </div>
@endif
