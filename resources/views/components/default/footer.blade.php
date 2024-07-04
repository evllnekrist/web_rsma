<!-- Main Footer -->
<footer class="main-footer style-two">
    <!--Widgets Section-->
    <div class="widgets-section" style="background-image: url(images/background/7.jpg);">
        <div class="auto-container">
            <div class="row">
                <!--Big Column-->
                <div class="big-column col-xl-4 col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <!--Footer Column-->
                        <div class="footer-column col-12">
                            <div class="footer-widget about-widget">
                                <div class="logo">
                                    <a href="index.html"><img src="images/logo-2.png" alt="" /></a>
                                </div>
                                <div class="text">
                                    <p>Our Clinic has grown to provide a world class facility for the clinic advanced restorative. </p>
                                    <p>We are among the most qualified implant providers in the AUS with over 30 years of quality training and experience.</p>
                                </div>
                                <ul class="social-icon-three">
                                    <li><a target="_blank" href="https://www.facebook.com/rsudmakasongan/"><span class="fab fa-facebook-f"></span></a></li>
                                    <li><a target="_blank" href="https://twitter.com/rsudmakasongan"><span class="fab fa-twitter"></span></a></li>
                                    <li><a target="_blank" href="https://www.instagram.com/rsudmakasongan/"><span class="fab fa-instagram"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Big Column-->
                <div class="big-column col-xl-8 col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <!--Footer Column-->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <!--Footer Column-->
                            <div class="footer-widget recent-posts">
                                <h2 class="widget-title">Latest News</h2>
                                <!--Footer Column-->
                                <div class="widget-content">
                                    <div class="post">
                                        <div class="thumb"><a href="blog-post-image.html"><img src="images/resource/post-thumb-1.jpg" alt=""></a></div>
                                        <h4><a href="blog-post-image.html">Integrative Medicine <Br>& Cancer Treatment.</a></h4>
                                        <span class="date">July 11, 2020</span>
                                    </div>

                                    <div class="post">
                                        <div class="thumb"><a href="blog-post-image.html"><img src="images/resource/post-thumb-2.jpg" alt=""></a></div>
                                        <h4><a href="blog-post-image.html">Achieving Better <br>Health Care Time.</a></h4>
                                        <span class="date">August 1, 2020</span>
                                    </div>

                                    <div class="post">
                                        <div class="thumb"><a href="blog-post-image.html"><img src="images/resource/post-thumb-3.jpg" alt=""></a></div>
                                        <h4><a href="blog-post-image.html">Great Health Care <br>For Patients.</a></h4>
                                        <span class="date">August 1, 2020</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Footer Column-->
                        <div class="footer-column col-lg-6 col-md-6 col-sm-12">
                            <!--Footer Column-->
                            <div class="footer-widget contact-widget">
                                <h2 class="widget-title">Kontak</h2>
                                <!--Footer Column-->
                                <div class="widget-content">
                                    <ul class="contact-list">
                                        <li>
                                            <span class="icon flaticon-placeholder"></span>
                                            <div class="text">{!!env('OBJ_ADDRESS')!!}</div>
                                        </li>

                                        <li>
                                            <span class="icon flaticon-back-in-time"></span>
                                            <div class="text">{!!env('OBJ_WORKHOURS')!!}</div>
                                        </li>

                                        <li>
                                            <span class="icon flaticon-call-1"></span>
                                            <div class="text">Telepon</div>
                                            <a href="tel:{!!env('OBJ_PHONE')!!}"><strong>{!!env('OBJ_PHONE')!!}</strong></a>
                                        </li>

                                        <li>
                                            <span class="icon flaticon-email"></span>
                                            <div class="text">Email<br>
                                            <a href="mailto:{!!env('OBJ_EMAIL')!!}"><strong>{!!env('OBJ_EMAIL')!!}</strong></a></div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Footer Bottom-->
    <div class="footer-bottom">
        <!-- Scroll To Top -->
        <div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>
        
        <div class="auto-container">
            <div class="inner-container clearfix">
                <div class="footer-nav">
                    <ul class="clearfix">
                        <li><a href="{{route('login')}}">CMS</a></li> 
                    </ul>
                </div>
                
                <div class="copyright-text">
                    <p>Copyright © 2024 | <a href="#">Diskominfostandi Katingan</a> | All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--End Main Footer -->