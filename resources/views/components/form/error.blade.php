{{--@include('components.form.error', ['name' => ''])--}}

@error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror