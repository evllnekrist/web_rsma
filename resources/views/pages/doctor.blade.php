@extends('layouts.app-default', ['breadcrumbs'=>[['label'=>'Dokter']]])
@section('title', 'Dashboard')
@section('content')
    
    <div class="py-5">
        <div class="row justify-content-center">
            <div class="col-auto">
                <table class="table table-hover table-responsive table-sm mt-3">
                    <thead hidden>
                        <tr>
                            <td width="30%"></td>
                            <td width="100%"></td>
                        </tr>
                    </thead>
                    <tbody id="data-list">
                        <tr>
                            <td colspan="2">
                                <center><img src="{{asset('asset/images/loading.gif')}}"></center>
                            </td>
                        </tr>
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
    <script src="{{asset('asset-page/js/doctor.js')}}"></script>
@endsection