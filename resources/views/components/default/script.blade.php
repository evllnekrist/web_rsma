
<script>
    const assetUrl = "{{asset('/')}}";
    const accept_mimes = JSON.parse(`{!! json_encode(Config::get('app.accept_mimes')) !!}`);
    // const accept_extensions = JSON.parse(`{!! json_encode(Config::get('app.accept_extensions')) !!}`);
</script>
<script src="{{asset('asset/js/jquery.js')}}"></script>  
<script src="{{asset('asset/js/popper.min.js')}}"></script>
<script src="{{asset('asset/js/bootstrap.min.js')}}"></script>
<script src="{{asset('asset/js/jquery.fancybox.js')}}"></script>
<script src="{{asset('asset/js/jquery.modal.min.js')}}"></script>
<script src="{{asset('asset/js/mmenu.polyfills.js')}}"></script>
<script src="{{asset('asset/js/mmenu.js')}}"></script>
<script src="{{asset('asset/js/appear.js')}}"></script>
<script src="{{asset('asset/js/mixitup.js')}}"></script>
<script src="{{asset('asset/js/owl.js')}}"></script>
<script src="{{asset('asset/js/wow.js')}}"></script>
<script src="{{asset('asset/js/script.js')}}"></script>
<script src="{{asset('asset/js/dayjs.min.js')}}"></script>
<script src="{{asset('asset/js/iziToast.js')}}"></script>
<script src="{{asset('asset/js/select2.min.js')}}"></script>
<script src="{{asset('asset/js/axios.min.js')}}"></script>
<script src="{{asset('asset-page/js/app.js').'?v='.date('YmdH').'2' }}"></script>