@extends('layouts.layout')

@section('content')
    <form action="{{ route('reservasi.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-default-card :isForm="true" :title="['Reservasi', 'Tambah']">
            <div class="row">
                <div class="col">
                    <x-form-components.input-datetime name="jadwal_mulai" id="jadwal_mulai" :value="$data->jadwal_mulai" />
                    <x-form-components.input-datetime name="jadwal_berakhir" id="jadwal_berakhir" :value="$data->jadwal_berakhir" />
                    <x-form-components.input-number name="jumlah_peserta" id="jumlah_peserta" :value="$data->jumlah_peserta" />
                    <x-form-components.select name="aktivitas" id="aktivitas" :options="$aktivitas"  :value="$saved_aktivitas_id ?? null"/>
                    
                    <div class="mb-3">
                        <label for="capaian_pembelajaran" class="form-label">Capaian Pembelajaran</label>
                        <select class="form-control border-none form-select form-select-xl select2 @error('capaian_pembelajaran') is-invalid @enderror" id="capaian_pembelajaran" name="capaian_pembelajaran_id" aria-label="Default select example">
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="jenis_kunjungan" class="form-label">Jenis Kunjungan</label>
                        <select class="form-control border-none form-select form-select-xl select2 @error('jenis_kunjungan') is-invalid @enderror" id="jenis_kunjungan" name="jenis_kunjungan_id" aria-label="Default select example">
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tefa" class="form-label">Teaching Factory</label>
                        <select class="form-control border-none form-select form-select-xl select2 @error('tefa') is-invalid @enderror" id="tefa" name="tefa_id" aria-label="Default select example">
                        </select>
                    </div>
                </div>
            </div>
            
        </x-default-card>
    </form>
@endsection

@push('scripts')
    {{-- Pastikan Anda sudah me-load jQuery jika menggunakan '$' --}}
    <script>
        $(document).ready(function() {

            // ====================================================================
            // BAGIAN 1: ID YANG TERSIMPAN (Dari Controller)
            // ====================================================================
            const savedAktivitasId = "{{ $saved_aktivitas_id ?? '' }}";
            const savedCapaianId = "{{ $saved_capaian_id ?? '' }}";
            const savedJenisKunjunganId = "{{ $saved_jenis_kunjungan_id ?? '' }}";
            const savedTefaId = "{{ $saved_tefa_id ?? '' }}";
            
            // (BARU) Ambil jenjang customer dari Controller
            const customerJenjang = "{{ $customer_jenjang ?? '' }}"; // e.g., "SD"

            // Referensi ke Select Element
            const aktivitasSelect = $("#aktivitas");
            const capaianPembelajaranSelect = $("#capaian_pembelajaran");
            const jenisKunjunganSelect = $("#jenis_kunjungan");
            const tefaSelect = $("#tefa");
            const jadwalMulaiInput = $("#jadwal_mulai");
            
            // Ganti rute ini sesuai dengan 'name()' di file rute Anda
            const RUTE_GET_CAPAIAN = "{{ route('getCapaianByAktivitas') }}"; 
            const RUTE_GET_JENIS_KUNJUNGAN_BASE = "{{ url('getJenisKunjunganByCapaian') }}"; // /options/jenis-kunjungan/{id}
            const RUTE_GET_TEFA_BASE = "{{ url('getTefaByJenisKunjungan') }}"; // /options/tefa/{id}


            // ====================================================================
            // BAGIAN 2: EVENT HANDLER "ON CHANGE"
            // ====================================================================

            aktivitasSelect.on('change', function() {
                let aktivitasId = $(this).val();
                
                // Reset semua di bawahnya
                capaianPembelajaranSelect.empty().append('<option value="">Pilih Capaian Pembelajaran</option>').trigger('change');
                jenisKunjunganSelect.empty().append('<option value="">Pilih Jenis Kunjungan</option>').trigger('change');
                tefaSelect.empty().append('<option value="">Pilih Teaching Factory</option>').trigger('change');

                if (!aktivitasId) return; // Keluar jika "Pilih Aktivitas"

                $.ajax({
                    url: RUTE_GET_CAPAIAN,
                    type: "GET",
                    data: {
                        aktivitas_id: aktivitasId,
                        jenjang: customerJenjang // (BARU) Kirim jenjang customer
                    },
                    success: function(response) {
                        capaianPembelajaranSelect.empty().append('<option value="">Pilih Capaian Pembelajaran</option>'); // Hapus 'loading'
                        $.each(response, function(key, value) {
                            capaianPembelajaranSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                        capaianPembelajaranSelect.trigger('change'); // Untuk select2
                    },
                    error: function(xhr) { 
                        console.error(xhr.responseText); 
                        capaianPembelajaranSelect.empty().append('<option value="">Gagal memuat</option>');
                    }
                });
            });

            capaianPembelajaranSelect.on('change', function() {
                let capaianId = $(this).val();

                // Reset semua di bawahnya
                jenisKunjunganSelect.empty().append('<option value="">Pilih Jenis Kunjungan</option>').trigger('change');
                tefaSelect.empty().append('<option value="">Pilih Teaching Factory</option>').trigger('change');

                if (!capaianId) return;

                $.ajax({
                    url: `${RUTE_GET_JENIS_KUNJUNGAN_BASE}/${capaianId}`, 
                    type: "GET",
                    // data: { jenjang: customerJenjang }, // (Opsional) jika perlu
                    success: function(response) {
                        jenisKunjunganSelect.empty().append('<option value="">Pilih Jenis Kunjungan</option>');
                        $.each(response, function(key, value) {
                            jenisKunjunganSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                        jenisKunjunganSelect.trigger('change');
                    },
                    error: function(xhr) { 
                        console.error(xhr.responseText);
                        jenisKunjunganSelect.empty().append('<option value="">Gagal memuat</option>');
                    }
                });
            });

            jenisKunjunganSelect.on('change', function() {
                let jenisKunjunganId = $(this).val();
                let tanggal = jadwalMulaiInput.val();

                // Reset Tefa
                tefaSelect.empty().append('<option value="">Pilih Teaching Factory</option>').trigger('change');
                
                if (!jenisKunjunganId) return;

                $.ajax({
                    url: `${RUTE_GET_TEFA_BASE}`,
                    type: "GET",
                    data: {
                        tanggal: tanggal,
                        jenis_kunjungan_id: jenisKunjunganId
                    },
                    success: function(response) {
                        tefaSelect.empty().append('<option value="">Pilih Teaching Factory</option>');
                        $.each(response, function(key, value) {
                            tefaSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                        tefaSelect.trigger('change');
                    },
                    error: function(xhr) { 
                        console.error(xhr.responseText);
                        tefaSelect.empty().append('<option value="">Gagal memuat</option>');
                    }
                });
            });

            // (PENTING) Jika tanggal berubah, Tefa juga harus di-load ulang
            jadwalMulaiInput.on('change', function() {
                if (jenisKunjunganSelect.val()) {
                    // Panggil ulang Tefa load
                    jenisKunjunganSelect.trigger('change'); 
                }
            });


            // ====================================================================
            // BAGIAN 3: LOGIKA "ON LOAD" UNTUK FORM EDIT
            // ====================================================================
            function loadEditData() {
                if (!savedAktivitasId) {
                    return; // Tidak ada data, ini form create baru
                }

                // 1. Muat Capaian Pembelajaran
                $.ajax({
                    url: RUTE_GET_CAPAIAN,
                    type: "GET",
                    data: {
                        aktivitas_id: savedAktivitasId,
                        jenjang: customerJenjang // (BARU) Kirim jenjang saat 'load'
                    },
                    success: function(response) {
                        capaianPembelajaranSelect.empty().append('<option value="">Pilih Capaian Pembelajaran</option>');
                        $.each(response, function(key, value) {
                            let isSelected = (key == savedCapaianId);
                            capaianPembelajaranSelect.append(`<option value="${key}" ${isSelected ? 'selected' : ''}>${value}</option>`);
                        });
                        capaianPembelajaranSelect.trigger('change'); // Update select2

                        // 2. Jika Capaian ID ada, muat Jenis Kunjungan
                        if (savedCapaianId) {
                            $.ajax({
                                url: `${RUTE_GET_JENIS_KUNJUNGAN_BASE}/${savedCapaianId}`,
                                type: "GET",
                                success: function(response) {
                                    jenisKunjunganSelect.empty().append('<option value="">Pilih Jenis Kunjungan</option>');
                                    $.each(response, function(key, value) {
                                        let isSelected = (key == savedJenisKunjunganId);
                                        jenisKunjunganSelect.append(`<option value="${key}" ${isSelected ? 'selected' : ''}>${value}</option>`);
                                    });
                                    jenisKunjunganSelect.trigger('change');

                                    // 3. Jika Jenis Kunjungan ID ada, muat Tefa
                                    if (savedJenisKunjunganId) {
                                        let tanggal = jadwalMulaiInput.val();
                                        $.ajax({
                                            url: `${RUTE_GET_TEFA_BASE}`,
                                            type: "GET",
                                            data: { tanggal: tanggal, jenis_kunjungan_id: savedJenisKunjunganId },
                                            success: function(response) {
                                                tefaSelect.empty().append('<option value="">Pilih Teaching Factory</option>');
                                                $.each(response, function(key, value) {
                                                    let isSelected = (key == savedTefaId);
                                                    tefaSelect.append(`<option value="${key}" ${isSelected ? 'selected' : ''}>${value}</option>`);
                                                });
                                                tefaSelect.trigger('change');
                                            },
                                            error: function(xhr) { console.error(xhr.responseText); }
                                        });
                                    }
                                },
                                error: function(xhr) { console.error(xhr.responseText); }
                            });
                        }
                    },
                    error: function(xhr) { console.error(xhr.responseText); }
                });
            }

            // Panggil fungsi "on load"
            loadEditData();

        });
    </script>
@endpush
