<!-- Main Footer -->
<footer class="main-footer style-two">
    <!--Widgets Section-->
    <div class="widgets-section" style="background-image: url(images/background/7.jpg);">
        <div class="auto-container">
            <div class="row">
                <!--Big Column-->
                <div class="big-column col-xl-5 col-lg-4 col-md-12 col-sm-12">
                    <div class="row">
                        <!--Footer Column-->
                        <div class="footer-column col-12">
                            <div class="footer-widget about-widget">
                                <div class="logo">
                                    <a href="index.html"><img src="{{asset(Cookie::get('logo')?Cookie::get('logo'):'asset/images/logo-rsma.webp')}}" style="height:50px"></a>
                                </div>
                                <div class="text smaller">
                                    {!!Cookie::get('desc')!!}
                                </div>
                                <ul class="social-icon-three">
                                    <li><a target="_blank" href="{{Cookie::get('socmed_fb')}}"><span class="fab fa-facebook-f"></span></a></li>
                                    <li><a target="_blank" href="{{Cookie::get('socmed_twitter')}}"><span class="fab fa-twitter"></span></a></li>
                                    <li><a target="_blank" href="{{Cookie::get('socmed_ig')}}"><span class="fab fa-instagram"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Big Column-->
                <div class="big-column col-xl-7 col-lg-8 col-md-12 col-sm-12">

                        <div class="footer-column">
                            <div class="footer-widget contact-widget">
                                <h2 class="widget-title">Kontak</h2>
                                <div class="widget-content row">
                                    <ul class="contact-list col-6">
                                        <li>
                                            <span class="icon flaticon-placeholder"></span>
                                            <div class="text">{!!Cookie::get('contact_address')?Cookie::get('contact_address'):env('OBJ_ADDRESS')!!}</div>
                                        </li>

                                        <li>
                                            <span class="icon flaticon-back-in-time"></span>
                                            <div class="text">
                                                @php
                                                    if(Cookie::get('schedule')){
                                                        foreach(json_decode(Cookie::get('schedule')) as $item){
                                                            echo $item.'<br>';
                                                        }
                                                    }else{  echo env('OBJ_WORKHOURS');   }
                                                @endphp
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="contact-list col-6">
                                        <li>
                                            <span class="icon flaticon-call-1"></span>
                                            <div class="text">Telepon</div>
                                            <a href="tel:{{Cookie::get('contact_phone')}}"><strong>{{Cookie::get('contact_phone')}}</strong></a>
                                        </li>

                                        <li>
                                            <span class="icon flaticon-email"></span>
                                            <div class="text">Email<br>
                                            <a href="mailto:{{Cookie::get('contact_email')}}"><strong>{{Cookie::get('contact_email')}}</strong></a></div>
                                        </li>
                                    </ul>
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