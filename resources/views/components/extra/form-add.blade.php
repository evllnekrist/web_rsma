
<section class="appointment-form-section" style="background-image: url({{asset('asset/images/background/honeycomb.png')}});">
    <div class="auto-container">

            <div class="sec-title">
                <a href="{{@$breadcrumbs[0]['route']}}" class="text-dark">{{$breadcrumbs[0]['label']}}&nbsp;&nbsp;</a>
                <b class="text-white"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;{{$breadcrumbs[1]['label']}}</b>
            </div>
            <form action="#" method="post" id="form-add" data-object="{{@$object}}" class="row">
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
                                        @case('textarea')
                                            <textarea name="{{$input['var_name']}}" class="{{@$input['class']}}" placeholder="{{@$input['format']}}" 
                                                {{@$input['is_required']?'required':''}} style="{{@$input['height']?'height:'.@$input['height']:''}}"></textarea>
                                            @break
                                        @case('editor')
                                            <textarea name="{{$input['var_name']}}" class="summernote-area {{@$input['class']}}" placeholder="{{@$input['format']}}" 
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
                                                @foreach ($input['select_attr']['options'] as $item)
                                                    <option value="{{$item[$input['select_attr']['id']]}}"
                                                        {{$item[$input['select_attr']['id']]==@$input['value']?'selected':''}}>
                                                        {{$item[$input['select_attr']['label']]}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @break
                                        @case('file')
                                            <div class="upload-wrapper">
                                                <div class="upload-container">
                                                    <div class="upload-container-in">
                                                        <div class="border-container-in">
                                                            <div class="icons fa-4x mt-3" id="input-file-none-0">
                                                                <i class="fas fa-file-image" data-fa-transform="shrink-3 down-2 left-6 rotate--45"></i>
                                                                <i class="fas fa-file-alt" data-fa-transform="shrink-2 up-4"></i>
                                                                <i class="fas fa-file-pdf" data-fa-transform="shrink-3 down-2 right-6 rotate-45"></i>
                                                            </div>
                                                            <div class="flex flex-auto mx-auto" id="input-file-preview-0">
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
        <button class="theme-btn btn-style-one bg-tealblue" type="button" id="btn-submit-add">
            <span class="btn-title">Simpan</span>
        </button>
    </div>
</section>