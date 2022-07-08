{{--@include('components.form.edit_text', ['name' => '', 'value' => '', 'required' => false])--}}

<input type="text"
       name="{{ $name }}"
       id="{{ $name }}"
       class="form-control @error($name) is-invalid @enderror"
       value="{{ old($name, $value) }}"
    {{ $required ? 'required' : '' }}>
