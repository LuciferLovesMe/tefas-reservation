@extends('layouts.layout')

@section('content')
    <form action="{{ route('reservasi.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-default-card :isForm="true" title="Reservasi | Tambah">
            <div class="row">
                <div class="col">
                    <x-form-components.input-datetime name="jadwal_mulai" id="jadwal_mulai" />
                    <x-form-components.input-datetime name="jadwal_berakhir" id="jadwal_berakhir" />
                    <x-form-components.input-number name="jumlah_peserta" id="jumlah_peserta" />
                    <x-form-components.select name="ruangan" id="ruangan" :options="$ruanganOptions" />
                    <x-form-components.select name="tefa" id="tefa" :options="$tefaOptions" />
                </div>
            </div>
            
        </x-default-card>
    </form>
@endsection