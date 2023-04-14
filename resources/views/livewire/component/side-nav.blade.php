<div>
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav  accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav  bg-success">

                    <a class="nav-link @if(Request::is('/'))
                    active bg-white text-dark
                    @else
                    text-white
                    @endif" href="{{ url('/', []) }}">
                        <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                     <div class="sb-sidenav-menu-heading">Transaksi</div>
                     <a class="nav-link text-white" href="{{ url('transaksi', []) }}">
                        <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                        Transaksi
                    </a>
                     <a class="nav-link text-white" href="{{ url('transaksi-member', []) }}">
                        <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                        Transaksi member
                    </a>


                    <a class="nav-link text-white collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCustomer" aria-expanded="false" aria-controls="collapseCustomer">
                        <div class="sb-nav-link-icon text-dark"><i class="fas fa-columns"></i></div>
                        Customer
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse show" id="collapseCustomer" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link text-white" href="{{ url('customer', []) }}">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Customer</a>
                            <a class="nav-link text-white" href="layout-sidenav-light.html">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Saldo customer</a>
                        </nav>
                    </div>
                    <a class="nav-link text-white collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMitra" aria-expanded="false" aria-controls="collapseMitra">
                        <div class="sb-nav-link-icon text-dark"><i class="fas fa-columns"></i></div>
                        Mitra
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse show" id="collapseMitra" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link text-white" href="{{ url('mitra', []) }}">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Mitra</a>
                            <a class="nav-link text-white" href="layout-sidenav-light.html">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Saldo</a>
                            <a class="nav-link text-white" href="layout-sidenav-light.html">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Saldo pending</a>
                            <a class="nav-link text-white" href="layout-sidenav-light.html">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Saldo kredit</a>
                        </nav>
                    </div>
                    <a class="nav-link text-white" href="{{ url('iklan-mitra', []) }}">
                        <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                        Iklan mitra
                    </a>
                    <a class="nav-link text-white" href="{{ url('promo', []) }}">
                        <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                        Promo
                    </a>
                    <div class="sb-sidenav-menu-heading">Master</div>
                    <a class="nav-link text-white collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMasterPayment" aria-expanded="false" aria-controls="collapseMasterPayment">
                        <div class="sb-nav-link-icon text-dark"><i class="fas fa-columns"></i></div>
                        Master payment
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseMasterPayment" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link text-white" href="{{ url('metode-pembayaran', []) }}">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Metode pembayaran</a>
                            <a class="nav-link text-white" href="{{ url('bank-perusahaan', []) }}">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Bank perusahaan</a>
                            <a class="nav-link text-white" href="{{ url('bank', []) }}">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Bank tarik saldo</a>
                        </nav>
                    </div>
                    <a class="nav-link text-white collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMasterDaerah" aria-expanded="false" aria-controls="collapseMasterDaerah">
                        <div class="sb-nav-link-icon text-dark"><i class="fas fa-columns"></i></div>
                        Master Daerah
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseMasterDaerah" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link text-white" href="{{ url('provinsi', []) }}">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Provinsi</a>
                            <a class="nav-link text-white" href="{{ url('kota', []) }}">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Kota/kabupaten</a>
                        </nav>
                    </div>
                    <a class="nav-link text-white collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMasterLapangan" aria-expanded="false" aria-controls="collapseMasterLapangan">
                        <div class="sb-nav-link-icon text-dark"><i class="fas fa-columns"></i></div>
                        Master Tempat
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseMasterLapangan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link text-white" href="{{ url('olahraga', []) }}">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Olahraga</a>
                            <a class="nav-link text-white" href="{{ url('fasilitas', []) }}">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Fasilitas</a>
                            <a class="nav-link text-white" href="{{ url('tipe-lapangan', []) }}">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>Tipe Lapangan</a>
                            <a class="nav-link text-white" href="{{ url('alas-lapangan') }}">
                                <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                                Alas Lapangan</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Lainnya</div>

                    <a class="nav-link text-white" href="{{ url('akun', []) }}">
                        <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                       Kelola Akun
                    </a>
                    <a class="nav-link text-white" href="{{ url('setting', []) }}">
                        <div class="sb-nav-link-icon text-dark"><i class="fas fa-tachometer-alt"></i></div>
                        Setting
                    </a>
                    {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Pages
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                Authentication
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="login.html">Login</a>
                                    <a class="nav-link" href="register.html">Register</a>
                                    <a class="nav-link" href="password.html">Forgot Password</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                Error
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="401.html">401 Page</a>
                                    <a class="nav-link" href="404.html">404 Page</a>
                                    <a class="nav-link" href="500.html">500 Page</a>
                                </nav>
                            </div>
                        </nav>
                    </div> --}}

                </div>
            </div>
            <div class="sb-sidenav-footer">
                {{-- <div class="small">Logged in as:</div> --}}
                superadmin
            </div>
        </nav>
    </div>
</div>
