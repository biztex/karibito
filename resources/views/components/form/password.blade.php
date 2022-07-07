{{-- <x-form.text name="ネーム属性" required="true" class="追加したいクラス名"/> --}}

<input type="password"
    name="{{ $name }}"
    id="{{ $name }}"
    class="form-control
            @error($name) is-invalid @enderror
            @isset($class) {{ $class }} @endisset
        "
    @if(old($name))
        value="{{ old($name) }}"
    @endif
    @isset ($required)
        @if ($required === true)
            required
        @endif
    @endisset
    @isset($placeholder)
        placeholder="{{ $placeholder }}"
    @endif
>