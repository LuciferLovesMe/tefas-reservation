@extends('layouts.layout')

@section('content')
    <form action="{{ route('tefa.store') }}" method="post" enctype="multipart/form-data">
        <x-default-card :isForm="true" title="Teaching Factory (TEFA) | Tambah">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <x-form-components.input-text name="nama" id="nama"/>
                    <x-form-components.text-area name="deskripsi" id="deskripsi"/>
                    <x-form-components.select name="jenis_kunjungan" :isMultiple="true" id="jenis_kunjungan" :options="$jenisKunjunganOptions" label="Jenis Kunjungan"/>
                </div>
                <div class="col-md-12">
                    <div class="card border">
                        <div class="card-header text-right d-flex justify-content-between">
                            <p>Kegiatan</p>
                            <button type="button" class="btn btn-primary" id="btnKegiatan">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <div class="card-body card-kegiatan">
                            <x-form-components.input-file class="kegiatan" name="kegiatan[]" id="kegiatan" />
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-header text-right d-flex justify-content-between">
                            <p>Produk</p>
                            <button type="button" class="btn btn-primary" id="btnProduk">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <div class="card-body card-produk">
                            <x-form-components.input-file class="produk" name="produk[]" id="produk"/>
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-header text-right d-flex justify-content-between">
                            <p>Fasilitas</p>
                            <button type="button" class="btn btn-primary" id="btnFasilitas">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <div class="card-body card-fasilitas">
                            <x-form-components.input-file class="fasilitas" name="fasilitas[]" id="fasilitas" />
                        </div>
                    </div>
                </div>
            </div>
        </x-default-card>
    </form>
@endsection

@push('scripts')
    <script>
        function deleteForm (element) {
            $(`${element}`).parent().remove()
        }

        $(document).ready(() => {
            let countKegiatan = 1, countProduk = 1, countFasilitas = 1;

            $("#btnKegiatan").on('click', () => {
                countKegiatan += 1;
                $(".card-kegiatan").append(`
                    <div class="mb-3 kegiatan-${countKegiatan}" data-count="${countKegiatan}" data-edit="0">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6">
                                <img style="max-width: 100%" src="" alt="" class="text-center mb-3 preview-kegiatan-${countKegiatan}">
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="file" class="form-control" onChange="imgPreview('kegiatan-${countKegiatan}', 'preview-kegiatan-${countKegiatan}')" id="kegiatan-${countKegiatan}" name="kegiatan[]" data-id="kegiatan-${countKegiatan}" aria-label="Recipient’s username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary btnHapusKegiatan" type="button" data-count="${countKegiatan}" id="button-addon2" onClick="deleteForm('#kegiatan-${countKegiatan}')">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `)
            })
            $("#btnProduk").on('click', () => {
                countProduk += 1;
                $(".card-produk").append(`
                    <div class="mb-3 produk-${countProduk}" data-count="${countProduk}" data-edit="0">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6">
                                <img style="max-width: 100%" src="" alt="" class="text-center mb-3 preview-produk-${countProduk}">
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="file" class="form-control" onChange="imgPreview('produk-${countProduk}', 'preview-produk-${countProduk}')" id="produk-${countProduk}" name="produk[]" data-id="produk-${countProduk}" aria-label="Recipient’s username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary btnHapusKegiatan" type="button" data-count="${countProduk}" id="button-addon2" onClick="deleteForm('#produk-${countProduk}')">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `)
            })
            $("#btnFasilitas").on('click', () => {
                countFasilitas += 1;
                $(".card-fasilitas").append(`
                    <div class="mb-3 fasilitas-${countFasilitas}" data-count="${countFasilitas}" data-edit="0">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6">
                                <img style="max-width: 100%" src="" alt="" class="text-center mb-3 preview-fasilitas-${countFasilitas}">
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="file" class="form-control" onChange="imgPreview('fasilitas-${countFasilitas}', 'preview-fasilitas-${countFasilitas}')" id="fasilitas-${countFasilitas}" name="fasilitas[]" data-id="fasilitas-${countFasilitas}" aria-label="Recipient’s username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary btnHapusfasilitas" type="button" data-count="${countFasilitas}" id="button-addon2" onClick="deleteForm('#fasilitas-${countFasilitas}')">Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `)
            })

            $(".card-kegiatan").on('click', '.btnHapusKegiatan', () => {
                let id = $(this).data('count')
                console.log($(this).parent());
                
                $(`.kegiatan-${id}`).remove()
            })
            $(".card-produk").on('click', '.btnHapusProduk', () => {
                let id = $(this).data('id')
                $(`.produk-${id}`).remove()
            })
            $(".card-fasilitas").on('click', '.btnHapusFasilitas', () => {
                let id = $(this).data('id')
                $(`.fasilitas-${id}`).remove()
            })
        })
    </script>
@endpush