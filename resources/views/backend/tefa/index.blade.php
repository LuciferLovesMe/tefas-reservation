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
    <x-default-card :title="['Teaching Factory (TEFA)']">
        <x-button-add route="{{ route('tefa.create') }}"/>
        @include('backend.tefa._table')
    </x-default-card>
@endsection


@push('scripts')
    <script>
        window.deleteRow = function(formId) {
            // Dapatkan form-nya menggunakan ID yang dikirim
            const form = $('#' + formId);
        
            // Pastikan form ditemukan
            if (form.length === 0) {
                console.error('Error: Tidak dapat menemukan form dengan ID: ' + formId);
                return;
            }
        
            Swal.fire({
                title: 'Apakah Anda yakin?', // Ganti ke Bahasa Indonesia
                text: "Data yang dihapus tidak dapat dikembalikan!", // Ganti ke Bahasa Indonesia
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!', // Ganti ke Bahasa Indonesia
                cancelButtonText: 'Batal' // Ganti ke Bahasa Indonesia
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
        

        $(document).ready(() => {
            const table = $("#tableData").DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                ajax: "{{ route('tefa.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'nama', name: 'nama' },
                    { data: 'max_peserta', name: 'max_peserta' },
                    { data: 'deskripsi', name: 'deskripsi' },
                    { data: 'jenis_kunjungan', name: 'jenis_kunjungan' },
                    { data: 'waktu_panen', name: 'waktu_panen' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                "drawCallback": function( settings ) {
                    console.log('DataTables drawCallback triggered!'); // DEBUG 1
        
                    // 1. INSIALISASI ULANG DROPDOWN BOOTSTRAP
                    var dropdownTriggerList = [].slice.call(
                        this.api().table().body().querySelectorAll('[data-bs-toggle="dropdown"]')
                    );
                    
                    console.log('Found ' + dropdownTriggerList.length + ' dropdowns to initialize.'); // DEBUG 2
        
                    dropdownTriggerList.map(function (dropdownTriggerEl) {
                        var instance = bootstrap.Dropdown.getInstance(dropdownTriggerEl);
                        if (!instance) {
                            // Buat instance Dropdown baru
                            new bootstrap.Dropdown(dropdownTriggerEl);
                        }
                        return dropdownTriggerEl;
                    });
                }
            
            });
        })
    </script>
@endpush