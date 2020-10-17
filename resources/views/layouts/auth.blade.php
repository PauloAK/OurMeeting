<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>OurMeeting @yield('title')</title>

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/system.css') }}" rel="stylesheet">
</head>

<body>

    <div class="d-flex" id="wrapper">

        <div id="page-content-wrapper">
            <div class="container-fluid h-100">
                @yield("content")
            </div>

        </div>

    </div>

    <script src="{{ asset('/js/app.js') }}"></script>


</body>

</html>