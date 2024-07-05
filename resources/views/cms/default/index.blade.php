@extends('layouts.app-cms', $page_conf)
@section('title', $page_conf['breadcrumbs'][0]['label'])
@section('content')

<section class="page-title" style="background-image: url({{asset('asset/images/background/borneo/'.rand(1,5).'.jpg')}});">
    <div class="auto-container">
        <div class="title-outer">
            <h1 class="text-shadow14">{{ $page_conf['breadcrumbs'][0]['label'] }}</h1>
            <ul class="page-breadcrumb mark-light">
                <li><a href="{{url('/')}}">Beranda</a></li>
                <li>{{ $page_conf['breadcrumbs'][0]['label'] }}</li>
            </ul> 
        </div>
    </div>
</section>
<div class="row justify-content-center">
    <div class="col-auto">
        @include('components.extra.table', $page_conf)
    </div>
</div>
    
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script>
        const pk = `{!! $page_conf['pk']?:'id' !!}`;
        const columns = JSON.parse(`{!! json_encode($page_conf['columns']) !!}`);
        const no_delete_items = JSON.parse(`{!! json_encode(array_key_exists('no_delete_items',$page_conf)?$page_conf['no_delete_items']:[]) !!}`);
    </script>
    <script src="{{asset('asset-cms/js/table.js').'?v='.date('YmdH').'1' }}"></script>
@endsection