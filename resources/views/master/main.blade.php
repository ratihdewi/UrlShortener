<!DOCTYPE html>
<html>
    <head>
      @include('partial.head')  
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="nav-fixed">
        @include('partial.nav')
        <div id="layoutSidenav">
            @include('partial.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
                @include('partial.jsfooter')
                <footer class="footer mt-auto footer-light">
                    @include('partial.footer')
                </footer>
            </div>
        </div>
    </body>
</html>
