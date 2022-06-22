<div class="form-group {{ $topclass }}">
    <label for="{{ $id }}">{{ $label }}</label>
    <div class="input-group ">
        <input type="{{ $type }}" class="{{ $inputclass }} form-control @error($name) is-invalid @enderror"
                id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}" autocomplete="off"
                @if (!is_null($step)) step="{{ $step }}" @endif
                @if (!is_null($max)) max="{{ $max }}" @endif
                @if (!is_null($maxlength)) maxlength="{{ $maxlength }}" @endif
                @if (!is_null($pattern)) pattern="{{ $pattern }}" @endif value="{{ $value }}"
                {{ $required ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }}>
        <div class="input-group-prepend">
                <span class="input-group-append">
                    <button type="button" id="{{ $idbutton }}" class="btn btn-info btn-flat" data-toggle="modal"><i class="{{ $icon }}"></i></button>
                </span>
        </div>


        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>El campo es obligatorio</strong>
            </span>
        @enderror
    </div>

</div>
