{{-- MAIN NAV --}}
    <div id="mySidenav" class="sidenav stripe-shadow-19">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        
        <div class="logo">
            <a href="{{url('/cms')}}"><img src="{{asset('asset/images/logo-rsma.webp')}}" style="height:120px" alt="logo RSUDMA"></a>
        </div>
        <hr style="background: black">
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.page')}}" 
            title="Kelola halaman statis yang memiliki link sendiri">
            <i class="fa fa-id-card mr-3 text-white" aria-hidden="true"></i>
            Halaman
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.post')}}" 
            title="Kelola Berita atau Artikel">
            <i class="fa fa-newspaper mr-3 text-white" aria-hidden="true"></i>
            Berita / Artikel
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.resourceSummary')}}" 
            title="Memastikan informasi sumber daya manusia atau infrastruktur terdata jenis dan jumlahnya">
            <i class="fa fa-chart-bar mr-3 text-white" aria-hidden="true"></i>
            Ikhtisar Sumber Daya
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.resourceDetail')}}" 
            title="Mendata detail sumber daya">
            <i class="fa fa-chart-pie mr-3 text-white" aria-hidden="true"></i>
            Detail Sumber Daya
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.org')}}" 
            title="Mendata jabatan struktural organisasi">
            <i class="fa fa-sitemap mr-3 text-white" aria-hidden="true"></i>
            Struktur Organisasi
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.satisfaction')}}" 
            title="Melihat data kepuasan yang diinput oleh pengguna publik web">
            <i class="fa fa-smile mr-3 text-white" aria-hidden="true"></i>
            Survey Kepuasan
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.web-info')}}" 
            title="Mengatur informasi konfigurasi web">
            <i class="fa fa-cog mr-3 text-white" aria-hidden="true"></i>
            Informasi Web
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.user')}}" 
            title="Kelola admin web">
            <i class="fa fa-user mr-3 text-white" aria-hidden="true"></i>
            {{-- Pengguna Teregistrasi --}}Admin
        </a>
    </div>

    <script>
        isNavOpen = false;

        /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
        function openNav() {
            isNavOpen = true;
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
        function closeNav() {
            isNavOpen = false;
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }

        function executeNav(){
            return isNavOpen?closeNav():openNav();
        }
    </script>
{{-- MAIN NAV END --}}
{{-- INFO NAV --}}
<header class="main-header header-style-four stripe-shadow-19">
    <div class="header-top">
        <div class="auto-container">
            <div class="inner-container">
                <div class="top-left">
                    <ul class="contact-list clearfix">
                        <span onclick="executeNav()">
                            <i class="fas fa-bars"></i> Menu
                        </span>
                    </ul>
                </div>
                <div class="top-right">
                    <div class="btn-group dropleft">
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu">
                            <ul>
                                <li>
                                    <x-dropdown-link :href="route('profile.edit')">
                                        Profil
                                    </x-dropdown-link>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
            
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
{{-- INFO NAV END --}}
