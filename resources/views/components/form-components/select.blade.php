@props([
    'name' => '',
    'id' => '',
    'value' => '',
    'isMultiple' => false,
    'multipleValue' => [],
    'options' => []
])
<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ ucwords(str_replace(['_', '[]', 'id'], ' ', $name)) }}</label>
    <select class="form-select select2 border border-primary @error($name) is-invalid @enderror @if($isMultiple) multipleSelect @endif" @if($isMultiple) multiple @endif id="{{ $id }}" name="{{ $name . '_id' . ($isMultiple ? '[]' : '') }}" aria-label="Default select example">
        <option value="" disabled>Pilih {{ ucwords(str_replace(['_', '[]', 'id'], ' ', $name)) }}</option>
        @forelse ($options as $key => $option)
            <option value="{{ $key }}" 
            @if($isMultiple && $multipleValue && in_array($key, $multipleValue)) selected 
            @elseif(!$isMultiple && (string)$key === (string)$value) selected 
            @endif
            >{{ ucwords(str_replace('_', ' ', $option)) }}</option>
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