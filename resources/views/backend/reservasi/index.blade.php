@extends('layouts.layout')

@push('modal')
    @foreach ($dataId as $item)
        <div class="modal fade" id="staticBackdrop-{{ $item['id'] }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Ubah Status Reservasi {{ $item['id'] }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('reservasi.updateStatus', $item['id']) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status Reservasi</label>
                                <select class="form-control border-none form-select form-select-xl select2 @error('status') is-invalid @enderror" id="status" name="status" aria-label="Default select example">
                                    <option value="pending" {{ $item['status'] === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="done" {{ $item['status'] === 'done' ? 'selected' : '' }}>Done</option>
                                    <option value="cancel" {{ $item['status'] === 'cancel' ? 'selected' : '' }}>Cancel</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endpush

@section('content')
    <x-default-card :title="['Reservasi']">
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
                    { data: 'nama_tefa', name: 'nama_tefa' },
                    { data: 'nama_pemesan', name: 'nama_pemesan' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                "drawCallback": function( settings ) {
            
                    // 1. INSIALISASI ULANG DROPDOWN BOOTSTRAP
                    // Kita perlu mencari semua pemicu dropdown di dalam isi tabel
                    // dan menginisialisasinya secara manual.
                    var dropdownTriggerList = [].slice.call(
                        // 'this.api().table().body()' lebih efisien daripada 'document.querySelectorAll'
                        this.api().table().body().querySelectorAll('[data-bs-toggle="dropdown"]')
                    );
                    
                    dropdownTriggerList.map(function (dropdownTriggerEl) {
                        // Periksa apakah sudah diinisialisasi, untuk menghindari duplikat
                        if (!bootstrap.Dropdown.getInstance(dropdownTriggerEl)) {
                            return new bootstrap.Dropdown(dropdownTriggerEl);
                        }
                    });

                    // 2. MODAL TIDAK PERLU INISIALISASI ULANG
                    // Komponen Modal Bootstrap 'mendengarkan' di level 'document',
                    // jadi selama tombol Anda memiliki data-bs-toggle="modal" (perbaikan kita sebelumnya)
                    // dan data-bs-target yang benar, itu akan berfungsi
                    // SETELAH dropdown (induknya) berfungsi.
                }
            });

            $("#tableData tbody").on('click', '.btnModal', function (e) {
                e.preventDefault();
                var modalId = $(this).data('bs-target');
                $(modalId).modal('show');
            });
        });
    </script>
    
@endpush