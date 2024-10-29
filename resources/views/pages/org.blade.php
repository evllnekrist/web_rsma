@extends('layouts.app-default-clean', ['breadcrumbs'=>[['label'=>'Struktur Organisasi']]])
@section('title', 'Organisasi')
@section('content')
    <div id="toolbar" class="simple-btn-wrap">
        <div id="layoutTop" class="simple-btn">↑</div>
        <div id="layoutBottom" class="simple-btn">↓</div>
        <div id="layoutLeft" class="simple-btn">←</div>
        <div id="layoutRight" class="simple-btn">→</div>
        <div id="fitScreen" class="simple-btn" style="width:100%!important">Fit to Screen</div>
    </div>
    <div id="tree" style="overflow: scroll"></div>
    
@endsection
@section('addition_css')
    <style>
         #tree {
            width: 100%;
            height: 100%;
        }
        /* #changeTemplate{
            font-size: 24px;
        } */
        .simple-btn-wrap{
            display: flex; 
            gap: 5px; 
            position: absolute; 
            right: 20px; top: 80px;
        }
        .simple-btn{
            width: 30px; 
            height: 30px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            border: 1px solid #BCBCBC; 
            background-color: #FFFFFF; cursor: pointer;
        }
        svg {
            overflow: scroll !important;
        }
    </style>
@endsection
@section('addition_script')
    <!-- <script src="{{asset('asset/js/orgchart.js?v=241029')}}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/apextree"></script>
    <script src="{{asset('asset-page/js/org.js?v=241029')}}"></script>
@endsection