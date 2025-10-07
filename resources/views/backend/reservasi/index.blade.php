@extends('layouts.layout')

@section('content')
    <x-default-card title="Reservasi">
        @if (auth()->user()->role === 'customer')
        <x-button-add route="{{ route('reservasi.create') }}"/>
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
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });
        });
    </script>
    
@endpush