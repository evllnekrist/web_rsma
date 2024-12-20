
<section class="appointment-form-section" style="background-image: url({{asset('asset/images/background/honeycomb.png')}});">
    <div class="auto-container">

            <div class="sec-title">
                <a href="{{@$breadcrumbs[0]['route']}}" class="text-dark">{{$breadcrumbs[0]['label']}}&nbsp;&nbsp;</a>
                <b class="text-white"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;{{$breadcrumbs[1]['label']}}</b>
            </div>
            <form action="#" method="post" id="form-add" data-object="{{@$object}}" class="row">
                @php
                    $file_count = 0;
                @endphp
                @for($i=0;$i<sizeof($inputs);$i++)
                    <div class="col-md-{{12/sizeof($inputs)}} col-sm-12">
                        @if(sizeof($inputs[$i])>0)
                        <div class="appointment-form default-form">
                            @foreach ($inputs[$i] as $input)
                                <div class="form-group">
                                    @if(!@$input['is_hidden'])
                                    <div class="d-flex justify-content-between small">
                                        <span class="text-muted">{{$input['label']}} 
                                            @if(@$input['is_required'])
                                            <req>*</req> 
                                            @endif
                                        </span>
                                        @if(@$input['sublabel'])
                                            <span class="text-muted2">{!!$input['sublabel']!!}</span>
                                        @endif
                                    </div>
                                    @endif
                                    @switch($input['type'])
                                        @case('text')
                                            <input type="text" name="{{$input['var_name']}}" class="{{@$input['class']}}" placeholder="{{@$input['format']}}" 
                                                {{@$input['min']?'minlength='.$input['min']:''}} {{@$input['max']?'maxlength='.$input['max']:''}}
                                                {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}} {{@$input['is_hidden']?'hidden':''}}
                                                data-affects_to="{{@$input['el_data']['affects_to']}}">
                                            @break
                                        @case('number')
                                            <input type="number" name="{{$input['var_name']}}" class="{{@$input['class']}}" placeholder="{{@$input['format']}}" 
                                                {{@$input['min']?'min='.$input['min']:''}} {{@$input['max']?'max='.$input['max']:''}}
                                                {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}} {{@$input['is_hidden']?'hidden':''}}>
                                            @break
                                        @case('email')
                                            <input type="email" name="{{$input['var_name']}}" class="{{@$input['class']}}" placeholder="{{@$input['format']}}" 
                                                {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}} {{@$input['is_hidden']?'hidden':''}}>
                                            @break
                                        @case('password')
                                            <input type="password" name="{{$input['var_name']}}" class="{{@$input['class']}}" placeholder="{{@$input['format']}}" autocomplete="off"
                                                {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}} {{@$input['is_hidden']?'hidden':''}}>
                                            <input type="password" name="{{$input['var_name']}}_confirmation" class="{{@$input['class']}}" placeholder="Konfirmasi: tulis password yang sama" autocomplete="off">
                                            @break
                                        @case('textarea')
                                            <textarea name="{{$input['var_name']}}" class="{{@$input['class']}}" placeholder="{{@$input['format']}}" 
                                                {{@$input['is_required']?'required':''}} style="{{@$input['height']?'height:'.@$input['height']:''}}"></textarea>
                                            @break
                                        @case('editor')
                                            <textarea name="{{$input['var_name']}}" class="wysiwyg-editor {{@$input['class']}}" placeholder="{{@$input['format']}}" 
                                                {{@$input['is_required']?'required':''}}></textarea>
                                            @break
                                        @case('select')
                                            {{-- @php
                                                dump($input['select_attr']['options']);
                                            @endphp --}}
                                            <select class="{{@$input['is_hidden']?'hidden':(@$input['select_attr']['is_tags']?'form-select-tags':'form-select')}} {{@$input['class']}}" name="{{$input['var_name']}}" 
                                                {{@$input['select_attr']['is_tags']?'multiple="multiple"':''}}
                                                {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}}>
                                                <option></option>
                                                @if(is_array($input['select_attr']['label']))
                                                    @php
                                                        $label_sum      = sizeof($input['select_attr']['label']);
                                                    @endphp
                                                    @foreach ($input['select_attr']['options'] as $item)
                                                        <option value="{{$item[$input['select_attr']['id']]}}"
                                                            {{$item[$input['select_attr']['id']]==@$input['value']?'selected':''}}>
                                                            @for($label_idx=0;$label_idx<$label_sum;$label_idx++)
                                                                {{$item[$input['select_attr']['label'][$label_idx]]}}
                                                                @if($label_idx < $label_sum-1 && $item[$input['select_attr']['label'][$label_idx]] != '')
                                                                    &nbsp;-&nbsp; 
                                                                @endif
                                                            @endfor
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($input['select_attr']['options'] as $item)
                                                        <option value="{{$item[$input['select_attr']['id']]}}"
                                                            {{$item[$input['select_attr']['id']]==@$input['value']?'selected':''}}>
                                                            {{$item[$input['select_attr']['label']]}}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @break
                                        @case('file')
                                            <div class="upload-wrapper">
                                                <div class="upload-container" data-index="{{$file_count}}">
                                                    <div class="upload-container-in">
                                                        <div class="border-container-in">
                                                            <div class="icons fa-4x mt-3" id="input-file-none-{{$file_count}}">
                                                                <i class="fas fa-file-image" data-fa-transform="shrink-3 down-2 left-6 rotate--45"></i>
                                                                <i class="fas fa-file-alt" data-fa-transform="shrink-2 up-4"></i>
                                                                <i class="fas fa-file-pdf" data-fa-transform="shrink-3 down-2 right-6 rotate-45"></i>
                                                            </div>
                                                            <div class="flex flex-auto mx-auto" id="input-file-preview-{{$file_count}}">
                                                            </div>
                                                            <input  type="file" class="input-file" id="input-file-el-{{$file_count}}" data-index-input-file="{{$file_count}}" 
                                                                    name="{{$input['var_name']}}" accept="{{@$input['file_attr']['accept']?implode(',',Config::get('app.accept_mimes')[$input['file_attr']['accept']]):''}}" {{@$input['is_required']?'required':''}}>
                                                            <p>
                                                                <small>
                                                                    Drag dan drop file, atau <a href="#" class="file-browser" data-index-input-file="{{$file_count}}">cari disini</a>.
                                                                </small>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $file_count++;
                                            @endphp
                                            @break
                                    @endswitch
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                @endfor
            </form>
            
    </div>
</section>
<section class="services-section-two">
    <div class="auto-container">

        <form action="#" method="post" enctype="multipart/form-data" id="form-add-custom" data-object="{{@$object}}">
            @if(@$custom_inputs) 
                <textarea id="custom-inputs" hidden>{{json_encode($custom_inputs)}}</textarea>           
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <div class="appointment-form default-form">                    
                            @for($i=0;$i<sizeof($custom_inputs);$i++)
                                @switch($custom_inputs[$i]['type'])
                                    @case('schedule')
                                    @php 
                                        $days = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
                                    @endphp
                                    {{-- basic schedule, by day --}}
                                        <table width="100%" class="text-center table table-striped table-responsive">
                                            <thead>
                                                <tr>
                                                    @foreach ($days as $day)
                                                        <td>{{$day}}</td>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @for($day_idx=0;$day_idx<sizeof($days);$day_idx++)
                                                        <td id="schedule-day-{{$day_idx}}-wrap" data-count="0">
                                                            <div id="schedule-day-{{$day_idx}}"></div>
                                                            <center>
                                                                <button class="theme-btn btn-style-four small schedule-open-form-btn" data-day-idx="{{$day_idx}}" type="button" title="Tambah Jadwal" data-toggle="collapse" data-target="#form-add-schedule">
                                                                    <span class="btn-title"><i class="fas fa-plus"></i></span>
                                                                </button>
                                                            </center>
                                                        </td>
                                                    @endfor
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="collapse mt-5" id="form-add-schedule">
                                          <div class="card card-body">  
                                            <h6>Jadwal Hari <span id="schedule-draft-day" class="theme-color">Senin</span></h6>
                                            <div class="row mt-5">       
                                                <div class="form-group col-md-4">
                                                    <div class="d-flex justify-content-between small">
                                                        <span class="text-muted">Dari <req>*</req></span>
                                                    </div>
                                                    <input type="time" id="schedule-draft-from">  
                                                </div>       
                                                <div class="form-group col-md-4">
                                                    <div class="d-flex justify-content-between small">
                                                        <span class="text-muted">Hingga <req>*</req></span>
                                                    </div>
                                                    <input type="time" id="schedule-draft-to">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <center>
                                                        <button class="theme-btn btn-style-two small" id="schedule-add-btn" date-day-idx="0" type="button">
                                                            <span class="btn-title">Tambahkan</span>
                                                        </button>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                @endswitch
                            @endfor
                        </div>
                    </div>
                </div>
            @endif
        </form>
            
    </div>
    <div class="auto-container">

        <center>
            <button class="theme-btn btn-style-one bg-tealblue mt-5" type="button" id="btn-submit-add">
                <span class="btn-title">Simpan</span>
            </button>
        </center>

    </div>
</section>