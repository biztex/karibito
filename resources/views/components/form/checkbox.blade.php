
{{-- dataの値がinputのvalueと表示文字 --}}
{{--@include('components.form.checkbox', ['name' => '', 'data' => (array)[$v]])--}}

@foreach($data as $v)
    <div class="form-check form-check-inline @error($name) is-invalid @enderror">
        <input class="form-check-input"
                type="checkbox"
                name="{{ $name }}"
                id="{{ $name . $loop->iteration }}"
                value="{{ $v }}"
                @isset($checked)
                    @if(old($name, $checked) == $v) checked @endif
                @else
                    @if(old($name) == $v) checked @endif
                @endisset
        >
        <label class="form-check-label" for="{{ $name . $loop->iteration }}">{{ $v }}</label>
    </div>
@endforeach
