@extends('layouts.layout')

@section('content')
    <x-default-card :title="['Dashboard']">

        <div class="card border shadow-sm rounded-3 mb-4">
            <div class="card-body">
                <h5 class="card-title">Selamat Datang, {{ auth()->user()->name }}!</h5>
                <div class="row g-4">
        
                    <!-- Kartu 1: Reservasi Hari Ini -->
                    <div class="col-xl-4 col-md-4">
                        <div class="card shadow-sm rounded-3 h-100">
                            <div class="card-body p-4 d-flex align-items-center">
                                <!-- Ikon -->
                                <div class="flex-shrink-0 d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="bi bi-clock-history fs-3"></i>
                                </div>
                                <!-- Konten Teks -->
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted text-uppercase small fw-bold">Reservasi Pending</h6>
                                    <p class="h3 fw-bold mb-0">{{ $dataReservasiCard['pending'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Kartu 2: Menunggu Persetujuan (Actionable) -->
                    <div class="col-xl-4 col-md-4">
                        <div class="card shadow-sm rounded-3 h-100">
                            <div class="card-body p-4 d-flex align-items-center">
                                <!-- Ikon -->
                                <div class="flex-shrink-0 d-inline-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="bi bi-x-circle-fill fs-3"></i>
                                </div>
                                <!-- Konten Teks -->
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted text-uppercase small fw-bold">Reservasi Batal</h6>
                                    <p class="h3 fw-bold mb-0">{{ $dataReservasiCard['cancel'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <!-- Kartu 3: Dikonfirmasi (Bulan Ini) -->
                    <div class="col-xl-4 col-md-4">
                        <div class="card shadow-sm rounded-3 h-100">
                            <div class="card-body p-4 d-flex align-items-center">
                                <!-- Ikon -->
                                <div class="flex-shrink-0 d-inline-flex align-items-center justify-content-center bg-success-subtle text-success rounded-circle" style="width: 60px; height: 60px;">
                                    <i class="bi bi-check-circle-fill fs-3"></i>
                                </div>
                                <!-- Konten Teks -->
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted text-uppercase small fw-bold">Reservasi Selesai</h6>
                                    <p class="h3 fw-bold mb-0">{{ $dataReservasiCard['done'] ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
        
                </div> <!-- /row -->
            </div>
        </div>
        <div class="card border shadow-sm rounded-3 mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Data Reservasi Terbaru</h5>
                <div class="row mt-3">
                    <div class="col-md-12">
                        @include('backend.dashboard._table')
                    </div>
                </div>
            </div>
        </div>
    </x-default-card>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const table = $('#tableData').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                ajax: "{{ route('dashboard.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'tanggal_reservasi', name: 'tanggal_reservasi' },
                    { data: 'start', name: 'start' },
                    { data: 'end', name: 'end' },
                    { data: 'nama_tefa', name: 'nama_tefa' },
                    { data: 'nama_pemesan', name: 'nama_pemesan' },
                    { data: 'status', name: 'status' },
                ],
            });
        });
    </script>
    
@endpush