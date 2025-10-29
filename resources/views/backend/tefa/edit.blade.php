@extends('layouts.layout')

@section('content')
    <form action="{{ route('tefa.update', $data->id) }}" method="post" enctype="multipart/form-data">
        <x-default-card :isForm="true" :title="['Teaching Factory (TEFA)', 'Ubah']">
            @csrf
            @method('PUT')
            <input type="hidden" name="delete_tefa_id">
            <div class="row">
                <div class="col-md-12">
                    <x-form-components.input-text name="nama" id="nama" value="{{ $data->nama }}" />
                    <x-form-components.input-number name="max_jumlah_peserta" id="max_jumlah_peserta" label="Maksimal Jumlah Peserta" value="{{ $data->max_jumlah_peserta }}"/>
                    <x-form-components.select name="waktu_panen" :isMultiple="true" id="waktu_panen" :options="$waktuPanenOptions" :multipleValue="explode(',', $data->waktu_panen)" label="Waktu Panen"/>
                    <x-form-components.select name="jenis_kunjungan" :isMultiple="true" id="jenis_kunjungan" :options="$jenisKunjunganOptions" :multipleValue="$data->jenisKunjungans->pluck('id')->toArray()" label="Jenis Kunjungan"/>
                    <x-form-components.text-area name="deskripsi" id="deskripsi" value="{{ $data->deskripsi }}" />
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
                            @forelse ($data->kegiatanTefa as $key => $item)
                                <input type="hidden" name="kegiatan_id[]" id="" value="{{ $item->id }}">
                                <x-form-components.input-file class="kegiatan-{{ $key+1 }}" data_id="{{ $item->id }}" name="kegiatan[]" id="kegiatan-{{ $key+1 }}" img_src="{{ asset('uploads/tefa/kegiatan/' . $data->id . '/' . $item->detail) }}" is_edit="{{ $key > 0 ? true : false }}" />
                            @empty
                                <input type="hidden" name="kegiatan_id[]" id="" value="">
                                <x-form-components.input-file class="kegiatan" name="kegiatan[]" id="kegiatan" />
                            @endforelse
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
                            @forelse ($data->produkTefa as $key => $item)
                                <input type="hidden" name="produk_id[]" id="" value="{{ $item->id }}">
                                <x-form-components.input-file class="produk-{{ $key+1 }}" data_id="{{ $item->id }}" name="produk[]" id="produk-{{ $key+1 }}" img_src="{{ asset('uploads/tefa/produk/' . $data->id . '/' . $item->detail) }}" is_edit="{{ $key > 0 ? true : false }}" />
                            @empty
                                <input type="hidden" name="produk_id[]" id="" value="">
                                <x-form-components.input-file class="produk" name="produk[]" id="produk" />
                            @endforelse
                            {{-- <x-form-components.input-file name="produk[]" id="produk" id="btnProduk"/> --}}
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
                            @forelse ($data->fasilitasTefa as $key => $item)
                                <input type="hidden" name="fasilitas_id[]" id="" value="{{ $item->id }}">
                                <x-form-components.input-file class="fasilitas-{{ $key+1 }}" data_id="{{ $item->id }}" name="fasilitas[]" id="fasilitas-{{ $key+1 }}" img_src="{{ asset('uploads/tefa/fasilitas/' . $data->id . '/' . $item->detail) }}" is_edit="{{ $key > 0 ? true : false }}" />
                            @empty
                                <input type="hidden" name="fasilitas_id[]" id="" value="">
                                <x-form-components.input-file class="fasilitas" name="fasilitas[]" id="fasilitas" />
                            @endforelse
                            {{-- <x-form-components.input-file name="fasilitas[]" id="fasilitas" /> --}}
                        </div>
                    </div>
                </div>
            </div>
        </x-default-card>
    </form>
@endsection

@push('scripts')
    <script>
        let idDelete = []
        function deleteForm (element) {
            let parentElement = $(`${element}`).parent().parent()
            if (parentElement.data('edit') === 1 || parentElement.data('edit') === '1') {
                idDelete.push(parentElement.data('id'))
                $("input[name=delete_tefa_id]").val(idDelete)
            }
            
            $(`${element}`).parent().parent().remove()
        }

        $(document).ready(() => {
            let countKegiatan = parseInt("{{ $data->kegiatanTefa != [] ? count($data->kegiatanTefa) : 0 }}"), countProduk = parseInt("{{ $data->produkTefa != [] ? count($data->produkTefa) : 0 }}"), countFasilitas = parseInt("{{ $data->fasilitasTefa != [] ? count($data->fasilitasTefa) : 0 }}");
            
            $("#btnKegiatan").on('click', () => {
                countKegiatan += 1;
                $(".card-kegiatan").append(`
                    <div class="mb-3 kegiatan-${countKegiatan}" data-count="${countKegiatan}" data-edit="0">
                        <input type="hidden" name="kegiatan_id[]" id="" value="">
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
                        <input type="hidden" name="produk_id[]" id="" value="">
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
                        <input type="hidden" name="fasilitas_id[]" id="" value="">
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