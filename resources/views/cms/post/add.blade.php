@extends('layouts.app-cms', $page_conf)
@section('title', 'Tambah')
@section('content')
    @include('components.extra.form-add', $page_conf)
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('asset-cms/js/form.js').'?v='.date('YmdH').'1' }}"></script>
@endsection