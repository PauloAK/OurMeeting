<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title') OurMeeting</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/system.css') }}" rel="stylesheet">
    @toastr_css
</head>

<body>

    <div class="d-flex" id="wrapper">

        @include('parts.menu')

        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-light" id="menu-toggle"><i class="fas fa-th"></i></button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout <i class="fas fa-sign-out-alt"></i></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                <div class="main-content border">
                    <div class="row">
                        <div class="col-12 justify-content-between d-flex p-0">      
                            <h2 class="col mb-0">
                                @yield('main-title')
                            </h2>
                            <div class="col text-right">
                                @yield('title-actions')
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>

                    @yield("content")
                </div>
            </div>

        </div>

    </div>

    <script src="{{ asset('/js/app.js') }}"></script>
    @toastr_js
    @toastr_render

    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>

</body>

</html>