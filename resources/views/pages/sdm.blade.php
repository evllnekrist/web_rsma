@extends('layouts.app-default', ['breadcrumbs'=>[['label'=>'Sumber Daya Manusia']]])
@section('title', 'SDM')
@section('content')

<div class="py-5">
    <div class="row justify-content-center">
        <div class="col-auto">
            <table class="table table-striped table-hover table-responsive table-sm mt-3">
                <thead class="thead-dark">
                    <tr>
                        <td>No.</td>
                        <td>Kategori</td>
                        <td>Jumlah</td>
                        <td>Deskripsi</td>
                    </tr>
                </thead>
                <tbody id="data-list">
                </tbody>
            </table>
            <div class="row justify-content-between">
                <div class="d-flex" id="data-list-pagination"></div>
                <div>
                    <select name="_limit" onchange="getData()" data-tw-merge="" class="_filter form-control">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="all">Semua</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('asset-page/js/sdm.js')}}"></script>
@endsection