@extends('layouts.app-cms', ['breadcrumbs'=>[['label'=>'Struktur Organisasi'],['label'=>'Daftar Data']]])
@section('title', 'Struktur Organisasi')
@section('content')

<div class="row justify-content-center">
    <div class="col-auto">
        @include('components.extra.table', 
            [
                'btn_add'=> [
                    'link' => url('/cms/org/add'),
                ],
                'columns'=> [
                    [
                        'label'=>'No',
                        'var_name'=>'id',
                        'is_order'=>true,
                    ],
                    [
                        'label'=>'Gambar',
                        'var_name'=>'img_main',
                        'is_order'=>false,
                    ],
                    [
                        'label'=>'Nama',
                        'var_name'=>'name',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                    [
                        'label'=>'Jabatan',
                        'var_name'=>'job_title',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                    [
                        'label'=>'Atasan',
                        'var_name'=>'parent_id',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'number'
                        ],
                    ],
                    [
                        'label'=>'Aksi',
                        'var_name'=>'id',
                        'type'=>'action',
                    ],
                ]
            ]
        )
    </div>
</div>
    
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('cms/js/org.js').'?v='.date('YmdH').'1' }}"></script>
@endsection