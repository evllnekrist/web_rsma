@extends('layouts.app-default-clean', ['breadcrumbs'=>[['label'=>'Struktur Organisasi']]])
@section('title', 'Organisasi')
@section('content')
    
    <div id="tree" style="overflow: scroll"></div>
    
@endsection
@section('addition_css')
    <style>
         #tree {
            width: 100%;
            height: 100%;
        }
        #changeTemplate{
            font-size: 24px;
        }
        svg {
            overflow: scroll !important;
        }
    </style>
@endsection
@section('addition_script')
    <script src="{{asset('asset/js/orgchart.js')}}"></script>
    {{-- <script src="https://balkan.app/js/OrgChart.js"></script> --}}
    <script src="{{asset('asset-page/js/org.js')}}"></script>
@endsection