@props([
    'isForm' => false,
    'title' => [],
])
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $title[0] }}</h3>
                {{-- <p class="text-subtitle text-muted">The default layout </p> --}}
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                {{-- <x-breadcrumb-item /> --}}
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            @if (count($title) > 1)
            <div class="card-header">
                <h4 class="card-title">{{ $title[1] }}</h4>
            </div>
            @endif
            <div class="card-body">
                {{ $slot }}
            </div>
            @if ($isForm)
                <div class="card-footer">
                    <x-form-components.button-submit />
                </div>
            @endif
        </div>
    </section>
</div>
