@extends('layouts.app-default', ['breadcrumbs'=>[['label'=>'']]])
@section('title', $selected['title'])
@section('content')
  <div class="container my-5">	
    @php
      $layout_slices = explode("_",@$selected->layout);
    @endphp
    @foreach($layout_slices as $layout_item)
      @switch($layout_item)
        @case('body')    
          {!! $selected['body'] !!}
        @break
        @case('img')
          <div class="text-center">
            <img src="{{$selected->img_main}}" class="img-fluid-80"/>
          </div>
        @break
        @case('pdf')
          <div class="text-center">
            <iframe style="border:1px solid #666CCC" title="PDF in an i-Frame" src="{{$selected->file_main?asset($selected->file_main):($selected->file_link?$selected->file_link:'')}}" 
                frameborder="1" 
                scrolling="auto"
                width="80%" 
                height="700px">
            </iframe>
          </div>
        @break
      @endswitch
    @endforeach
  </div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
@endsection