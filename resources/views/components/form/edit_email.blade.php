{{-- <x-form.text name="ネーム属性" required="true" class="追加したいクラス名"/> --}}

<input type="email"
    name="{{ $name }}"
    id="{{ $name }}"
    class="form-control
            @error($name) is-invalid @enderror
            @isset($class) {{ $class }} @endisset
        "
       value="{{ old($name, $value) }}"
    {{ $required ? 'required' : '' }}
    @isset($placeholder)
        placeholder="{{ $placeholder }}"
    @endif
>
