@extends('layouts.layout')

@section('content')
    <form action="{{ route('rule.store') }}" method="post" enctype="multipart/form-data">
        <x-default-card :isForm="true" title="Rule | Tambah">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <x-form-components.select name="jenjang" id="jenjang" :options="$jenjang"/>
                    <x-form-components.select name="jenis_kunjungan" id="jenis_kunjungan" :options="$jenisKunjungan"/>
                    <x-form-components.select name="aktivitas" id="aktivitas" :options="$aktivitas"/>
                    <x-form-components.select name="capaian_pembelajaran" id="capaian_pembelajaran" :options="$capaianPembelajaran"/>
                    <x-form-components.select name="tefa" id="tefa" :options="$tefa"/>
                </div>
            </div>
        </x-default-card>
    </form>
@endsection
