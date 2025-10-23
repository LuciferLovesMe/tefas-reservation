@extends('layouts.layout')

@section('content')
    <form action="{{ route('capaian-pembelajaran.update', $data->id) }}" method="post" enctype="multipart/form-data">
        <x-default-card :isForm="true" :title="['Capaian Pembelajaran', 'Ubah']">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <x-form-components.input-text name="nama" id="nama" value="{{ $data->nama }}"/>
                </div>
            </div>
        </x-default-card>
    </form>
@endsection
