@extends('layouts.layout')

@section('content')
    <form action="{{ route('rule.store') }}" method="post" enctype="multipart/form-data">
        <x-default-card :isForm="true" :title="['Aturan Rekomendasi', 'Tambah']">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <x-form-components.select name="jenjang" id="jenjang" :options="$jenjang"/>
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
                    url: "{{ url('getCapaianByAktivitas') }}/" + aktivitasId,
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
        });
    </script>
    
@endpush