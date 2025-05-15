<div class="mb-3">
    <label for="{{ $attributes->get('id', $name) }}" class="form-label">{{ $label }}</label>
    <input
        type="{{ $type }}"
        class="form-control @error($name) is-invalid @enderror"
        id="{{ $attributes->get('id', $name) }}"
        name="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->except(['id', 'type', 'name', 'value', 'class']) }}
    />
    <span class="error invalid-feedback">{{ $errors->first($name) }}</span>
</div>
