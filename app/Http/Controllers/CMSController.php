<?php

namespace App\Http\Controllers;
use App\Models\Option;

class CMSController extends Controller
{
    // -------------------- START::page --------------------
        public function pagePrepare(){
            $object = 'page';
            $coll['layout']   = Option::where('type','PAGE_LAYOUT_FORMAT')->get();

            return [
                'object'=>$object,
                'pk'=>app('App\Models\Page')->getKeyName(),
                'breadcrumbs'=>[
                    ['label'=>'Halaman','route'=>route('cms.'.$object)],
                ],
                'btn_add'=>[
                    'link'=>url('cms/'.$object.'/add'),
                ],
                'no_delete_items'=>['services','service-flow','poly-schedule','contact-us','bpjs-info','about-us'],
                'columns'=>[
                    [
                        'type'=>'seq_number',
                        'label'=>'No',
                        'var_name'=>'id',
                        'is_order'=>true,
                    ],
                    [
                        'label'=>'Slug (alamat URL)',
                        'var_name'=>'slug',
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
                        'label'=>'Layout (tata letak)',
                        'var_name'=>'layout',
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
                            'label'=>'Layout (tata letak)',
                            'var_name'=>'layout',
                            'type'=>'select',
                            'select_attr'=>[
                                'options'=>$coll['layout'],
                                'id'=>'value',
                                'label'=>'label',
                            ],
                            'is_required'=>true,
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
                            'sublabel'=>'<span class="text-warning">tidak dapat diubah pada saat edit</span>',
                            'var_name'=>'slug',
                            'type'=>'text',
                            'class'=>'nospace_rw_hypen lowercase',
                            'is_required'=>true,
                            'on_edit'=>[
                                'is_readonly'=>true 
                            ]
                        ],
                        [
                            'label'=>'Editor',
                            'var_name'=>'body',
                            'type'=>'editor',
                        ],
                    ],
                    [
                        [
                            'label'=>'Foto',
                            'var_name'=>'img_main',
                            'type'=>'file',
                            'file_attr'=>[
                                'accept'=>'img'
                            ]
                        ],
                        [
                            'label'=>'File (PDF)',
                            'var_name'=>'file_main',
                            'type'=>'file',
                            'file_attr'=>[
                                'accept'=>'doc'
                            ]
                        ],
                    ],
                ],
            ];
        } 

        public function pageIndex(){
            $data = $this->pagePrepare();
            $data['breadcrumbs'][1] = ['label'=>'Daftar Data'];
            return view('cms.default.index',['page_conf'=>$data]);
        } 

        public function pageAdd(){
            $data = $this->pagePrepare();
            $data['breadcrumbs'][1] = ['label'=>'Tambah'];
            return view('cms.default.add',['page_conf'=>$data]);
        }  

        public function pageEdit($id){
            $data = $this->pagePrepare();
            $data['breadcrumbs'][1] = ['label'=>'Edit'];
            $data['selected'] = ('App\Models\Page')::find($id);
            $data['id'] = $id;
            return view('cms.default.edit',['page_conf'=>$data]);
        }      
    // ---------------------- END::page --------------------
    // -------------------- START::post --------------------
        public function postPrepare(){
            $object = 'post';
            $coll['type']   = Option::where('type','POST_TYPE')->get();
            $coll['status'] = Option::where('type','POST_STATUS')->get();

            return [
                'object'=>$object,
                'pk'=>app('App\Models\Post')->getKeyName(),
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
                            'file_attr'=>[
                                'accept'=>'img'
                            ]
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
            return view('cms.default.index',['page_conf'=>$data]);
        } 

        public function postAdd(){
            $data = $this->postPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Tambah'];
            return view('cms.default.add',['page_conf'=>$data]);
        }  

        public function postEdit($id){
            $data = $this->postPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Edit'];
            $data['selected'] = ('App\Models\Post')::find($id);
            $data['id'] = $id;
            return view('cms.default.edit',['page_conf'=>$data]);
        }      
    // ---------------------- END::post --------------------
    // -------------------- START::resourceSummary --------------------
        public function resourceSummaryPrepare(){
            $object = 'resourceSummary';
            $coll['type']   = Option::where('type','RESOURCE_TYPE')->get();

            return [
                'object'=>$object,
                'pk'=>app('App\Models\ResourceSummary')->getKeyName(),
                'breadcrumbs'=>[
                    ['label'=>'Ikhtisar Sumber Daya','route'=>route('cms.'.$object)],
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
                        'label'=>'Tipe',
                        'var_name'=>'type',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                    [
                        'label'=>'Label Kategori Sumber Daya',
                        'var_name'=>'key_label',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                    [
                        'label'=>'Jumlah',
                        'var_name'=>'amount',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'number'
                        ],
                    ],
                    [
                        'label'=>'Deskripsi',
                        'var_name'=>'description',
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
                            'label'=>'Label Kategori Sumber Daya',
                            'var_name'=>'key_label',
                            'type'=>'text',
                            'class'=>'convert-to-slug',
                            'el_data'=> [
                                'affects_to'=>'key'
                            ],
                            'is_required'=>true,
                        ],
                        [
                            'label'=>'Kunci Kategori Sumber Daya',
                            'var_name'=>'key',
                            'type'=>'text',
                            'class'=>'nospace_rw_hypen lowercase',
                            'is_required'=>true,
                        ],
                        [
                            'label'=>'Jumlah',
                            'var_name'=>'amount',
                            'type'=>'number',
                            'is_required'=>true,
                        ],
                    ],
                    [
                        [
                            'label'=>'Deskripsi',
                            'var_name'=>'description',
                            'type'=>'textarea',
                            'height'=>'70px'
                        ],
                    ],
                ],
            ];
        } 

        public function resourceSummaryIndex(){
            $data = $this->resourceSummaryPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Daftar Data'];
            return view('cms.default.index',['page_conf'=>$data]);
        } 

        public function resourceSummaryAdd(){
            $data = $this->resourceSummaryPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Tambah'];
            return view('cms.default.add',['page_conf'=>$data]);
        }  

        public function resourceSummaryEdit($id){
            $data = $this->resourceSummaryPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Edit'];
            $data['selected'] = ('App\Models\ResourceSummary')::find($id);
            $data['id'] = $id;
            return view('cms.default.edit',['page_conf'=>$data]);
        }      
    // ---------------------- END::resourceSummary --------------------
    // -------------------- START::resourceDetail --------------------
        public function resourceDetailPrepare(){
            $object         = 'resourceDetail';
            $coll['key']    = ('App\Models\ResourceSummary')::select('key','key_label')->get();
            // dd($coll['key']);
            return [
                'object'=>$object,
                'pk'=>app('App\Models\ResourceDetail')->getKeyName(),
                'breadcrumbs'=>[
                    ['label'=>'Detail Sumber Daya','route'=>route('cms.'.$object)],
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
                        'label'=>'Kategori Sumber Daya',
                        'var_name'=>'key',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
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
                        'label'=>'Deskripsi',
                        'var_name'=>'description',
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
                            'label'=>'Kategori Sumber Daya',
                            'var_name'=>'key',
                            'type'=>'select',
                            'select_attr'=>[
                                'options'=>$coll['key'],
                                'id'=>'key',
                                'label'=>'key_label',
                            ],
                            'is_required'=>true,
                        ],
                        [
                            'label'=>'Nama',
                            'var_name'=>'name',
                            'type'=>'text',
                            'class'=>'convert-to-slug',
                            'el_data'=> [
                                'affects_to'=>'key'
                            ],
                            'is_required'=>true,
                        ],
                        [
                            'label'=>'Deskripsi',
                            'var_name'=>'description',
                            'type'=>'textarea',
                            'height'=>'70px'
                        ],
                    ],
                    [
                        [
                            'label'=>'Foto',
                            'var_name'=>'img_main',
                            'type'=>'file',
                            'file_attr'=>[
                                'accept'=>'img'
                            ]
                        ],
                    ],
                ],
                'custom_inputs' => [
                    [
                        'label'=>'Jadwal',
                        'api_method'=>'POST',
                        'api_url'=>url('api/'.$object.'/schedule'),
                        'type'=>'schedule',
                        'is_required'=>false,
                    ],
                ]
            ];
        } 

        public function resourceDetailIndex(){
            $data = $this->resourceDetailPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Daftar Data'];
            return view('cms.default.index',['page_conf'=>$data]);
        } 

        public function resourceDetailAdd(){
            $data = $this->resourceDetailPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Tambah'];
            return view('cms.default.add',['page_conf'=>$data]);
        }  

        public function resourceDetailEdit($id){
            $data = $this->resourceDetailPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Edit'];
            $data['selected'] = ('App\Models\ResourceDetail')::with(['schedule'])->find($id);
            $data['id'] = $id;
            return view('cms.default.edit',['page_conf'=>$data]);
        }      
    // ---------------------- END::resourceSummary --------------------
    // -------------------- START::org --------------------
        public function orgPrepare(){
            $object = 'org';
            $coll['superior'] = ('App\Models\Org')::select('id','name','job_title')->get();
            return [
                'object'=>$object,
                'pk'=>app('App\Models\Org')->getKeyName(),
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
                        'var_name'=>'pid',
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
                            'var_name'=>'pid',
                            'type'=>'select',
                            'select_attr'=>[
                                'options'=>$coll['superior'],
                                'id'=>'id',
                                'label'=>['name','job_title'],
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
                            'file_attr'=>[
                                'accept'=>'img'
                            ]
                        ],
                    ],
                ],
            ];
        } 

        public function orgIndex(){
            $data = $this->orgPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Daftar Data'];
            return view('cms.default.index',['page_conf'=>$data]);
        } 

        public function orgAdd(){
            $data = $this->orgPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Tambah'];
            return view('cms.default.add',['page_conf'=>$data]);
        }  

        public function orgEdit($id){
            $data = $this->orgPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Edit'];
            $data['selected'] = ('App\Models\Org')::find($id);
            $data['id'] = $id;
            return view('cms.default.edit',['page_conf'=>$data]);
        }      
    // ---------------------- END::org --------------------
    // -------------------- START::satisfaction --------------------
        public function satisfactionPrepare(){
            $object = 'satisfaction';
            return [
                'object'=>$object,
                'pk'=>app('App\Models\Satisfaction')->getKeyName(),
                'breadcrumbs'=>[
                    ['label'=>'Survey Kepuasan','route'=>route('cms.'.$object)],
                ],
                'columns'=>[
                    [
                        'type'=>'seq_number',
                        'label'=>'No',
                        'var_name'=>'id',
                        'is_order'=>true,
                    ],
                    [
                        'label'=>'Bintang',
                        'var_name'=>'star',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'number'
                        ],
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
                        'label'=>'Email',
                        'var_name'=>'email',
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
                        'label'=>'Deskripsi',
                        'var_name'=>'description',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                ],
            ];
        } 

        public function satisfactionIndex(){
            $data = $this->satisfactionPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Daftar Data'];
            return view('cms.default.index',['page_conf'=>$data]);
        }    
    // ---------------------- END::org --------------------
    // -------------------- START::user --------------------
        public function userPrepare(){
            $object = 'user';
            return [
                'object'=>$object,
                'pk'=>app('App\Models\User')->getKeyName(),
                'breadcrumbs'=>[
                    ['label'=>'User','route'=>route('cms.'.$object)],
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
                        'label'=>'Nama',
                        'var_name'=>'name',
                        'is_order'=>true,
                        'search'=>[
                            'type'=>'text'
                        ],
                    ],
                    [
                        'label'=>'Email',
                        'var_name'=>'email',
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
                            'label'=>'Nama',
                            'var_name'=>'name',
                            'type'=>'text',
                            'is_required'=>true,
                        ],
                        [
                            'label'=>'Email',
                            'var_name'=>'email',
                            'type'=>'email',
                            'is_required'=>true,
                        ],
                        [
                            'label'=>'Password',
                            'var_name'=>'password',
                            'type'=>'password',
                            'is_required'=>true,
                        ],
                    ],
                    []
                ],
            ];
        } 

        public function userIndex(){
            $data = $this->userPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Daftar Data'];
            return view('cms.default.index',['page_conf'=>$data]);
        } 

        public function userAdd(){
            $data = $this->userPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Tambah'];
            return view('cms.default.add',['page_conf'=>$data]);
        }  

        public function userEdit($id){
            $data = $this->userPrepare();
            $data['breadcrumbs'][1] = ['label'=>'Edit'];
            $data['selected'] = ('App\Models\User')::find($id);
            $data['id'] = $id;
            return view('cms.default.edit',['page_conf'=>$data]);
        }      
    // ---------------------- END::user --------------------
}
