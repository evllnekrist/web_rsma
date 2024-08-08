@extends('layouts.app-default', ['breadcrumbs'=>[['label'=>'Kelola Akses'],['label'=>'Data']]])
@section('title', 'Dashboard')
@section('content')
            <!-- Bnner Section -->
            <section class="banner-section">
                <div class="banner-carousel owl-carousel owl-theme default-arrows dark">
                    @foreach ($sliders as $item)
                        <div class="slide-item" style="background-image: url({{asset($item->img_main)}});">
                            <div class="auto-container">
                                <div class="content-outer">
                                    @if($item->value || $item->value2 || $item->label || $item->description)
                                    <div class="content-box">
                                        @if($item->value)
                                            <span class="title">{!!$item->value!!}</span>
                                        @endif
                                        @if($item->label)
                                            <h2>{!!$item->label!!}</h2>
                                        @endif
                                        @if($item->description)
                                            <div class="text">{!!$item->description!!}</div>
                                        @endif
                                        @if($item->value2)
                                            <div class="btn-box"><a href="{!!$item->value2!!}" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Telusuri</span></a></div>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
            <!-- End Bnner Section -->

            <!-- Fun Fact Section Two-->
            <section class="fun-fact-section-two">
                <div class="auto-container">
                    <div class="row">

                        <!--Column-->
                        <div class="counter-column col-md-4 col-sm-12 wow fadeInUp">
                            <div class="count-box">
                                <div class="icon-box"><span class="icon flaticon-user-experience"></span></div>
                                <h4 class="counter-title">Tahun Pengalaman</h4>
                                <span class="count-text" data-speed="3000" data-stop="10">0</span>
                            </div>
                        </div>

                        <!--Column-->
                        <div class="counter-column col-md-4 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                            <div class="count-box">
                                <div class="icon-box"><span class="icon flaticon-team"></span></div>
                                <h4 class="counter-title">SDM</h4>
                                <span class="count-text" data-speed="3000" data-stop="314">0</span>
                            </div>
                        </div>

                        <!--Column-->
                        <div class="counter-column col-md-4 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
                            <div class="count-box">
                                <div class="icon-box"><span class="icon flaticon-hospital"></span></div>
                                <h4 class="counter-title">Fasilitas Penunjang Medis</h4>
                                <span class="count-text" data-speed="3000" data-stop="100">0</span>
                            </div>
                        </div>

                    </div>
                </div>
            </section>
            <!-- Fun Fact Section Two -->

            <!-- Services Section -->
            <section class="services-section-two">
                <div class="auto-container">

                    <div class="sec-title text-center">
                        <span class="sub-title">Info Terkini</span>
                        <h2>Artikel</h2>
                        <span class="divider"></span>
                    </div>
                    <div class="carousel-outer">
                        <div class="services-carousel row" id="data-list-article"></div>
                    </div>
                    <div class="row justify-content-between hidden">
                        <div class="d-flex" id="data-list-article-pagination"></div>
                        <div>
                            <select name="_limit" onchange="getDataPost()" data-tw-merge="" class="_filter_article form-control">
                                <option value="3" selected>3</option>
                            </select>
                        </div>
                    </div>
                    <div class="sec-bottom-text">Temukan lebih banyak artikel <b><a href="{{url('/article')}}">di sini</a></b></div>

                </div>
            </section>
            <!-- End service Section -->

            <!-- Portfolio Section -->
            <section class="portfolio-section">
                <div class="auto-container">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="sec-title">
                                <span class="sub-title">Info Terkini</span>
                                <h2>Berita</h2>
                                <span class="divider"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mixitup-gallery">
                        <div class="btns-outer">
                            <a href="gallery.html" class="theme-btn btn-style-one"><span class="btn-title">Lihat Semua</span></a>                         
                        </div>
                        <div class="row mt-5" id="data-list-news"></div>
                    </div>
                    <div class="row justify-content-between hidden">
                    <div class="d-flex" id="data-list-news-pagination"></div>
                        <div>
                            <select name="_limit" onchange="getDataPost()" data-tw-merge="" class="_filter_news form-control">
                                <option value="3" selected>3</option>
                            </select>
                        </div>
                    </div>

                </div>
            </section>
            <!-- End Portfolio Section -->

            <!-- Appointment Form Section -->
            <section class="appointment-form-section" style="background-image: url(images/background/3.jpg);">
                <div class="auto-container">
                    <div class="row">

                        <!-- Content Column -->
                        <div class="content-column col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <a href="https://www.youtube.com/watch?v=Fvae8nxzVz4" class="play-now" data-fancybox="gallery" data-caption=""><i class="icon flaticon-play-button" aria-hidden="true"></i><span class="ripple"></span></a>

                                <div class="content">
                                    <span class="title">Mari bantu kami pahami apa yang masyarakat butuhkan....</span>
                                    <h3>Survey Kepuasan</h3>
                                    <a data-toggle="collapse" href="#data-satisfaction" onclick="getDataSatisfaction()" style="color:white"><small><u>Lihat hasil</u></small></a>
                                </div>
                            </div>
                        </div>

                        <div class="form-column col-lg-6 col-md-12 col-sm-12 mb-5">
                            <div class="inner-column mb-5">
                                <div class="appointment-form default-form">
                                    {{-- <div class="sec-title"> --}}
                                        {{-- <span class="sub-title"></span> --}}
                                        {{-- <h2></h2> --}}
                                        {{-- <span class="divider"></span> --}}
                                    {{-- </div> --}}

                                    <!--Comment Form-->
                                    <form action="#" method="post" id="form-satisfaction">

                                        <div class="form-group">
                                            <div class="row justify-content-center" style="line-height: 1.5">
                                                <input id="in_score" name="star" type="number" data-size="lg" class="kv-ltr-theme-fas-alt rating-loading" required>
                                            </div>
                                            <div class="row justify-content-center">
                                                <span id="in_score_info"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="Nama" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Email" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <textarea name="description" placeholder="Ketik komentar disini" required></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <button class="theme-btn btn-style-one bg-tealblue" type="button" id="btn-submit-satisfaction"><span class="btn-title">Kirim</span></button>
                                        </div>
                                    </form>
                                    <div id="form-satisfaction-loading" class="text-center" style="display:none"><img src="{{asset('asset/images/loading.gif')}}"></div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </section>
            <!--End Appointment Form Section -->


            <!-- Clients Section -->
            <section class="clients-section">
                <div class="auto-container">

                    <div class="card-body collapse" id="data-satisfaction">
                        <br><input name="_page" value="1" class="_filter_satisfaction" hidden>
                        <table class="table table-sm table-hover mx-5"> 
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengirim</th>
                                    <th style="width: 150px">Rating</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="data-list-satisfaction" >
                            </tbody>
                        </table>
                        <div class="row justify-content-between mb-5">
                            <div class="d-flex" id="data-list-satisfaction-pagination"></div>
                            <div>
                                <select name="_limit" onchange="getDataSatisfaction()" data-tw-merge="" class="_filter_satisfaction form-control">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="all">Semua</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Sponsors Outer -->
                    <div class="sponsors-outer">
                        <!--clients carousel-->
                        <ul class="clients-carousel owl-carousel owl-theme">
                            @foreach ($related_links as $item)
                                <li class="slide-item" title="{{$item->label}}"> <a href="{{$item->value2}}"><img src="{{asset($item->img_main)}}" alt=""></a> </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
            <!--End Clients Section -->
@endsection
@section('addition_css')
    <link href="{{asset('asset/plugins/star-rating/star-rating.min.css') }}" rel="stylesheet" />
    <link href="{{asset('asset/plugins/krajee-fas/theme.min.css')}}" rel="stylesheet" />
@endsection
@section('addition_script')
    <script>
        var $_GET = JSON.parse(`{!! json_encode($_REQUEST) !!}`);
    </script>
    <script src="{{asset('asset/plugins/star-rating/star-rating.min.js').'?v='.date('YmdH') }}"></script>
    <script src="{{asset('asset/plugins/krajee-fas/theme.min.js').'?v='.date('YmdH')}}"></script>
    <script src="{{asset('asset-page/js/home.js')}}"></script>
@endsection