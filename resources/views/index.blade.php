@extends('layouts.app-default', ['breadcrumbs'=>[['label'=>'Kelola Akses'],['label'=>'Data']]])
@section('title', 'Dashboard')
@section('content')
            <!-- Bnner Section -->
            <section class="banner-section">
                <div class="banner-carousel owl-carousel owl-theme default-arrows dark">
                    <!-- Slide Item -->
                    <div class="slide-item" style="background-image: url({{asset('asset/images/gallery/rsma-dji.webp')}});">
                        <div class="auto-container">
                            <div class="content-outer">
                                <div class="content-box">
                                    <span class="title">Welcome Our Hospital</span>
                                    <h2>We Are Provide Total <span>Healthcare</span> Solutions</h2>
                                    <div class="text">behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind.</div>
                                    <div class="btn-box"><a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">About Us</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Slide Item -->
                    <div class="slide-item" style="background-image: url({{asset('asset/images/gallery/rsma-administrasi.webp')}});">
                        <div class="auto-container">
                            <div class="content-outer">
                            </div>
                        </div>
                    </div>
                    <!-- Slide Item -->
                    <div class="slide-item" style="background-image: url({{asset('asset/images/gallery/rsma-interior.webp')}});">
                        <div class="auto-container">
                            <div class="content-outer">
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End Bnner Section -->

            <!-- About Section Two -->
            <section class="about-section-two">
                <div class="auto-container">
                    <div class="row">
                        <!-- Content Column -->
                        <div class="content-column col-xl-6 col-lg-7 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <div class="sec-title">
                                    <span class="sub-title">About Our Clinic</span>
                                    <h2>Who We Are Pioneering in Health.</h2>
                                    <span class="divider"></span>
                                    <p>Where you are at the heart of our mission. We hope you will consider us as your medical home—the place where you feel safe, comfortable and cared for. As a multi-specialty medical group,</p>
                                </div>

                                <div class="row">
                                    <!-- Feature BLock -->
                                    <div class="feature-block-two col-lg-6 col-md-6 col-sm-12">
                                        <div class="inner-box">
                                            <span class="icon fa fa-stethoscope"></span>
                                            <h4>Medical Treatment</h4>
                                            <p>Whether you're taking your first steps, just finding your stride,</p>
                                        </div>
                                    </div>

                                    <!-- Feature BLock -->
                                    <div class="feature-block-two col-lg-6 col-md-6 col-sm-12">
                                        <div class="inner-box">
                                            <span class="icon fa fa-ambulance"></span>
                                            <h4>Emergency Help</h4>
                                            <p>Whether you're taking your first steps, just finding your stride,</p>
                                        </div>
                                    </div>

                                    <!-- Feature BLock -->
                                    <div class="feature-block-two col-lg-6 col-md-6 col-sm-12">
                                        <div class="inner-box">
                                            <span class="icon fa fa-user-md"></span>
                                            <h4>Qualified Doctors</h4>
                                            <p>Whether you're taking your first steps, just finding your stride,</p>
                                        </div>
                                    </div>

                                    <!-- Feature BLock -->
                                    <div class="feature-block-two col-lg-6 col-md-6 col-sm-12">
                                        <div class="inner-box">
                                            <span class="icon fa fa-first-aid"></span>
                                            <h4>Medical Professionals</h4>
                                            <p>Whether you're taking your first steps, just finding your stride,</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Images Column -->
                        <div class="image-column col-xl-6 col-lg-5 col-md-12 col-sm-12">
                            <div class="image-box">
                                <figure class="image"><img src="{{asset('asset/images/resource/image-5.jpg')}}" alt=""></figure>
                                <div class="icon-box"><span class="icon flaticon-doctor"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End About Section Two -->

            <!-- Fun Fact Section Two-->
            <section class="fun-fact-section-two">
                <div class="auto-container">
                    <div class="row">
                        <!--Column-->
                        <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp">
                            <div class="count-box">
                                <div class="icon-box"><span class="icon flaticon-user-experience"></span></div>
                                <h4 class="counter-title">Years of Experience</h4>
                                <span class="count-text" data-speed="3000" data-stop="25">0</span>
                            </div>
                        </div>

                        <!--Column-->
                        <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="400ms">
                            <div class="count-box">
                                <div class="icon-box"><span class="icon flaticon-team"></span></div>
                                <h4 class="counter-title">Medical Spesialities</h4>
                                <span class="count-text" data-speed="3000" data-stop="470">0</span>
                            </div>
                        </div>

                        <!--Column-->
                        <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="800ms">
                            <div class="count-box">
                                <div class="icon-box"><span class="icon flaticon-hospital"></span></div>
                                <h4 class="counter-title">Medical Spesialities</h4>
                                <span class="count-text" data-speed="3000" data-stop="689">0</span>
                            </div>
                        </div>

                        <!--Column-->
                        <div class="counter-column col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="1200ms">
                            <div class="count-box">
                                <div class="icon-box"><span class="icon flaticon-add-friend"></span></div>
                                <h4 class="counter-title">Happy Patients</h4>
                                <span class="count-text" data-speed="3000" data-stop="9036">0</span>
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
                        <span class="sub-title">OUR SERVICES</span>
                        <h2>Our Medical Department</h2>
                        <span class="divider"></span>
                    </div>

                    <div class="carousel-outer">
                        <!-- Services Carousel -->
                        <div class="services-carousel owl-carousel owl-theme">
                            <!-- service Block -->
                            <div class="service-block-two">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><a href="department-detail.html"><img src="{{asset('asset/images/resource/service-1.jpg')}}" alt=""></a></figure>
                                    </div>
                                    <div class="lower-content">
                                        <div class="title-box">
                                            <span class="icon flaticon-heart-2"></span>
                                            <h4><a href="department-detail.html">Cardiology Department</a></h4> 
                                        </div>
                                        <div class="text">Introduction. Cardiology is the study heart conditions. The Consultant with whom you have an appointment is a specialist.</div>
                                        <span class="icon-right flaticon-heart-2"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- service Block -->
                            <div class="service-block-two">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><a href="department-detail.html"><img src="{{asset('asset/images/resource/service-2.jpg')}}" alt=""></a></figure>
                                    </div>
                                    <div class="lower-content">
                                        <div class="title-box">
                                            <span class="icon flaticon-brain"></span>
                                            <h4><a href="department-detail.html">Neurology Department</a></h4>
                                        </div>
                                        <div class="text">It is the branch of medicine concerned with the study and treatment of disorders of the nervous system.</div>
                                        <span class="icon-right flaticon-brain"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- service Block -->
                            <div class="service-block-two">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image"><a href="department-detail.html"><img src="{{asset('asset/images/resource/service-3.jpg')}}" alt=""></a></figure>
                                    </div>
                                    <div class="lower-content">
                                        <div class="title-box">
                                            <span class="icon flaticon-kidney"></span>
                                            <h4><a href="department-detail.html">Urology Department</a></h4>
                                        </div>
                                        <div class="text">It is the branch of medicine concerned with the study and treatment of disorders of the nervous system.</div>
                                        <span class="icon-right flaticon-kidney"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sec-bottom-text">Don’t hesitate, contact us for better help and services <a href="#">Explore all Dr. Team</a></div>

                </div>
            </section>
            <!-- End service Section -->

            <!-- Portfolio Section -->
            <section class="portfolio-section">
                <div class="auto-container">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="sec-title">
                                <span class="sub-title">Modern Hospital Facilities</span>
                                <h2>Our Photo Gallery</h2>
                                <span class="divider"></span>
                            </div>
                        </div>
                    </div>

                    <!--MixitUp Galery-->
                    <div class="mixitup-gallery">
                        
                        <div class="btns-outer">
                            <a href="gallery.html" class="theme-btn btn-style-one"><span class="btn-title">View All</span></a>
                            <!--Filter-->
                            <ul class="filter-tabs filter-btns clearfix">
                                <li class="filter active" data-role="button" data-filter="all">All</li>
                                <li class="filter" data-role="button" data-filter=".cancer">Cancer</li>
                                <li class="filter" data-role="button" data-filter=".detal-care">Detal Care</li>
                                <li class="filter" data-role="button" data-filter=".cardiology">Cardiology</li>
                                <li class="filter" data-role="button" data-filter=".dental">Dental</li>
                                <li class="filter" data-role="button" data-filter=".eye-care">Eye Care</li>
                            </ul>                           
                        </div>

                        <div class="filter-list row mid-spacing">
                            <!-- Portfolio Block -->
                            <div class="portfolio-block all mix detal-care dental col-lg-4 col-md-6 col-sm-12">
                                <div class="image-box">
                                    <figure class="image"><img src="{{asset('asset/images/gallery/1-1.jpg')}}" alt=""></figure>
                                    <div class="overlay">
                                        <a href="{{asset('asset/images/gallery/1-1.jpg')}}" class="icon-box lightbox-image"><span class="fa fa-expand"></span></a>
                                        <div class="title-box">
                                            <h5>Diagnostic Imagine</h5>
                                            <div class="cat">
                                                <a href="#">Orthopedics</a>,
                                                <a href="#">Pharmacy</a>,
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Portfolio Block -->
                            <div class="portfolio-block all mix cancer cardiology eye-care col-lg-4 col-md-6 col-sm-12">
                                <div class="image-box">
                                    <figure class="image"><img src="{{asset('asset/images/gallery/1-2.jpg')}}" alt=""></figure>
                                    <div class="overlay">
                                        <a href="{{asset('asset/images/gallery/1-1.jpg')}}" class="icon-box lightbox-image"><span class="fa fa-expand"></span></a>
                                        <div class="title-box">
                                            <h5>Diagnostic Imagine</h5>
                                            <div class="cat">
                                                <a href="#">Orthopedics</a>,
                                                <a href="#">Pharmacy</a>,
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Portfolio Block -->
                            <div class="portfolio-block all mix detal-care dental cardiology col-lg-4 col-md-6 col-sm-12">
                                <div class="image-box">
                                    <figure class="image"><img src="{{asset('asset/images/gallery/1-3.jpg')}}" alt=""></figure>
                                    <div class="overlay">
                                        <a href="{{asset('asset/images/gallery/1-1.jpg')}}" class="icon-box lightbox-image"><span class="fa fa-expand"></span></a>
                                        <div class="title-box">
                                            <h5>Diagnostic Imagine</h5>
                                            <div class="cat">
                                                <a href="#">Orthopedics</a>,
                                                <a href="#">Pharmacy</a>,
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Portfolio Block -->
                            <div class="portfolio-block all mix cancer dental eye-care col-lg-4 col-md-6 col-sm-12">
                                <div class="image-box">
                                    <figure class="image"><img src="{{asset('asset/images/gallery/1-4.jpg')}}" alt=""></figure>
                                    <div class="overlay">
                                        <a href="{{asset('asset/images/gallery/1-1.jpg')}}" class="icon-box lightbox-image"><span class="fa fa-expand"></span></a>
                                        <div class="title-box">
                                            <h5>Diagnostic Imagine</h5>
                                            <div class="cat">
                                                <a href="#">Orthopedics</a>,
                                                <a href="#">Pharmacy</a>,
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Portfolio Block -->
                            <div class="portfolio-block all mix detal-care cardiology col-lg-4 col-md-6 col-sm-12">
                                <div class="image-box">
                                    <figure class="image"><img src="{{asset('asset/images/gallery/1-5.jpg')}}" alt=""></figure>
                                    <div class="overlay">
                                        <a href="{{asset('asset/images/gallery/1-1.jpg')}}" class="icon-box lightbox-image"><span class="fa fa-expand"></span></a>
                                        <div class="title-box">
                                            <h5>Diagnostic Imagine</h5>
                                            <div class="cat">
                                                <a href="#">Orthopedics</a>,
                                                <a href="#">Pharmacy</a>,
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Portfolio Block -->
                            <div class="portfolio-block all mix cancer cardiology eye-care col-lg-4 col-md-6 col-sm-12">
                                <div class="image-box">
                                    <figure class="image"><img src="{{asset('asset/images/gallery/1-6.jpg')}}" alt=""></figure>
                                    <div class="overlay">
                                        <a href="{{asset('asset/images/gallery/1-1.jpg')}}" class="icon-box lightbox-image"><span class="fa fa-expand"></span></a>
                                        <div class="title-box">
                                            <h5>Diagnostic Imagine</h5>
                                            <div class="cat">
                                                <a href="#">Orthopedics</a>,
                                                <a href="#">Pharmacy</a>,
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                    <span class="title">Need a Doctor for Check-up?</span>
                                    <h3>Just Make an Appointment <br>and You’re Done!</h3>
                                    <div class="text">Get Your Quote or Call: <strong>(0080) 123-453-789</strong></div>
                                    <a href="#" class="theme-btn btn-style-three"><span class="btn-title">Get An Appointment</span></a>
                                </div>
                            </div>
                        </div>

                        <div class="form-column col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <div class="appointment-form default-form">
                                    <div class="sec-title">
                                        <span class="sub-title">Online Appoinment</span>
                                        <h2>Make An Appointment</h2>
                                        <span class="divider"></span>
                                    </div>

                                    <!--Comment Form-->
                                    <form action="#" method="post" id="email-form">
                                        <div class="form-group">
                                            <div class="response"></div>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="username" placeholder="Your Name">
                                        </div>

                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Your Email *">
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="phone" placeholder="Your Phone">
                                        </div>
                                        
                                        <div class="form-group">
                                            <textarea name="contact_message" placeholder="Tell us about Pasent"></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <button class="theme-btn btn-style-one bg-tealblue" type="button" name="submit-form"><span class="btn-title">Submit Query</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </section>
            <!--End Appointment Form Section -->

            <!-- Time Table Section -->
            <section class="time-table-section pd-top-extra">
                <div class="auto-container">
                    <!-- Sec Title -->
                    <div class="sec-title text-center">
                        <span class="title">Appointment Schedules</span>
                        <h2>Doctors Time Table</h2>
                        <span class="divider"></span>
                    </div>

                    <div class="table-outer">
                        <!-- Doctors Time Table -->
                        <table class="doctors-time-table">
                            <thead>
                                <tr> 
                                    <th class="dark">Time Table</th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thrusday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>
                                    <th>Sunday</th>
                                </tr>
                            </thead>

                            <tbody>
                                <!-- Table Row 08:00am -->
                                <tr>
                                    <th>08:00am</th>
                                    <td>
                                        <strong>Dental Care</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Orthopaedics</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Medicine</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Orthopaedics</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Table Row 10:00am -->
                                <tr>
                                    <th>10:00am</th>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Gynecology</strong>
                                        <p> 9:00 am - 10:00 am <br> Room: 301</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Cardiology</strong>
                                        <p> 9:00 am - 10:00 am <br> Room: 301</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Dental Care</strong>
                                        <p> 9:00 am - 10:00 am <br> Room: 301</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                </tr>

                                <!-- Table Row 11:00am -->
                                <tr>
                                    <th>11:00am</th>
                                    <td>
                                        <strong>Dental Care</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Orthopaedics</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Medicine</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Orthopaedics</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Table Row 11:30am -->
                                <tr>
                                    <th>11:30am</th>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Gynecology</strong>
                                        <p> 9:00 am - 10:00 am <br> Room: 301</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Cardiology</strong>
                                        <p> 9:00 am - 10:00 am <br> Room: 301</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Dental Care</strong>
                                        <p> 9:00 am - 10:00 am <br> Room: 301</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                </tr>

                                <!-- Table Row 12:00am -->
                                <tr>
                                    <th>12:00am</th>
                                    <td>
                                        <strong>Dental Care</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Orthopaedics</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Medicine</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Orthopaedics</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Table Row 01:00pm -->
                                <tr>
                                    <th>01:00pm</th>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Gynecology</strong>
                                        <p> 9:00 am - 10:00 am <br> Room: 301</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Cardiology</strong>
                                        <p> 9:00 am - 10:00 am <br> Room: 301</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Dental Care</strong>
                                        <p> 9:00 am - 10:00 am <br> Room: 301</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                </tr>

                                <!-- Table Row 02:00pm -->
                                <tr>
                                    <th>02:00pm</th>
                                    <td>
                                        <strong>Dental Care</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Orthopaedics</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Medicine</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                    <td class="empty"></td>
                                    <td>
                                        <strong>Orthopaedics</strong>
                                        <p> 8:00 am - 9:00 am <br> Room: 303</p>
                                        <div class="doctor-info">
                                            <figure class="thumb"><img src="{{asset('asset/images/resource/doctor-thumb.jpg')}}" alt=""></figure>
                                            <h4 class="name">Dr. Tania Riham</h4>
                                            <a href="#" class="theme-btn btn-style-one bg-tealblue"><span class="btn-title">Appointment</span></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>      
            </section>
            <!-- End Time Table Section -->


            <!-- Clients Section -->
            <section class="clients-section">
                <div class="auto-container">

                    <!-- Sponsors Outer -->
                    <div class="sponsors-outer">
                        <!--clients carousel-->
                        <ul class="clients-carousel owl-carousel owl-theme">
                            <li class="slide-item"> <a href="#"><img src="{{asset('asset/images/clients/1.png')}}" alt=""></a> </li>
                            <li class="slide-item"> <a href="#"><img src="{{asset('asset/images/clients/2.png')}}" alt=""></a> </li>
                            <li class="slide-item"> <a href="#"><img src="{{asset('asset/images/clients/3.png')}}" alt=""></a> </li>
                            <li class="slide-item"> <a href="#"><img src="{{asset('asset/images/clients/4.png')}}" alt=""></a> </li>
                            <li class="slide-item"> <a href="#"><img src="{{asset('asset/images/clients/5.png')}}" alt=""></a> </li>
                        </ul>
                    </div>
                </div>
            </section>
            <!--End Clients Section -->
@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('asset/page/js/role-index.js').'?v='.date('YmdH').'1' }}"></script>
@endsection