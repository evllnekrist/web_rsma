<!-- Main Header-->
<header class="main-header header-style-two">

    <!-- Header top -->
    <div class="header-top-two">
        <div class="auto-container">
            <div class="inner-container">
                <div class="top-left">
                    <ul class="contact-list clearfix">
                        <li><i class="flaticon-hospital-1"></i>Jl. Rumah Sakit No 1 Kasongan,<br>Katingan, Kalimantan Tengah</li>
                        <li><i class="flaticon-back-in-time"></i>Senin-Kamis 08.00-11.00<br>Jumat-Sabtu 08.00-10.00<br>IGD 24 Jam</li>
                    </ul>
                </div>
                <div class="top-right">
                    <ul class="social-icon-one">
                        <li><a target="_blank" href="https://www.facebook.com/rsudmakasongan/"><span class="fab fa-facebook-f"></span></a></li>
                        <li><a target="_blank" href="https://twitter.com/rsudmakasongan"><span class="fab fa-twitter"></span></a></li>
                        <li><a target="_blank" href="https://www.instagram.com/rsudmakasongan/"><span class="fab fa-instagram"></span></a></li>
                    </ul>
                    <div class="btn-box">
                        <a href="tel:05364041041" title="(0536) 4041041" id="appointment-btn" class="theme-btn btn-style-three">
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
                    <div class="logo"><a href="{{url('/')}}"><img src="{{asset('asset/images/logo-rsma.webp')}}" style="height:120px" alt="logo RSUDMA"></a></div>
                </div>

                <!--Nav Box-->
                <div class="nav-outer">
                    <nav class="nav main-menu">
                        <ul class="navigation" id="navbar">
                            <li class="current"><a href="#">Beranda<a href="#"></li>
                            <li class="dropdown">
                                <span>Layanan</span>
                                <ul>
                                    <li><a href="#">Rawat Jalan</a></li>
                                    <li><a href="#">Rawat Inap</a></li>
                                    <li><a href="#">Penunjang Medis</a></li>
                                    <li><a href="#">IGD</a></li>
                                    <li><a href="#">Farmasi</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <span>Informasi</span>
                                <ul>
                                    <li><a href="#">Info BPJS</a></li>
                                    <li><a href="#">Alur Pelayanan Umum dan BPJS</a></li>
                                    <li><a href="#">Jadwal Poliklinik</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dokter</a></li>
                            <li><a href="#">Berita</a></li>
                            <li><a href="#">Artikel</a></li>
                            <li class="dropdown">
                                <span>Profil</span>
                                <ul>
                                    <li><a href="#">Tentang RSUD MA</a></li>
                                    <li><a href="#">Struktur Organisasi</a></li>
                                    <li><a href="#">Sumber Daya Manusia</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Kontak dan Pengaduan</a></li>
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
                    <div class="logo"><a href="index.html"><img src="{{asset('asset/images/logo-rsma.webp')}}" style="height:50px"></a></div>
                </div>

                <!--Keep This Empty / Menu will come through Javascript-->
            </div>
        </div>
    </div><!-- End Sticky Menu -->

    <!-- Mobile Header -->
    <div class="mobile-header">
        <div class="logo"><a href="index.html"><img src="{{asset('asset/images/logo-rsma.webp')}}" style="height:50px"></a></div>

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