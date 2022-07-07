{{-- selectボックスをボタンで増やせるフォームで、dataにCONSTを設定する --}}
{{--@include('components.form.select_increment_const', ['name' => '', 'data' => (const), 'id' => 'id', 'str' => ''])--}}
{{--アドバイス：'id'と'str'にはそれぞれテーブルのカラム名を指定してください--}}
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


@php

    $arr = $data;
@endphp

@if(old($name))
    @for($index = 0; $index < count(old($name)); $index++)
        <div class="d-flex my-1 select_increment">
            <select name="{{ $name . '[]' }}" id="{{ $name . $index }}" class="form-control @error($name . '.' . $index) is-invalid @enderror">
                @foreach($arr as $k => $v)
                    <option value="{{ $k }}"
                            @if(old($name . '.' . $index) == $k ) selected @endif>
                        {{ $v }}
                    </option>
                @endforeach
            </select>
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary m-1 btn-sm add">
                    <i class="fas fa-plus"></i>
                </button>
                <button type="button" class="btn btn-outline-secondary m-1 btn-sm del">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="text-danger">{{ $errors->first($name . '.' .$index) }}</div>
    @endfor
@else
    <div class="d-flex my-1 select_increment">
        <select name="{{ $name . '[]' }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror">
            @foreach($arr as $k => $v)
                <option value="{{ $k }}">
                    {{ $v }}
                </option>
            @endforeach
        </select>
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-outline-secondary m-1 btn-sm add">
                <i class="fas fa-plus"></i>
            </button>
            <button type="button" class="btn btn-outline-secondary m-1 btn-sm del">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
@endif
