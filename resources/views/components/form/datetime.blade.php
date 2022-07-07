<input type="datetime-local"
   name="{{ $name }}"
    id="{{ $name }}"
    class="form-control
            form-control-date
            @error($name) is-invalid @enderror
            @isset($class) {{ $class }} @endisset
        "
    @isset ($value)
        value="{{ old($name, $value) }}"
    @else
        value="{{ old($name) }}"
    @endisset
    @isset ($required)
        @if ($required === true)
            required
        @endif
    @endisset
    @isset ($placeholder)
        placeholder="{{ $placeholder }}"
    @endif
>
