
@php
    // dump($columns);
@endphp
<div class="row justify-content-between mt-5">
    @if(@$btn_add)
    <a href="{{$btn_add['link']}}" class="theme-btn btn-style-one small">
        <span class="btn-title">
            <i class="fas fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;Tambah Baru
        </span>
    </a>
    @endif
</div>
<center>
    Menampilkan <span id="products_count_start"></span> - <span id="products_count_end"></span> dari <span id="products_count_total"></span> data
    <br><input name="_page" value="1" class="_filter" hidden>
</center>
<table class="table table-bordered table-hover table-responsive table-sm mt-3">
    <thead class="thead-dark">
        <tr>
            @foreach ($columns as $column)
                @if((!@$column['is_order']) || in_array(@$column['type'],['action']))
                    <th>{{$column['label']}}</th>
                @else
                    <th onclick="changeDir('{{$column['var_name']}}')" id="th_{{$column['var_name']}}" data-dir="" data-tw-merge="" class="_dir">
                        {{$column['label']}}
                        <span class="ml-2">
                            <i class="fas fa-sort text-muted2"></i>
                            <i class="fas fa-sort-up text-primary hidden"></i>
                            <i class="fas fa-sort-down text-primary hidden"></i>
                        </span>
                    </th>
                @endif
            @endforeach
        </tr>
        <tr>
            @foreach ($columns as $column)
                @if(!array_key_exists("search",$column))
                    <th></th>
                @else
                    @switch($column['search']['type'])
                        @case('text')
                            <th><input type="text" class="form-control"></th>
                        @break
                        @case('number')
                            <th><input type="number" class="form-control" style="width:70px"></th>
                        @break
                        @default
                            <th></th>
                        @break
                    @endswitch
                @endif
            @endforeach
        </tr>
    </thead>
    <tbody id="data-list" data-object="{{@$object}}">
        <tr>
            <td colspan="{{sizeof($columns)}}">
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