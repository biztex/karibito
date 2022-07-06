{{--
使い方
・dataにはeloquentコレクションか配列か連想配列を指定可能
・eloquentコレクション使用時はkeyとvalueにカラム名を指定
・selectedには選択状態にしたいoptionのvalueを指定する
・defaultには未選択状態の時の表示文字を入れる。例）default="未選択"
@include('components.form.radio', ['name' => '', 'data' => (array)[$v]])-
--}}

{{-- 配列か連想配列で分岐 --}}
@if ($data instanceof Illuminate\Database\Eloquent\Collection)
    @foreach($data as $model)
        <div class="form-check form-check-inline @error($name) is-invalid @enderror">
            <input class="form-check-input"
                type="radio"
                name="{{ $name }}"
                id="{{ $name . $loop->iteration }}"
                value="{{ $model->{$key} }}"
                @isset($checked)
                    @if(old($name, $checked) == $model->{$key}) checked @elseif($loop->iteration == 1 && empty($noChecked)) checked @endif
                @else
                    @if(old($name) == $model->{$key}) checked @elseif($loop->iteration == 1 && empty($noChecked)) checked @endif
                @endisset
            >
            <label class="form-check-label" for="{{ $name . $loop->iteration }}">{{ $model->{$value} }}</label>
        </div>
    @endforeach
@elseif (array_values($data) === $data)
    {{-- 配列の場合checkedにはvalueを指定 --}}
    @foreach($data as $v)
        <div class="form-check form-check-inline @error($name) is-invalid @enderror">
            <input class="form-check-input"
                type="radio"
                name="{{ $name }}"
                id="{{ $name . $loop->iteration }}"
                value="{{ $v }}"
                @isset($checked)
                    @if(old($name, $checked) == $v) checked @elseif($loop->iteration == 1 && empty($noChecked)) checked @endif
                @else
                    @if(old($name) == $v) checked @elseif($loop->iteration == 1 && empty($noChecked)) checked @endif
                @endisset
            >
            <label class="form-check-label" for="{{ $name . $loop->iteration }}">{{ $v }}</label>
        </div>
    @endforeach
@else
    @foreach($data as $k => $v)
        <div class="form-check form-check-inline @error($name) is-invalid @enderror">
            <input class="form-check-input"
                type="radio"
                name="{{ $name }}"
                id="{{ $name . $loop->iteration }}"
                value="{{ $k }}"
                @isset($checked)
                    @if(old($name, $checked) == $k) checked @elseif($loop->iteration == 1 && empty($noChecked)) checked @endif
                @else
                    @if(old($name) == $k) checked @elseif($loop->iteration == 1 && empty($noChecked)) checked @endif
                @endisset
            >
            <label class="form-check-label" for="{{ $name . $loop->iteration }}">{{ $v }}</label>
        </div>
    @endforeach
@endif
