@extends('layouts.layout')

@section('content')
    <x-default-card>
        @include('backend.tefa._table')
    </x-default-card>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            console.log('test cak');
            
            const table = $("#tableData").DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                ajax: "{{ route('tefa.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nama', name: 'nama' },
                    { data: 'deskripsi', name: 'deskripsi' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });
        })
    </script>
@endpush