@props([
    'name' => '',
    'id' => '',
    'value' => ''
])
<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ ucwords(str_replace('_', ' ', $name)) }}</label>
    <input type="text" class="border form-control @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}" aria-describedby="{{ $id }}-error" value="{{ old($name, $value) }}">
    @error($name)
        <div id="{{ $id }}-error" class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>