<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>DonasiLink</title>
    <link rel="stylesheet" href="{{ Asset('css/style.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scrollbar-gutter: stable;
        }

        body {
            overflow-x: hidden;
        }

        @font-face {
            font-family: InstrumentSerif-Regular;
            src: url(Asset/InstrumentSerif-Regular.ttf) format("truetype");
        }

        nav {
            background-color: #CCB3D1;
        }

        h5,
        .me-3,
        .login-btn {
            color: #FFFFFF;
            font-family: InstrumentSerif-Regular;
        }
    </style>
</head>

<body>
    <!-- NAVBAR USER-->
    <nav class="user">
        <div class="container py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5>$ DonasiLink</h5>
                <div>
                    <a href="#" class="me-3">Dahsboard</a>
                    <a href="#">|</a>
                    <a href="#" class="login-btn ms-3" style="background-color: #2b1b2f;">Log In</a>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    @include('layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>