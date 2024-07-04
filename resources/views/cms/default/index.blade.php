@extends('layouts.app-cms', $page_conf)
@section('title', $page_conf['breadcrumbs'][0]['label'])
@section('content')

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