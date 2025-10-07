@extends('layouts.layout')

@section('content')
    <x-default-card title="Reservasi">
        @if (auth()->user()->role === 'customer')
            <div class="row d-flex justify-content-end">
                <div class="col-md-4 d-flex justify-content-end">
                    <a href="{{ route('reservasi.create') }}" class="btn btn-success"><i class="bi bi-plus"></i> Tambah</a>
                </div>
            </div>
        @endif
        @include('backend.reservasi._table')
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
                ajax: "{{ route('reservasi.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'tanggal_reservasi', name: 'tanggal_reservasi' },
                    { data: 'start', name: 'start' },
                    { data: 'end', name: 'end' },
                    { data: 'ruangan.nama_ruangan', name: 'ruangan.nama_ruangan' },
                    { data: 'nama_pemesan', name: 'nama_pemesan' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });
        });
    </script>
    
@endpush