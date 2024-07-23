@extends('layouts.app-default', ['breadcrumbs'=>[['label'=>'Error']]])
@section('title', 'Dashboard')
@section('content')
    <div class="my-5">	
			<!-- ============================ User Dashboard ================================== -->
			<section class="error-wrap">
				<div class="container">
					<div class="row justify-content-center">
						
						<div class="col-lg-6 col-md-10">
							<div class="text-center">
								
								@php
									$wpp = array('404_burung.png','404_enggang.png','404_orangutan.png');
								@endphp
								<img src="{{asset('asset/images/'.$wpp[array_rand($wpp,1)])}}" class="img-fluid" style="height:40vh" alt="">
								<h3 class="text-secondary mt-5 mb-3">{{@$desc?:'Halaman yang Anda cari tidak tersedia'}}</h3>
								Kembali ke <a class="text-success underline--magical" href="{{url('/')}}"><b>&nbsp;&nbsp;halaman utama&nbsp;&nbsp;</b></a>
								
							</div>
						</div>
						
					</div>
				</div>
			</section>
		</div>
@endsection
@section('addition_css')
@endsection
@section('addition_script')
@endsection