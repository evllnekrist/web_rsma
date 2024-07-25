@php
    $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
    $attr = [
        'article'=>'Artikel',
        'news'=>'Berita'
    ];
@endphp
@extends('layouts.app-default', ['breadcrumbs'=>[['label'=>'']]])
@section('title', $attr[$segments[0]])
@section('content') 
    <input id="post-type" value="{{$segments[0]}}" hidden>
    <section class="news-section-two">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title">
                <span class="title">Info Terkini</span>
                <h2>{{$attr[$segments[0]]}}</h2>
                <span class="divider"></span>
            </div>

            <div class="row" id="data-list">

            </div>
        </div>
    </section>
    <div class="container mb-5">
        <div class="row justify-content-between">
            <div class="d-flex" id="data-list-pagination"></div>
            <div>
                <select name="_limit" onchange="getData()" data-tw-merge="" class="_filter form-control">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="all">Semua</option>
                </select>
            </div>
        </div>
    </div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('asset-page/js/post.js')}}"></script>
@endsection