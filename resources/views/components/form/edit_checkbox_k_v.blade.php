{{-- dataの「キー:inputのvalue」「値:表示文字」 --}}
{{--@include('components.form.edit_checkbox_k_v', ['name' => '', 'data' => (array)[$k=>$v], 'value' => ''])--}}

@foreach($data as $k => $v)
    <div class="form-check form-check-inline @error($name) is-invalid @enderror">
        <input class="form-check-input" type="checkbox" name="{{ $name }}" id="{{ $name . $loop->iteration }}"
               value="{{ $k }}" @if(old($name, $value) == $k) checked @endif>
        <label class="form-check-label" for="{{ $name . $loop->iteration }}">{{ $v }}</label>
    </div>
@endforeach
