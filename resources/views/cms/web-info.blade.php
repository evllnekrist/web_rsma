@extends('layouts.app-cms', $page_conf)
@section('title', 'Pengaturan Informasi Web')
@section('content')
{{-- CONTENT::START --}}
@php
    dump($selected);
    // die();
@endphp
    <section class="fun-fact-section-two">
        <div class="auto-container">

            <form action="#" method="post" id="form-edit">
                <div class="row justify-content-center">

                    <div class="col-md-6 col-sm-12">
                        <div class="appointment-form default-form">
                            @php
                                $filename   = strtolower(array_reverse(explode("/",asset($selected['logo']['img_main'])))[0]);  
                            @endphp
                            <div class="form-group">
                                <b class="text-muted small">Logo</b>
                                <div class="upload-wrapper">
                                    <div class="upload-container">
                                        <div class="upload-container-in">
                                            <div class="border-container-in">
                                                <div class="icons fa-4x mt-3 {{(@$selected['logo']['img_main']?'hidden':'')}}" id="input-file-none-0">
                                                    <i class="fas fa-file-image" data-fa-transform="shrink-3 down-2 left-6 rotate--45"></i>
                                                    <i class="fas fa-file-alt" data-fa-transform="shrink-2 up-4"></i>
                                                    <i class="fas fa-file-pdf" data-fa-transform="shrink-3 down-2 right-6 rotate-45"></i>
                                                </div>
                                                <div class="mx-auto mb-1" id="input-file-preview-0">
                                                    @if(@$selected['logo']['img_main'])
                                                        <img src="{{asset($selected['logo']['img_main'])}}" style="height:200px">
                                                        <br><small>{{$filename}}</small>
                                                    @endif
                                                </div>
                                                <input type="file" id="file-upload" data-index-input-file="0" name="logo" class="input-file input-sm" >
                                                <p><small>Drag dan drop file, atau <a href="#" id="file-browser">cari disini</a>.</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="appointment-form default-form">  
                            <div class="form-group">
                                <b class="text-muted small">Deskripsi</b>
                                <textarea name="desc" id="wysiwyg-editor-0" class="wysiwyg-editor">{{$selected['desc']['description']}}</textarea>
                            </div> 
                            <div class="form-group">
                                <b class="text-muted small">Media Sosial</b>
                                <div class="row">
                                    <span class="col-2 text-muted small">FB</span>
                                    <input class="col-10" type="text" name="socmed_fb" value="{{$selected['socmed_fb']['value']}}">
                                </div>
                                <div class="row">
                                    <span class="col-2 text-muted small">Twitter</span>
                                    <input class="col-10" type="text" name="socmed_twitter" value="{{$selected['socmed_twitter']['value']}}">
                                </div>
                                <div class="row">
                                    <span class="col-2 text-muted small">IG</span>
                                    <input class="col-10" type="text" name="socmed_ig" value="{{$selected['socmed_ig']['value']}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <b class="text-muted small">Kontak: Telepon</b>
                                <input type="text" name="contact_phone" value="{{$selected['contact_phone']['value']}}">
                            </div>
                            <div class="form-group">
                                <b class="text-muted small">Kontak: Email</b>
                                <input type="email" name="contact_email" value="{{$selected['contact_email']['value']}}">
                            </div>
                            <div class="form-group">
                                <b class="text-muted small">Kontak: Alamat</b>
                                <textarea name="contact_address">{!!$selected['contact_address']['description']!!}</textarea>
                            </div>
                            <div class="form-group">
                                <b class="text-muted small">Jadwal Buka</b>
                                <div>
                                    <div>
                                        @php
                                            $schedule = json_decode($selected['schedule']['description']);
                                        @endphp
                                        <div id="data-schedule-wrap" data-count="{{is_array($schedule)||is_object($schedule)?sizeof($schedule):0}}">
                                            @if(is_array($schedule)||is_object($schedule))
                                            @for($i=0;$i<sizeof($schedule);$i++)
                                                <div class="row" id="schedule-item-{{$i}}">
                                                    <div class="form-group col-md-8">
                                                        <input type="text" name="schedule[]" value="{{@$schedule[$i]}}">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <center><a onclick="removeElement('schedule',{{$i}})"><req><i class="fas fa-trash"></i></req></a></center>
                                                    </div>
                                                </div>
                                            @endfor
                                            @endif
                                        </div>
                                    </table>
                                    <button class="theme-btn btn-style-four btn-block small schedule-open-form-btn"  type="button" title="Tambah" data-toggle="collapse" data-target="#form-add-schedule">
                                        <span class="btn-title"><i class="fas fa-plus"></i></span>
                                    </button>
                                    <div class="collapse" id="form-add-schedule">
                                    <div class="card card-body">  
                                        <div class="row">       
                                            <div class="form-group col-md-8">
                                                <input type="text" id="schedule-label" placeholder="label">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <center>
                                                    <button class="theme-btn btn-style-two small" id="schedule-add-btn" type="button">
                                                        <span class="btn-title">Tambahkan</span>
                                                    </button>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row justify-content-center">
                    
                    <div class="col-12">
                        <div class="appointment-form default-form mt-5">
                            <b class="text-muted small">Slider</b>
                            <div class="row" id="data-slider-wrap" data-count="{{sizeof($selected['sliders'])}}">
                                @php
                                    $slider_count = 0;
                                @endphp
                                @foreach($selected['sliders'] as $item)
                                @php                        
                                    $filename   = strtolower(array_reverse(explode("/",asset($item['img_main'])))[0]); 
                                @endphp
                                <div class="form-group col-md-4" id="slider-item-{{$slider_count}}">
                                    <div class="pull-left x-ear">
                                        <button type="button" class="close" aria-label="Close" onclick="removeElement('slider',{{$slider_count}})">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div> 
                                    <div class="upload-wrapper">
                                        <div class="upload-container">
                                            <div class="upload-container-in">
                                                <div class="border-container-in">
                                                    <div class="icons fa-4x mt-3 mb-5 {{(@$item['img_main']?'hidden':'')}}" id="input-file-none-slide-{{$slider_count}}">
                                                        <i class="fas fa-file-image" data-fa-transform="shrink-3 down-2 left-6 rotate--45"></i>
                                                        <i class="fas fa-file-alt" data-fa-transform="shrink-2 up-4"></i>
                                                        <i class="fas fa-file-pdf" data-fa-transform="shrink-3 down-2 right-6 rotate-45"></i>
                                                    </div>
                                                    <div class="mx-auto mb-1" id="input-file-preview-slide-{{$slider_count}}">
                                                        @if(@$item['img_main'])
                                                            <img src="{{asset($item['img_main'])}}" style="height:120px">
                                                            <br><small>{{$filename}}</small>
                                                        @endif
                                                    </div>
                                                    <input type="file" id="file-upload" data-index-input-file="slide-{{$slider_count}}" name="sliders[{{$slider_count}}][img_main]" class="input-file input-sm" >
                                                    <p class="mb-2"><small>Drag dan drop file, atau <a href="#" id="file-browser">cari disini</a>.</small></p>
                                                    <textarea class="textarea-compact" placeholder="Judul" name="sliders[{{$slider_count}}][label]">{{$item['label']}}</textarea>
                                                    <textarea class="textarea-compact" placeholder="Sub judul atas" name="sliders[{{$slider_count}}][value]">{{$item['value']}}</textarea>
                                                    <textarea class="textarea-compact" placeholder="Sub judul bawah" name="sliders[{{$slider_count}}][description]">{{$item['description']}}</textarea>
                                                    <input type="text" placeholder="Link tombol" name="sliders[{{$slider_count}}][value2]" value="{{$item['value2']}}" class="nospace_rw_hypen lowercase">
                                                    <input type="text" placeholder="ID" name="sliders[{{$slider_count}}][id]" value="{{$item['id']}}" hidden>
                                                    <span class="text-muted smaller">* isi, hanya jika, ingin bagian tersebut tampil</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                                @php
                                    $slider_count++;
                                @endphp
                                @endforeach
                            </div>
                            <div class="mt-3">
                                <center>
                                    <button class="theme-btn btn-style-four btn-block small" id="slider-add-btn" type="button">
                                        <span class="btn-title"><i class="fas fa-plus"></i></span>
                                    </button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    
                    <div class="col-12">
                        <div class="appointment-form default-form mt-5">
                            <b class="text-muted small">Link Terkait</b>
                            <div class="row" id="data-related-link-wrap" data-count="{{sizeof($selected['related_links'])}}">
                                @php
                                    $related_link_count = 0;
                                @endphp
                                @foreach($selected['related_links'] as $item)
                                @php                        
                                    $filename   = strtolower(array_reverse(explode("/",asset($item['img_main'])))[0]); 
                                @endphp
                                <div class="form-group col-md-4" id="related-link-item-{{$related_link_count}}">
                                    <div class="pull-left x-ear">
                                        <button type="button" class="close" aria-label="Close" onclick="removeElement('related-link',{{$related_link_count}})">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div> 
                                    <div class="upload-wrapper">
                                        <div class="upload-container">
                                            <div class="upload-container-in">
                                                <div class="border-container-in">
                                                    <div class="icons fa-4x mt-3 mb-5 {{(@$item['img_main']?'hidden':'')}}" id="input-file-none-related-link-{{$related_link_count}}">
                                                        <i class="fas fa-file-image" data-fa-transform="shrink-3 down-2 left-6 rotate--45"></i>
                                                        <i class="fas fa-file-alt" data-fa-transform="shrink-2 up-4"></i>
                                                        <i class="fas fa-file-pdf" data-fa-transform="shrink-3 down-2 right-6 rotate-45"></i>
                                                    </div>
                                                    <div class="mx-auto mb-1" id="input-file-preview-related-link-{{$related_link_count}}">
                                                        @if(@$item['img_main'])
                                                            <img src="{{asset($item['img_main'])}}" style="height:120px">
                                                            <br><small>{{$filename}}</small>
                                                        @endif
                                                    </div>
                                                    <input type="file" id="file-upload" data-index-input-file="related-link-{{$related_link_count}}" name="related_links[{{$slider_count}}][img_main]" class="input-file input-sm" >
                                                    <p class="mb-2"><small>Drag dan drop file, atau <a href="#" id="file-browser">cari disini</a>.</small></p>
                                                    <textarea class="textarea-compact" placeholder="Nama" name="related_links[{{$slider_count}}][label]">{{$item['label']}}</textarea>
                                                    <input type="text" placeholder="Link" name="related_links[{{$slider_count}}][value2]" value="{{$item['value2']}}" class="nospace_rw_hypen lowercase">
                                                    <input type="text" placeholder="ID" name="related_links[{{$slider_count}}][id]" value="{{$item['id']}}" hidden>
                                                    <span class="text-muted smaller">* isi, hanya jika, ingin bagian tersebut tampil</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                </div>
                                @php
                                    $related_link_count++;
                                @endphp
                                @endforeach
                            </div>
                            <div class="mt-3">
                                <center>
                                    <button class="theme-btn btn-style-four btn-block small" id="related-link-add-btn" type="button">
                                        <span class="btn-title"><i class="fas fa-plus"></i></span>
                                    </button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="auto-container">
    
            <center>
                <button class="theme-btn btn-style-one bg-tealblue mt-5" type="button" id="btn-submit-edit">
                    <span class="btn-title">Simpan Perubahan</span>
                </button>
            </center>
    
        </div>
    </section>
{{-- CONTENT::END   --}}
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('asset-cms/js/web-info.js')}}"></script>
@endsection