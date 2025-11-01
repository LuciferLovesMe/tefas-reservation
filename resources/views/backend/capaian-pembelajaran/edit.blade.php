@extends('layouts.layout')

@section('content')
    <form action="{{ route('capaian-pembelajaran.update', $data->id) }}" method="post" enctype="multipart/form-data">
        <x-default-card :isForm="true" :title="['Capaian Pembelajaran', 'Ubah']">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <x-form-components.select name="aktivitas" id="aktivitas" :options="$aktivitasPembelajaran" :value="old('aktivitas', $data->aktivitas_id)"/>
                    <x-form-components.select name="jenjang" id="jenjang" :options="array_combine($jenjang, $jenjang)" :value="old('jenjang', convertJenjangToId($data->jenjang))"/>
                    <x-form-components.input-text name="nama" id="nama" value="{{ old('nama', $data->nama) }}"/>
                </div>
            </div>
        </x-default-card>
    </form>
@endsection
