{{--
使い方
・dataにはeloquentコレクションか配列か連想配列を指定可能
・eloquentコレクション使用時はkeyとvalueにカラム名を指定
・selectedには選択状態にしたいoptionのvalueを指定する
・defaultには未選択状態の時の表示文字を入れる。例）default="未選択"
@include('components.form.select', ['name' => 'assessment_reason', 'required' => true, 'selected' => $property->assessment_reason, 'data' => App\Models\Property::ASSESSMENT_REASONS])
--}}

<select name="{{ $name }}"
        id="{{ $name }}"
        class="form-control
            @error($name) is-invalid @enderror
            @isset($class) {{ $class }} @endisset"
        @isset ($required)
            @if ($required == true)
                required
            @endif
        @endisset
        @isset ($disabled)
            @if ($disabled == true)
                disabled
            @endif
        @endisset
    >
    <option value="">@isset($default) {{ $default }} @else 選択してください @endisset</option>
    {{-- 配列か連想配列で分岐 --}}
    @if ($data instanceof Illuminate\Database\Eloquent\Collection)
        @isset ($selected)
            @foreach($data as $model)
                <option value="{{ $model->{$key} }}"
                    @if(old($name, $selected) == $model->{$key} ) selected @endif>
                    {{ $model->{$value} }}
                </option>
            @endforeach
        @else
            @foreach($data as $model)
                <option value="{{ $model->{$key} }}"
                    @if(old($name) == $model->{$key} ) selected @endif>
                    {{ $model->{$value} }}
                </option>
            @endforeach
        @endisset
    @elseif (array_values($data) === $data)
        {{-- 配列の場合selectedにはvalueを指定 --}}
        @isset ($selected)
            @foreach($data as $v)
                <option value="{{ $v }}"
                        @if(old($name, $selected) == $v ) selected @endif>
                    {{ $v }}
                </option>
            @endforeach
        @else
            @foreach($data as $v)
                <option value="{{ $v }}"
                        @if(old($name) == $v ) selected @endif>
                    {{ $v }}
                </option>
            @endforeach
        @endisset
    @else
        @isset ($selected)
            @foreach($data as $k => $v)
                <option value="{{ $k }}"
                    @if(old($name, $selected) == $k ) selected @endif>
                    {{ $v }}
                </option>
            @endforeach
        @else
            @foreach($data as $k => $v)
                <option value="{{ $k }}"
                    @if(old($name) == $k ) selected @endif>
                    {{ $v }}
                </option>
            @endforeach
        @endisset
    @endif

</select>
