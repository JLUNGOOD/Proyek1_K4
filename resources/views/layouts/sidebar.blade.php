<aside class="main-sidebar bg-primary">
    <a href="" class="brand-link">
        <img src="" alt="PDAM Logo" class="brand-image img-circle elevation-3"
             style="opacity: .9">
        <span class="brand-text font-weight-light">PDAM KOTA Malang</span>
    </a>
    @auth
        @if ($role==1)
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Kegiatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>Informasi</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @else
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Profil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Kegiatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>Informasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>Tanggapan</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        @endif
    @endauth
    
    
</aside>