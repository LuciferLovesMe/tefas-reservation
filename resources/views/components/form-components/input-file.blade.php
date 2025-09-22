@props([
    'name' => '',
    'id' => '',
    'label' => '',
    'class' => '',
    'data_id' => '',
    'img_src' => '',
    'is_edit' => false,
    'data_id' => ''
])

@if (!$is_edit)
    <div class="mb-3 {{ $class }}" data-id="{{ $data_id }}" data-edit="{{ $img_src != null ? true : false }}">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <img style="max-width: 100%" src="{{ $img_src }}" alt="" class="text-center mb-3 preview-{{ $class }}">
            </div>
            <div class="col-md-12">
                <label for="{{ $id }}" class="form-label">{{ ucwords($label) }}</label>
                <input type="file" onchange="imgPreview('{{ $id }}', 'preview-{{ $class }}')" class="form-control" id="{{ $id }}" name="{{ $name }}" aria-describedby="" data-id="{{ $data_id }}">
            </div>
        </div>
    </div>
@else
    <div class="mb-3 {{ $class }}" data-id="{{ $data_id }}" data-edit="{{ $img_src != null ? true : false }}">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <img style="max-width: 100%" src="{{ $img_src }}" alt="" class="text-center mb-3 preview-{{ $class }}">
            </div>
            <div class="col-md-12">
                <div class="input-group">
                    <input type="file" onchange="imgPreview('{{ $id }}', 'preview-{{ $class }}')" class="form-control" id="{{ $id }}" name="{{ $name }}" data-id="{{ $id }}" aria-label="Recipient’s username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary btnHapus{{ $class }}" type="button" id="button-addon2" onClick="deleteForm('#{{ $id }}')">Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endif