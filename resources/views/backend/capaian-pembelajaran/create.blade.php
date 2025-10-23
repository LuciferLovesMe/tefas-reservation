@extends('layouts.layout')

@section('content')
    <form action="{{ route('capaian-pembelajaran.store') }}" method="post" enctype="multipart/form-data">
        <x-default-card :isForm="true" :title="['Capaian Pembelajaran', 'Tambah']">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <x-form-components.input-text name="nama" id="nama"/>
                </div>
            </div>
        </x-default-card>
    </form>
@endsection
