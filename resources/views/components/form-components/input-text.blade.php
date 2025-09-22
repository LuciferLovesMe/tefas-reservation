@props([
    'name' => '',
    'id' => '',
    'value' => ''
])
<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ ucwords($name) }}</label>
    <input type="text" class="form-control" id="{{ $id }}" name="{{ $name }}" aria-describedby="" value="{{ $value }}">
</div>