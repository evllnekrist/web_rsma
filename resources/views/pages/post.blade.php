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

            <br><input name="_page" value="1" class="_filter_{{$segments[0]}}" hidden>
            <div class="row justify-content-end" id="data-list-{{$segments[0]}}"></div>
        </div>
    </section>
    <div class="container mb-5">
        <div class="row justify-content-between">
            <div class="d-flex" id="data-list-{{$segments[0]}}-pagination"></div>
            <div>
                <select name="_limit" onchange="getDataPost()" data-tw-merge="" class="_filter_{{$segments[0]}} form-control">
                    <option value="6" selected>6</option>
                    <option value="12">12</option>
                    <option value="60">60</option>
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