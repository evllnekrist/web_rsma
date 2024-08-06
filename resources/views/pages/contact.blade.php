@extends('layouts.app-default', ['breadcrumbs'=>[['label'=>'Kontak']]])
@section('title', 'Kontak')
@section('content')

    <div class="px-5">
        <!-- Map Section -->
        <section class="map-section">
            <div class="auto-container">
                <div class="map-outer"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.5821070871043!2d113.37577407496705!3d-1.918394698064172!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfd1e211ae8e5eb%3A0x41f9fad1bd611159!2sRSUD%20MAS%20AMSYAR!5e0!3m2!1sen!2sid!4v1722828540138!5m2!1sen!2sid" width="1200" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>
        <!-- End Map Section -->
    </div>

@endsection
@section('addition_css')
@endsection
@section('addition_script')
    <script src="{{asset('asset-page/js/sdm.js')}}"></script>
@endsection