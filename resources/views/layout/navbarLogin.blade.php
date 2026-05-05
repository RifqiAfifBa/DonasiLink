<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>DonasiLink</title>
    <link rel="stylesheet" href="{{ Asset('css/style.css') }}">
</head>

<body>
    <!-- NAVBAR LOGIN-->
    <div class="container py-3 navbar-login">
        <div class="d-flex justify-content-between align-items-center">
            <h5>$ DonasiLink</h5>
            <div>
                <a href="#" class="me-3">Register</a>
                |
                <a href="#" class="login-btn ms-3" style="background-color: #CCB3D1!important;color:white;">Log In</a>
            </div>
        </div>
    </div>
    @yield('content')
    @include('layout.footer')

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>