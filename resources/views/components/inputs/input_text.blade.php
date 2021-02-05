<label for="password">{{ $label }}</label>
@if(isset($prepend))
<div class="input-group mb-2">
    <div class="input-group-prepend">
        <div class="input-group-text"><i class="{{ $prepend }}"></i></div>
    </div>
    <input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" value="{{ $value ?? old($name) }}" required>
</div>
@else
<input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" value="{{ $value ?? old($name) }}" required>
@endif
@error($name)
<small class="text-danger">{{ $message }}</small>
@enderror