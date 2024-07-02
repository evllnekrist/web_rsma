<?php

namespace App\Http\Controllers;
use App\Models\Option;

class CMSController extends Controller
{
    // -------------------- START::post --------------------
    public function postPrepare(){
        $object = 'post';
        $coll['type']   = Option::where('type','POST_TYPE')->get();
        $coll['status'] = Option::where('type','POST_STATUS')->get();

        return [
            'object'=>$object,
            'pk'=>app('App\Models\\'.$object)->getKeyName(),
            'breadcrumbs'=>[
                ['label'=>'Post','route'=>route('cms.'.$object)],
            ],
            'btn_add'=>[
                'link'=>url('cms/'.$object.'/add'),
            ],
            'columns'=>[
                [
                    'type'=>'seq_number',
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
                    'label'=>'Tipe',
                    'var_name'=>'type',
                    'is_order'=>true,
                    'search'=>[
                        'type'=>'text'
                    ],
                ],
                [
                    'label'=>'Judul',
                    'var_name'=>'title',
                    'is_order'=>true,
                    'search'=>[
                        'type'=>'text'
                    ],
                ],
                [
                    'label'=>'Kata Kunci',
                    'var_name'=>'keywords',
                    'is_order'=>true,
                    'search'=>[
                        'type'=>'text'
                    ],
                ],
                [
                    'type'=>'action',
                    'label'=>'Aksi',
                    'var_name'=>'id',
                ],
            ],
            'inputs'=> [
                [
                    [
                        'label'=>'Tipe',
                        'var_name'=>'type',
                        'type'=>'select',
                        'select_attr'=>[
                            'options'=>$coll['type'],
                            'id'=>'value',
                            'label'=>'label',
                        ],
                        'is_required'=>true,
                    ],
                    [
                        'label'=>'Status',
                        'var_name'=>'status',
                        'type'=>'select',
                        'select_attr'=>[
                            'options'=>$coll['status'],
                            'id'=>'value',
                            'label'=>'label',
                        ],
                        'value'=>'submitted',
                        'is_required'=>true,
                        'is_hidden'=>true,
                    ],
                    [
                        'label'=>'Judul',
                        'var_name'=>'title',
                        'type'=>'text',
                        'class'=>'convert-to-slug',
                        'el_data'=> [
                            'affects_to'=>'slug'
                        ],
                        'is_required'=>true,
                    ],
                    [
                        'label'=>'Slug',
                        'sublabel'=>'<i>auto-generated</i> berdasarkan judul',
                        'var_name'=>'slug',
                        'type'=>'text',
                        'is_readonly'=>true,
                        'is_required'=>true,
                    ],
                    [
                        'label'=>'Kata Kunci',
                        'sublabel'=>'enter setelah menulis untuk menambahkan kata kunci baru',
                        'var_name'=>'keywords[]',
                        'type'=>'select',
                        'select_attr'=>[
                            'options'=>[],
                            'id'=>'value',
                            'label'=>'label',
                            'is_tags'=>true
                        ],
                    ],
                    [
                        'label'=>'Konten',
                        'var_name'=>'content',
                        'type'=>'editor',
                    ],
                ],
                [
                    [
                        'label'=>'Foto',
                        'var_name'=>'img_main',
                        'type'=>'file',
                    ],
                    [
                        'label'=>'Caption Foto',
                        'var_name'=>'caption',
                        'type'=>'textarea',
                        'height'=>'70px'
                    ],
                ],
            ],
        ];
    } 

    public function postIndex(){
        $data = $this->postPrepare();
        $data['breadcrumbs'][1] = ['label'=>'Daftar Data'];
        return view('cms.post.index',['page_conf'=>$data]);
    } 

    public function postAdd(){
        $data = $this->postPrepare();
        $data['breadcrumbs'][1] = ['label'=>'Tambah'];
        return view('cms.post.add',['page_conf'=>$data]);
    }  

    public function postEdit($id){
        $data = $this->postPrepare();
        $data['breadcrumbs'][1] = ['label'=>'Edit'];
        $data['selected'] = ('App\Models\Post')::find($id);
        $data['id'] = $id;
        return view('cms.post.edit',['page_conf'=>$data]);
    }      
    // ---------------------- END::org --------------------
    // -------------------- START::org --------------------
    public function orgPrepare(){
        $object = 'org';
        return [
            'object'=>$object,
            'pk'=>app('App\Models\\'.$object)->getKeyName(),
            'breadcrumbs'=>[
                ['label'=>'Struktur Organisasi','route'=>route('cms.'.$object)],
            ],
            'btn_add'=>[
                'link'=>url('cms/'.$object.'/add'),
            ],
            'columns'=>[
                [
                    'type'=>'seq_number',
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
                    'label'=>'Superior',
                    'var_name'=>'parent_id',
                    'is_order'=>true,
                    'search'=>[
                        'type'=>'number'
                    ],
                ],
                [
                    'type'=>'action',
                    'label'=>'Aksi',
                    'var_name'=>'id',
                ],
            ],
            'inputs'=> [
                [
                    [
                        'label'=>'Superior',
                        'var_name'=>'parent_id',
                        'type'=>'select',
                        'select_attr'=>[
                            'options'=>[],
                            'id'=>'id',
                            'label'=>'name',
                        ]
                    ],
                    [
                        'label'=>'Nama',
                        'var_name'=>'name',
                        'type'=>'text',
                    ],
                    [
                        'label'=>'NIP',
                        'var_name'=>'nip',
                        'type'=>'text',
                        'max'=>20,
                    ],
                    [
                        'label'=>'Jabatan',
                        'var_name'=>'job_title',
                        'type'=>'text',
                        'is_required'=>true,
                    ],
                    // [
                    //     'label'=>'Judul Deskripsi',
                    //     'var_name'=>'desc_title',
                    //     'type'=>'text',
                    // ],
                    // [
                    //     'label'=>'Isi Deskripsi',
                    //     'var_name'=>'desc_body',
                    //     'type'=>'textarea',
                    // ],
                ],
                [
                    [
                        'label'=>'Foto',
                        'var_name'=>'img_main',
                        'type'=>'file',
                    ],
                ],
            ],
        ];
    } 

    public function orgIndex(){
        $data = $this->orgPrepare();
        $data['breadcrumbs'][1] = ['label'=>'Daftar Data'];
        return view('cms.org.index',['page_conf'=>$data]);
    } 

    public function orgAdd(){
        $data = $this->orgPrepare();
        $data['breadcrumbs'][1] = ['label'=>'Tambah'];
        return view('cms.org.add',['page_conf'=>$data]);
    }  

    public function orgEdit($id){
        $data = $this->orgPrepare();
        $data['breadcrumbs'][1] = ['label'=>'Edit'];
        $data['selected'] = ('App\Models\Org')::find($id);
        $data['id'] = $id;
        return view('cms.org.edit',['page_conf'=>$data]);
    }      
    // ---------------------- END::org --------------------
}
