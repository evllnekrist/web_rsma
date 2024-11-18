@extends('layouts.app-cms', $page_conf)
@section('title', 'Edit')
@section('content')
    @include('components.extra.form-edit', $page_conf)
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('asset-cms/js/form.js').'?v='.date('YmdH').'3' }}"></script>
@endsection