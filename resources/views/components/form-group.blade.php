<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input 
        type="{{ $type ?? 'text' }}" 
        class="form-control" 
        id="{{ $id }}" 
        name="{{ $name }}" 
        value="{{ old($name, $aset->$name ?? '') }}" 
        placeholder="{{ $placeholder ?? '' }}" 
        {{ $required ? 'required' : '' }}>
    @error($name)
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
