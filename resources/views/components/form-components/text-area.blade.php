@props([
    'name' => '', 
    'id' => '',
    'value' => ''
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ ucwords(str_replace('_', ' ', $name)) }}</label>
    <textarea name="{{ $name }}" id="{{ $id }}" cols="30" rows="10" class="form-control">{{ $value }}</textarea>
</div>