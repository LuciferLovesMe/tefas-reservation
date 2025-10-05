@props([
    'name' => '',
    'id' => '',
    'value' => ''
])
<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ ucwords(str_replace('_', ' ', $name)) }}</label>
    <input type="time" class="form-control" id="{{ $id }}" name="{{ $name }}" aria-describedby="" value="{{ $value }}">
</div>