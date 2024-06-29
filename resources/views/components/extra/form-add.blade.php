
<section class="appointment-form-section" style="background-image: url({{asset('asset/images/background/honeycomb.png')}});">
    <div class="auto-container">

            <div class="sec-title">
                {{$breadcrumbs[0]['label']}}&nbsp;&nbsp;<b class="text-white"><i class="fa fa-caret-right"></i>&nbsp;&nbsp;{{$breadcrumbs[1]['label']}}</b>
            </div>

            <form action="#" method="post" id="form-add" class="row">
                @for($i=0;$i<sizeof($inputs);$i++)
                    <div class="col-md-{{12/sizeof($inputs)}} col-sm-12">
                        <div class="appointment-form default-form">
                            @foreach ($inputs[$i] as $input)
                                <div class="form-group">
                                    <span class="text-muted2 small">{{$input['label']}}</span>
                                    @switch($input['type'])
                                        @case('text')
                                            <input type="text" name="{{$input['var_name']}}" placeholder="{{@$input['format']}}">
                                            @break
                                        @case('number')
                                            <input type="number" name="{{$input['var_name']}}">
                                            @break
                                        @case('email')
                                            <input type="email" name="{{$input['var_name']}}" placeholder="{{@$input['format']}}">
                                            @break
                                        @case('textarea')
                                            <textarea name="{{$input['var_name']}}" placeholder="{{@$input['format']}}" rows="4"></textarea>
                                            @break
                                        @case('select')
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
                                                            <input type="file" id="file-upload" data-index-input-file="0" type="file" class="input-file">
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
        <button class="theme-btn btn-style-one bg-tealblue" type="button" name="submit-form">
            <span class="btn-title">Simpan</span>
        </button>
    </div>
</section>