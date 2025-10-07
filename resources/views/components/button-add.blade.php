@props(['route' => '#'])

<div class="row d-flex justify-content-end">
    <div class="col-md-4 d-flex justify-content-end">
        {{-- Tombol yang sudah diperbaiki --}}
        <a href="{{ $route }}" {{ $attributes->merge(['class' => 'btn btn-success d-flex align-items-center']) }}>
            <i class="bi bi-plus me-2"></i> Tambah
        </a>
    </div>
</div>