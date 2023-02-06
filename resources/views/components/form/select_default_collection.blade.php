{{-- dataにコレクションを設定する --}}
{{--@include('components.form.select_default_collection', ['name' => '', 'data' => (collection), 'id' => 'id', 'str' => '', 'value' => '', 'defaultStr' => ''])--}}
{{--アドバイス：'id'と'str'にはそれぞれテーブルのカラム名を指定してください--}}
{{--アドバイス：'selected'には選択--}}

@php
    // コレクションを配列に設定する($idはkeyへ、$strはvalへ設定)
    $arr = $data->mapWithKeys(function ($item) use ($id, $str) {
        return [$item[$id] => $item[$str]];
    });

    // 選択するセレクトボックスの番号
    if(!isset($value)) { // 引数で指定がないときは1つ目のアイテムを選択する
        $value = 1;
    }
@endphp

<select name="{{ $name }}"
        id="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror">

    <option value="">{{ $defaultStr }}</option>
    @foreach($arr as $k => $v)
        <option value="{{ $k }}"
                @if(old($name, $value) == $k) selected @endif>
            {{ $v }}
        </option>
    @endforeach

</select>
