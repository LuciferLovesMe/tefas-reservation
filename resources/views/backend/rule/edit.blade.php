@extends('layouts.layout')

@section('content')
    <form action="{{ route('rule.update', $data->id) }}" method="post" enctype="multipart/form-data">
        <x-default-card :isForm="true" title="Rule | Tambah">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <x-form-components.select name="jenjang" id="jenjang" :options="$jenjang" :value="convertJenjangToId($data->jenjang)" />
                    <x-form-components.select name="jenis_kunjungan" id="jenis_kunjungan" :options="$jenisKunjungan" :value="$data->jenis_kunjungan_id" />
                    <x-form-components.select name="aktivitas" id="aktivitas" :options="$aktivitas" :value="$data->aktivitas_id" />
                    <x-form-components.select name="capaian_pembelajaran" id="capaian_pembelajaran" :options="$capaianPembelajaran" :value="$data->capaian_pembelajaran_id" />
                    <x-form-components.select name="tefa" id="tefa" :options="$tefa" :value="$data->tefa_id" />
                </div>
            </div>
        </x-default-card>
    </form>
@endsection
