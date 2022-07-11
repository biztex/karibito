{{--@include('components.form.edit_textarea', ['name' => '', 'value' => '','required' => false, 'cols' => 30, 'rows' => 5])--}}

<textarea name="{{ $name }}"
          id="{{ $name }}"
          class="form-control @error($name) is-invalid @enderror"
          cols="{{ $cols }}"
          rows="{{ $rows }}"
          {{ $required ? 'required' : '' }}>{{ old($name, $value) }}
</textarea>
