<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <div class="sidenav-menu-heading"></div>
                <a class="nav-link collapsed" href="{{route('dashboard.index')}}" @if(request()->is('/*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i  @if(request()->is('/*')) style="color:#385ac2;font-weight:bold;" @endif data-feather="activity"></i></div>
                    Dashboard
                </a>
                <div class="sidenav-menu-heading">Menu</div>
                <a class="nav-link collapsed" href="{{route('procurement.index')}}" @if(request()->is('procurement*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="external-link" @if(request()->is('procurement*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    Daftar Pengadaan
                </a>
                <a class="nav-link collapsed" href="{{route('sla.index')}}" @if(request()->is('sla*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="external-link" @if(request()->is('sla*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    Sla
                </a>
                <div class="sidenav-menu-heading">Master</div>
                <a class="nav-link collapsed" href="{{route('master.itemcategory.index')}}" @if(request()->is('master/itemcategory*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="columns" @if(request()->is('master/itemcategory*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    Kategori Barang
                </a>
                @if(Auth::user()->role_id!=4 and Auth::user()->role_id!=5)
                
                <a class="nav-link collapsed" href="{{route('vendor.index')}}" @if(request()->is('bidder*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="users" @if(request()->is('bidder*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    Daftar Vendor
                </a>
                @endif
                @if(Auth::user()->role_id==1)
                <a class="nav-link collapsed" href="{{route('master.mechanism.index')}}" @if(request()->is('master/mechanism*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="briefcase" @if(request()->is('master/mechanism*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    Mekanisme Pengadaan
                </a>
                <a class="nav-link collapsed" href="{{route('master.role.index')}}" @if(request()->is('master/role*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="eye" @if(request()->is('master/role*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    Role
                </a>
                <a class="nav-link collapsed" href="{{route('master.spph.index')}}" @if(request()->is('master/spph*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="eye" @if(request()->is('master/spph*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    Data Spph
                </a>
                <a class="nav-link collapsed" href="{{route('master.po.index')}}" @if(request()->is('master/po*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="eye" @if(request()->is('master/po*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    Data PO
                </a>
                <a class="nav-link collapsed" href="{{route('master.sla.index')}}" @if(request()->is('master/sla*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="eye" @if(request()->is('master/sla*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    Data SLA
                </a>
                <a class="nav-link collapsed" href="{{route('master.jabatan.index')}}" @if(request()->is('master/jabatan*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="eye" @if(request()->is('master/jabatan*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    Data Jabatan
                </a>
                <a class="nav-link collapsed" href="{{route('master.mail.index')}}" @if(request()->is('master/mail*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="eye" @if(request()->is('master/mail*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    Data Mail
                </a>
                <a class="nav-link collapsed" href="{{route('master.user.index')}}" @if(request()->is('master/user*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="users" @if(request()->is('master/user*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    User
                </a>
                <a class="nav-link collapsed" href="{{route('vendor.deleted.index')}}" @if(request()->is('deleted-bidder*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="users" @if(request()->is('deleted-bidder*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    Daftar Vendor (Terhapus)
                </a>
                <a class="nav-link collapsed" href="{{route('vendor.terbuka.index')}}" @if(request()->is('tenderterbuka-bidder*')) style="color:#385ac2;font-weight:bold;" @endif>
                    <div class="nav-link-icon"><i data-feather="users" @if(request()->is('tenderterbuka-bidder*')) style="color:#385ac2;font-weight:bold;" @endif></i></div>
                    Daftar Vendor Tender Terbuka
                </a>
                @endif
            </div>
        </div>
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title">{{Auth::user()->name}}</div>
            </div>
        </div>
    </nav>
</div>