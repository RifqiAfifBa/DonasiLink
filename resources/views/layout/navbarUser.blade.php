<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>DonasiLink</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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
            margin: 0;
            padding: 0;
        }

        h5 {
            color: #4a4a4a;
            font-family: InstrumentSerif-Regular;
            font-weight: 600;
            margin: 0;
        }

        .me-3 {
            color: #FFFFFF;
            font-family: InstrumentSerif-Regular;
        }

        a {
            color: #FFFFFF;
            font-family: InstrumentSerif-Regular;
            text-decoration: none;
            font-size: 20px;
        }

        .login-btn {
            background-color: #2b1b2f;
            color: #FFFFFF;
            font-family: InstrumentSerif-Regular;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- NAVBAR USER-->
    <nav class="user">
        <div class="container" style="padding: 12px 0; margin: 0;">
            <div class="d-flex align-items-center w-100">
                <!-- LEFT (Logo) -->
                <div class="d-flex justify-content-center px-3" style="flex: 1;">
                    <h5 style="color: #4a4a4a; font-weight: 600;">$ DonasiLink</h5>
                </div>

                <!-- RIGHT (Menu) -->
                <div class="d-flex justify-content-end px-3" style="flex: 1;">
                    <div style="display: flex; gap: 1.5rem; align-items: center;">
                        <a href="#">Dashboard</a>
                        <span style="color: #ffffff; font-family: InstrumentSerif-Regular;">|</span>
                        <a href="#">Impact Story</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    @include('layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>