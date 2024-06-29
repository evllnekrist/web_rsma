@php
    $page_conf =  ['breadcrumbs'=>[['label'=>'Struktur Organisasi'],['label'=>'Tambah']]];
@endphp
@extends('layouts.app-cms', $page_conf)
@section('title', 'Tambah')
@section('content')
    @php
        $page_conf['inputs'] = [
            [
                [
                    'label'=>'Nama',
                    'var_name'=>'name',
                    'type'=>'text',
                ],
                [
                    'label'=>'Jabatan',
                    'var_name'=>'job_title',
                    'type'=>'text',
                ],
                [
                    'label'=>'Judul Deskripsi',
                    'var_name'=>'desc_title',
                    'type'=>'text',
                ],
                [
                    'label'=>'Isi Deskripsi',
                    'var_name'=>'desc_body',
                    'type'=>'textarea',
                ],
            ],
            [
                [
                    'label'=>'Foto',
                    'var_name'=>'img_main',
                    'type'=>'file',
                ],
            ],
        ]; 
    @endphp
    @include('components.extra.form-add', $page_conf)
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('cms/js/form.js').'?v='.date('YmdH').'1' }}"></script>
@endsection