@extends('layouts.layout')

@section('content')
    <form action="{{ route('ruangan.store') }}" method="post" enctype="multipart/form-data">
        <x-default-card :isForm="true" title="Ruangan | Tambah">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <x-form-components.input-text name="nama_ruangan" id="nama_ruangan"/>
                    <x-form-components.input-text name="kapasitas" id="kapasitas"/>
                </div>
                <div class="col-md-5">
                    <div class="card border">
                        <div class="card-header text-right d-flex justify-content-between">
                            <p>Gambar</p>
                            <button type="button" class="btn btn-primary" id="btnGambar">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <div class="card-body card-gambar">
                            <x-form-components.input-file class="gambar" name="gambar[]" id="gambar" />
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
            let countGambar = 1, countFasilitas = 1;

            $("#btnGambar").on('click', () => {
                countGambar += 1;
                $(".card-gambar").append(`
                    <div class="mb-3 gambar-${countGambar}" data-count="${countGambar}" data-edit="0">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-6">
                                <img style="max-width: 100%" src="" alt="" class="text-center mb-3 preview-gambar-${countGambar}">
                            </div>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="file" class="form-control" onChange="imgPreview('gambar-${countGambar}', 'preview-gambar-${countGambar}')" id="gambar-${countGambar}" name="gambar[]" data-id="gambar-${countGambar}" aria-label="Recipient’s username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary btnHapusGambar" type="button" data-count="${countGambar}" id="button-addon2" onClick="deleteForm('#gambar-${countGambar}')">Hapus</button>
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

            $(".card-Gambar").on('click', '.btnHapusGambar', () => {
                let id = $(this).data('count')
                console.log($(this).parent());
                
                $(`.Gambar-${id}`).remove()
            })
            $(".card-fasilitas").on('click', '.btnHapusFasilitas', () => {
                let id = $(this).data('id')
                $(`.fasilitas-${id}`).remove()
            })
        })
    </script>
@endpush