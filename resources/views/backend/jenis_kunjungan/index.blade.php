@extends('layouts.layout')

@push('styles')
    <style>
        /* Mengatur agar input search dan select memiliki tinggi yang sama */
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            border: 1px solid #ced4da;
        }
        /* Menghilangkan label dari dropdown "entries" */
        .dataTables_wrapper .dataTables_length label {
            display: flex;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    <x-default-card :title="['Jenis Kunjungan']">
        <x-button-add route="{{ route('jenis-kunjungan.create') }}"/>
        @include('backend.jenis_kunjungan._table')
    </x-default-card>
@endsection


@push('scripts')
    <script>
        $(document).ready(() => {
            const table = $("#tableData").DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                ajax: "{{ route('jenis-kunjungan.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nama', name: 'nama' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
            });

            $("#tableData").on('click', '.btnDelete', (e) => {
                console.log($(this).data('id'));
            })

            $('#tableData').on('click', '.delete-button', function () {
                let data = $(this).data('form-delete');
                console.log(data);
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Buat form dinamis untuk mengirim request DELETE  
                        $(`#${data}`).submit()
                    }
                })
            });
        })
    </script>
@endpush