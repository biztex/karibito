{{-- 例　@include('components.form.number', ['name' => 'ネーム属性', 'required' => true, class="追加したいクラス名"]) --}}
{{-- vModel使用時oldはVueに記述するように --}}
<input type="number"
    name="{{ $name }}"
    id="{{ $name }}"
    class="form-control
            @isset($errName)
                @error($errName) is-invalid @enderror
            @else
                @error($name) is-invalid @enderror
            @endisset
            @isset($class) {{ $class }} @endisset
        "
    @isset ($value)
        value="{{ old($name, $value) }}"
    @else
        value="{{ old($name) }}"
    @endisset
    @isset ($required)
        @if ($required == true)
            required
        @endif
    @endisset
    @isset ($vModel)
        v-model="{{ $vModel }}"
    @endif
    @isset ($vModelNumber)
        v-model.number="{{ $vModelNumber }}"
    @endif
    @isset ($min)
        min="{{ $min }}"
    @endif
    @isset ($max)
        max="{{ $max }}"
    @endif
    @isset ($disabled)
        disabled
    @endif
>
