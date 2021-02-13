<label for="password">{{ $label }}</label>
@if(isset($prepend))
<div class="input-group mb-2">
    <div class="input-group-prepend">
        <div class="input-group-text"><i class="{{ $prepend }}"></i></div>
    </div>
    <input type="{{ $type ?? 'text' }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" value="{{ $value ?? old($name) }}"
            {{ isset($readonly) ? 'readonly' : '' }} required>
</div>
@else
<input type="{{ $type ?? 'text' }}" id="{{ $name }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" value="{{ $value ?? old($name) }}"
        {{ isset($readonly) ? 'readonly' : '' }} required>
@endif
@error($name)
<small class="text-danger">{{ $message }}</small>
@enderror