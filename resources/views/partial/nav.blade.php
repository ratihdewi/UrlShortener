<nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
    <a class="navbar-brand" href="{{route('dashboard.index')}}"><center>SANDRA</center></a>
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i data-feather="menu"></i></button>
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" onclick="location.reload()"><i data-feather="refresh-cw"></i></button>
    <ul class="navbar-nav align-items-center ml-auto">
        @if(Auth::user()->is_pengadaan > 0)
            @if (Auth::user()->role_id == 1)
                SUPER ADMIN &nbsp;&nbsp;&nbsp;
            @elseif (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                TIM PENGADAAN &nbsp;&nbsp;&nbsp;
            @else
                USER &nbsp;&nbsp;&nbsp;
            @endif
        @endif
        <li class="nav-item dropdown no-caret mr-2 dropdown-user">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="{{asset('img/laptop-user.png')}}" /></a>
            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img" src="{{asset('img/laptop-user.png')}}" />
                    <div class="dropdown-user-details">  
                        <div class="dropdown-user-details-name">{{Auth::user()->name}}</div>
                        <div class="dropdown-user-details-email">{{Auth::user()->email}}</div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                @if(Auth::user()->is_pengadaan > 0)
                    <a class="dropdown-item" href="{{route('user.change.type')}}">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Change Type
                    </a>
                @endif
                <a class="dropdown-item" id="btn-logout" href="">
                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

<script type="text/javascript">
    $('#btn-logout').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: 'Apakah Anda yakin ingin keluar?',
            type: 'warning',
            confirmButtonColor: '#d26a5c',
            confirmButtonText: 'Ya!',
            showCancelButton: true,
            cancelButtonText: 'Batal!',
            html: false,
            preConfirm: function() {
                return new Promise(function (resolve) {
                    setTimeout(function () {
                        resolve();
                    }, 50);
                });
            }
        }).then(function(result){
            if (result.value) {
                // form action delete
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>