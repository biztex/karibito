{{-- vModel使用時oldはVueに記述するように --}}
<textarea
    name="{{ $name }}"
    @isset($id)
        id="{{ $id }}"
    @else
        id="{{ $name }}"
    @endisset
    class="form-control
            @error($name) is-invalid @enderror
            @isset($class) {{ $class }} @endisset
        "
    @isset ($required)
        @if ($required === true)
            required
        @endif
    @endisset
    @isset ($placeholder)
        placeholder="{!! $placeholder !!}"
    @endif
    @isset ($vModel)
        v-model="{{ $vModel }}"
    @endif
    cols="{{ isset($cols) ? $cols : 30 }}"
    rows="{{ isset($rows) ? $rows : 5 }}"
>@isset ($value)
{{ old($name, $value) }}
@else
{{ old($name) }}
@endisset
</textarea>