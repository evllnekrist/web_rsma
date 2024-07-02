<section class="appointment-form-section" style="background-image: url({{asset('asset/images/background/honeycomb.png')}});">
    <div class="auto-container">

            <div class="sec-title">
                <a href="{{@$breadcrumbs[0]['route']}}" class="text-dark">{{$breadcrumbs[0]['label']}}&nbsp;&nbsp;</a>
                <b class="text-white"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;{{$breadcrumbs[1]['label']}}</b>
            </div>
            <form action="#" method="post" id="form-edit" data-object="{{@$object}}" data-id="{{$id}}" class="row">
                @for($i=0;$i<sizeof($inputs);$i++)
                    <div class="col-md-{{12/sizeof($inputs)}} col-sm-12">
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
                                                data-affects_to="{{@$input['el_data']['affects_to']}}" value="{{$selected[$input['var_name']]}}">
                                            @break
                                        @case('number')
                                            <input type="number" name="{{$input['var_name']}}" class="{{@$input['class']}}" placeholder="{{@$input['format']}}" 
                                                {{@$input['min']?'min='.$input['min']:''}} {{@$input['max']?'max='.$input['max']:''}}
                                                {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}} {{@$input['is_hidden']?'hidden':''}}
                                                value="{{$selected[$input['var_name']]}}">
                                            @break
                                        @case('email')
                                            <input type="email" name="{{$input['var_name']}}" class="{{@$input['class']}}" placeholder="{{@$input['format']}}" 
                                                {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}} {{@$input['is_hidden']?'hidden':''}}
                                                value="{{$selected[$input['var_name']]}}">
                                            @break
                                        @case('textarea')
                                            <textarea name="{{$input['var_name']}}" class="{{@$input['class']}}" placeholder="{{@$input['format']}}" {{@$input['is_required']?'required':''}} 
                                                style="{{@$input['height']?'height:'.@$input['height']:''}}">{{$selected[$input['var_name']]}}</textarea>
                                            @break
                                        @case('editor')
                                            <textarea name="{{$input['var_name']}}" class="summernote-area {{@$input['class']}}" placeholder="{{@$input['format']}}" 
                                                {{@$input['is_required']?'required':''}}>{{$selected[$input['var_name']]}}</textarea>
                                            @break
                                        @case('select')
                                            @if(@$input['select_attr']['is_tags'])
                                                @php
                                                    $input['select_attr']['options'] = $selected[$input['var_name']]?explode(',',$selected[$input['var_name']]):[];
                                                @endphp
                                            @endif
                                            {{-- @php
                                                dump($input['select_attr']['options']);
                                            @endphp --}}
                                            <select class="{{@$input['is_hidden']?'hidden':(@$input['select_attr']['is_tags']?'form-select-tags':'form-select')}} {{@$input['class']}}" name="{{$input['var_name']}}" 
                                                {{@$input['select_attr']['is_tags']?'multiple="multiple"':''}}
                                                {{@$input['is_required']?'required':''}} {{@$input['is_readonly']?'readonly':''}}>
                                                <option></option>
                                                @if(@$input['select_attr']['is_tags'] && sizeof($input['select_attr']['options']))
                                                    @foreach ($input['select_attr']['options'] as $item)
                                                        <option value="{{$item}}"
                                                            {{in_array($item,$input['select_attr']['options'])?'selected':''}}>
                                                            {{$item}}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach ($input['select_attr']['options'] as $item)
                                                        <option value="{{$item[$input['select_attr']['id']]}}"
                                                            {{$item[$input['select_attr']['id']]==$selected[$input['var_name']]?'selected':''}}>
                                                            {{$item[$input['select_attr']['label']]}}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @break
                                        @case('file')
                                            @php
                                                $filename   = strtolower(array_reverse(explode("/",asset($selected[$input['var_name']])))[0]);  
                                                $extension  = array_reverse(explode(".",$filename))[0];  
                                            @endphp
                                            <div class="upload-wrapper">
                                                <div class="upload-container">
                                                    <div class="upload-container-in">
                                                        <div class="border-container-in">
                                                            <div class="icons fa-4x mt-3 {{(@$selected->img_main||@$selected->file_main)?'hidden':''}}" id="input-file-none-0">
                                                                <i class="fas fa-file-image" data-fa-transform="shrink-3 down-2 left-6 rotate--45"></i>
                                                                <i class="fas fa-file-alt" data-fa-transform="shrink-2 up-4"></i>
                                                                <i class="fas fa-file-pdf" data-fa-transform="shrink-3 down-2 right-6 rotate-45"></i>
                                                            </div>
                                                            <div class="flex flex-auto mx-auto" id="input-file-preview-0">
                                                                @if(@$selected->img_main||@$selected->file_main)
                                                                    @if(in_array('.'.$extension,Config::get('app.accept_extensions')['img']))
                                                                        <img src="{{asset($selected[$input['var_name']])}}">
                                                                    @else
                                                                        <div class="paper sharp-fold mx-auto">
                                                                            <b>{{strtoupper($extension)}}</b>
                                                                        </div>
                                                                    @endif
                                                                    <span>{{$filename}}</span>
                                                                @endif
                                                            </div>
                                                            <input type="file" id="file-upload" data-index-input-file="0" name="{{$input['var_name']}}" 
                                                                class="input-file" {{@$input['is_required']?'required':''}}>
                                                            <p><small>Drag dan drop file, atau <a href="#" id="file-browser">cari disini</a>.</small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @break
                                    @endswitch
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endfor
            </form>
            
    </div>
</section>
<section class="services-section-two">
    <div class="auto-container">
        <button class="theme-btn btn-style-one bg-tealblue" type="button" id="btn-submit-edit">
            <span class="btn-title">Simpan Perubahan</span>
        </button>
    </div>
</section>