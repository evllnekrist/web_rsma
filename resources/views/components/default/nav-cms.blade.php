{{-- MAIN NAV --}}
    <div id="mySidenav" class="sidenav stripe-shadow-19">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.page')}}" 
            title="Kelola halaman statis yang memiliki link sendiri">
            Halaman
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.article')}}" 
            title="Kelola Berita atau Artikel">
            Berita / Artikel
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.resource-summary')}}" 
            title="Memastikan informasi sumber daya manusia atau infrastruktur terdata jenis dan jumlahnya">
            Ikhtisar Sumber Daya
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.resource-detail')}}" 
            title="Mendata detail sumber daya">
            Detail Sumber Daya
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.org')}}" 
            title="Mendata jabatan struktural organisasi">
            Struktur Organisasi
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.satisfaction')}}" 
            title="Melihat data kepuasan yang diinput oleh pengguna publik web">
            Survey Kepuasan
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.web-info')}}" 
            title="Mengatur informasi konfigurasi web">
            Informasi Web
        </a>
        <a  data-toggle="tooltip" data-placement="bottom" href="{{route('cms.user')}}" 
            title="Kelola admin web">
            Pengguna Teregistrasi
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
