<label for="password">{{ $label }}</label>
<input type="{{ $type ?? 'text' }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" value="{{ old($name) }}" required>
@error($name)
<small class="text-danger">{{ $message }}</small>
@enderror