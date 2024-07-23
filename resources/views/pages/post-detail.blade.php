@php
    $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
    $attr = [
        'article'=>'Artikel',
        'news'=>'Berita'
    ];
@endphp
@extends('layouts.app-default', ['breadcrumbs'=>[['label'=>'']]])
@section('title', $attr[$segments[0]])
@section('content') 

<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">
            <!--Content Side-->
            <div class="content-side col-lg-8 col-md-12 col-sm-12">
                <div class="blog-post">
                    <!-- News Block -->
                    <div class="news-block">
                        <div class="inner-box">
                            <div class="image"><img src="images/resource/blog-single.jpg" alt="" /></div>
                            <div class="lower-content">
                                <ul class="post-info">
                                    <li><span class="fa fa-calendar"></span> {{date_format($selected['created_at'],"d F Y H:i")}}</li>
                                </ul>
                                <h3>{{$selected['title']}}</h3>
                                @if(@$selected['caption'])     
                                    <div class="two-column row">
                                        <div class="image-column col-lg-6 col-md-8 col-sm-12">
                                            <figure class="image wow fadeIn"><img src="{{asset($selected['img_main'])}}" alt=""></figure>
                                        </div>
                                        <div class="content-column col-lg-6 col-md-4 col-sm-12">
                                            <blockquote><small>{!!$selected['caption']!!}</small></blockquote>
                                        </div>
                                    </div>                       
                                @else
                                    <figure class="image wow fadeIn"><img src="{{asset($selected['img_main'])}}" alt=""></figure>
                                @endif
                                {!!$selected['content']!!}
                            </div>
                        </div>
                    </div>

                   <!-- Other Options -->
                    <div class="post-share-options clearfix">
                        <ul class="tags pull-left">
                            @php
                                $keywords = explode(',',$selected['keywords']);
                                foreach ($keywords as $keyword) {
                                    echo '<li><a href="'.url('/'.$segments[0].'?k='.$keyword).'">'.$keyword.'</a></li>';
                                }
                            @endphp
                        </ul>
                    </div>
                </div>


                <!-- Author Box -->
                <div class="author-box">
                    <div class="inner-box clearfix">
                        <div class="thumb"><img src="{{asset('asset/images/resource/author-thumb-sample.jpg')}}" style="width:87px" alt=""></div>
                        <span class="title">Penulis</span>
                        <h4 class="name">{{@$selected['created_by_attr']['name']}}</h4>
                    </div>
                </div>
            </div>

            <!--Sidebar Side-->
            <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                <aside class="sidebar">
                    <!--search box-->
                    <div class="sidebar-widget search-box">
                        <form method="post" action="blog.html">
                            <div class="form-group">
                                <input type="search" name="search-field" value="" placeholder="Search....." required="">
                                <button type="submit"><span class="icon fa fa-search"></span></button>
                            </div>
                        </form>
                    </div>

                    <!-- Latest News -->
                    <div class="sidebar-widget latest-news">
                        <div class="sidebar-title"><h3>Popular Posts</h3></div>
                        <div class="widget-content">
                            <article class="post">
                                <div class="post-thumb"><a href="blog-single.html"><img src="images/resource/post-thumb-1.jpg" alt=""></a></div>
                                <h5><a href="blog-single.html">How to handle your kids’<br>from mystery ailments</a></h5>
                                <div class="post-info">March 20, 2020</div>
                            </article>

                            <article class="post">
                                <div class="post-thumb"><a href="blog-single.html"><img src="images/resource/post-thumb-2.jpg" alt=""></a></div>
                                <h5><a href="blog-single.html">Lung cancer survival rate <br>in England improves</a></h5>
                                <div class="post-info">February 14, 2020</div>
                            </article>

                            <article class="post">
                                <div class="post-thumb"><a href="blog-single.html"><img src="images/resource/post-thumb-3.jpg" alt=""></a></div>
                                <h5><a href="blog-single.html">Negative statin stories add <br>to heart health risk</a></h5>
                                <div class="post-info">January 22, 2021</div>
                            </article>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="sidebar-widget tags">
                        <div class="sidebar-title"><h3>Tag Cloud</h3></div>
                        <ul class="popular-tags clearfix">
                            <li><a href="#">Ideas</a></li>
                            <li><a href="#">Doctor</a></li>
                            <li><a href="#">Health</a></li>
                            <li><a href="#">Department</a></li>
                            <li><a href="#">Nurse</a></li>
                            <li><a href="#">Growth</a></li>
                            <li><a href="#">Expert</a></li>
                            <li><a href="#">Tips</a></li>
                            <li><a href="#">Service</a></li>
                            <li><a href="#">Medical</a></li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>

@endsection
@section('addition_css')
@endsection
@section('addition_script')
@endsection