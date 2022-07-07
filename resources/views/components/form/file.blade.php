<input type="file"
    name="{{ $name }}"
    id="{{ $name }}"
    class="form-control-file
            @error($name) is-invalid @enderror
            @isset($class) {{ $class }} @endisset
        "
    @isset($accept)
        accept="{{ $accept }}"
    @endisset
    @isset ($required)
        @if ($required == true)
            required
        @endif
    @endisset
>