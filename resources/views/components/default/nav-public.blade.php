<!-- Main Header-->
<header class="main-header header-style-two">

    <!-- Header top -->
    <div class="header-top-two">
        <div class="auto-container">
            <div class="inner-container">
                <div class="top-left">
                    <ul class="contact-list clearfix">
                        <li><i class="flaticon-hospital-1"></i>{!!Cookie::get('contact_address')?Cookie::get('contact_address'):env('OBJ_ADDRESS')!!}</li>
                        <li><i class="flaticon-back-in-time"></i>
                            @php
                                if(Cookie::get('schedule')){
                                    foreach(json_decode(Cookie::get('schedule')) as $item){
                                        echo $item.'<br>';
                                    }
                                }else{  echo env('OBJ_WORKHOURS');   }
                            @endphp
                        </li>
                    </ul>
                </div>
                <div class="top-right">
                    <ul class="social-icon-one">
                        <li><a target="_blank" href="{{Cookie::get('socmed_fb')}}"><span class="fab fa-facebook-f"></span></a></li>
                        <li><a target="_blank" href="{{Cookie::get('socmed_twitter')}}"><span class="fab fa-twitter"></span></a></li>
                        <li><a target="_blank" href="{{Cookie::get('socmed_ig')}}"><span class="fab fa-instagram"></span></a></li>
                    </ul>
                    <div class="btn-box">
                        <a href="tel:{{Cookie::get('contact_phone')}}" title="{{Cookie::get('contact_phone')}}" id="appointment-btn" class="theme-btn btn-style-three">
                            <span class="btn-title">Call Center</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top -->
    
    <!-- Header Lower -->
    <div class="header-lower">
        <div class="auto-container">    
            <!-- Main box -->
            <div class="main-box">

                <div class="logo-box">
                    <div class="logo"><a href="{{url('/')}}"><img src="{{asset(Cookie::get('logo')?Cookie::get('logo'):'asset/images/logo-rsma.webp')}}" style="height:120px" alt="logo RSUDMA"></a></div>
                </div>

                <!--Nav Box-->
                <div class="nav-outer">
                    <nav class="nav main-menu">
                        <ul class="navigation" id="navbar">
                            <li class="current"><a href="{{url('/')}}">Beranda</a></li>
                            <li class="dropdown">
                                <span>Layanan</span>
                                <ul>
                                    <li><a href="{{url('/p/services#rawat-jalan')}}">Rawat Jalan</a></li>
                                    <li><a href="{{url('/p/services#rawat-inap')}}">Rawat Inap</a></li>
                                    <li><a href="{{url('/p/services#penunjang-medis')}}">Penunjang Medis</a></li>
                                    <li><a href="{{url('/p/services#igd')}}">IGD</a></li>
                                    <li><a href="{{url('/p/services#farmasi')}}">Farmasi</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <span>Informasi</span>
                                <ul>
                                    <li><a href="{{url('/p/bpjs-info')}}">Info BPJS</a></li>
                                    <li><a href="{{url('/p/service-flow')}}">Alur Pelayanan Umum dan BPJS</a></li>
                                    <li><a href="{{url('/p/poly-schedule')}}">Jadwal Poliklinik</a></li>
                                </ul>
                            </li>
                            <li><a href="{{url('/doctor')}}">Dokter</a></li>
                            <li><a href="{{url('/news')}}">Berita</a></li>
                            <li><a href="{{url('/article')}}">Artikel</a></li>
                            <li class="dropdown">
                                <span>Profil</span>
                                <ul>
                                    <li><a href="{{url('/p/about-us')}}">Tentang RSUD MA</a></li>
                                    <li><a href="{{url('/org')}}">Struktur Organisasi</a></li>
                                    <li><a href="{{url('/sdm')}}">Sumber Daya Manusia</a></li>
                                </ul>
                            </li>
                            <li><a href="{{url('/contact')}}">Kontak dan Pengaduan</a></li>
                        </ul>
                    </nav>
                    <!-- Main Menu End-->

                    <div class="outer-box">
                        <button class="search-btn"><span class="fa fa-search"></span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sticky Header  -->
    <div class="sticky-header">
        <div class="auto-container">            
            <div class="main-box">
                <div class="logo-box">
                    <div class="logo"><a href="index.html"><img src="{{asset(Cookie::get('logo')?Cookie::get('logo'):'asset/images/logo-rsma.webp')}}" style="height:50px"></a></div>
                </div>

                <!--Keep This Empty / Menu will come through Javascript-->
            </div>
        </div>
    </div><!-- End Sticky Menu -->

    <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="logo"><a href="index.html"><img src="{{asset(Cookie::get('logo')?Cookie::get('logo'):'asset/images/logo-rsma.webp')}}" style="height:50px"></a></div>

        <!--Nav Box-->
        <div class="nav-outer clearfix">

            <div class="outer-box">
                <!-- Search Btn -->
                <div class="search-box">
                    <button class="search-btn mobile-search-btn"><i class="flaticon-magnifying-glass"></i></button>
                </div>
                <a href="#nav-mobile" class="mobile-nav-toggler navbar-trigger"><span class="fa fa-bars"></span></a>
            </div>
        </div>
    </div>

    <!-- Mobile Nav -->
    <div id="nav-mobile"></div>

    <!-- Header Search -->
    <div class="search-popup">
        <span class="search-back-drop"></span>
        <button class="close-search"><span class="fa fa-times"></span></button>
        
        <div class="search-inner">
            <form method="post" action="blog-showcase.html">
                <div class="form-group">
                    <input type="search" name="search-field" value="" placeholder="Cari..." required="">
                    <button type="submit"><i class="flaticon-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Header Search -->
</header>
<!--End Main Header -->