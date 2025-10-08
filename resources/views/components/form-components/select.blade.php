@props([
    'name' => '',
    'id' => '',
    'value' => '',
    'options' => []
])
<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ ucwords(str_replace('_', ' ', $name)) }}</label>
    <select class="form-select select2 border border-spacing-1 @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}_id" aria-label="Default select example">
        <option value="">Pilih {{ ucwords(str_replace('_', ' ', $name)) }}</option>
        @forelse ($options as $key => $option)
            <option value="{{ $key }}" {{ $key == $value ? 'selected' : '' }}>{{ ucwords(str_replace('_', ' ', $option)) }}</option>
        @empty
            <option value="">Tidak ada data</option>
        @endforelse
    </select>
    @error($name)
        <div id="{{ $id }}-error" class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>