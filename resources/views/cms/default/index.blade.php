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
        const columns = JSON.parse(`{!! json_encode($page_conf['columns']) !!}`);
    </script>
    <script src="{{asset('asset-cms/js/table.js').'?v='.date('YmdH').'1' }}"></script>
@endsection