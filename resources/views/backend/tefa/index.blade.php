@extends('layouts.layout')

@section('content')
    <x-default-card>
        @include('backend.tefa._table')
    </x-default-card>
@endsection

@push('scripts')
    <script>
        $(document).ready(() => {
            $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('tefa.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nama_td', name: 'nama' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });
        })
    </script>
@endpush