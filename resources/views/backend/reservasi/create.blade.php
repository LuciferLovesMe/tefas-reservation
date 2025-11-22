@extends('layouts.layout')

@section('content')
    <form action="{{ route('reservasi.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-default-card :isForm="true" :title="['Reservasi', 'Tambah']">
            <div class="row">
                <div class="col">
                    <x-form-components.input-date-time name="jadwal_mulai" id="jadwal_mulai" />
                    <x-form-components.input-date-time name="jadwal_berakhir" id="jadwal_berakhir" />
                    <x-form-components.input-number name="jumlah_peserta" id="jumlah_peserta" />
                    <x-form-components.select name="aktivitas" id="aktivitas" :options="$aktivitas"/>
                    
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
    <script>
        $(document).ready(function() {
            $("#aktivitas").on('change', function() {
                let aktivitasId = $(this).val();
                $.ajax({
                    url: "{{ route('getCapaianByAktivitas') }}",
                    type: "GET",
                    data: {
                        aktivitas_id: aktivitasId
                    },
                    success: function(response) {
                        let capaianPembelajaranSelect = $("#capaian_pembelajaran");
                        let jeniskunjunganSelect = $("#jenis_kunjungan");
                        jeniskunjunganSelect.empty();
                        capaianPembelajaranSelect.empty();
                        capaianPembelajaranSelect.append('<option value="">Pilih Capaian Pembelajaran</option>');
                        $.each(response, function(key, value) {
                            capaianPembelajaranSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $("#capaian_pembelajaran").on('change', function() {
                let capaianId = $(this).val();
                $.ajax({
                    url: "{{ url('getJenisKunjunganByCapaian') }}/" + capaianId,
                    type: "GET",
                    data: {
                        capaian_id: capaianId
                    },
                    success: function(response) {
                        let jenisKunjunganSelect = $("#jenis_kunjungan");
                        jenisKunjunganSelect.empty();
                        jenisKunjunganSelect.append('<option value="">Pilih Jenis Kunjungan</option>');
                        $.each(response, function(key, value) {
                            jenisKunjunganSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $("#jenis_kunjungan").on('change', function() {
                let jenisKunjunganId = $(this).val();
                let tanggal = $("#jadwal_mulai").val()
                $.ajax({
                    url: "{{ url('getTefaByJenisKunjungan') }}/",
                    type: "GET",
                    data: {
                        jenis_kunjungan_id: jenisKunjunganId,
                        tanggal: tanggal
                    },
                    success: function(response) {
                        let tefaSelect = $("#tefa");
                        tefaSelect.empty();
                        tefaSelect.append('<option value="">Pilih Teaching Factory</option>');
                        $.each(response, function(key, value) {
                            tefaSelect.append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    
@endpush