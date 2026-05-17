<style>
    @font-face {
        font-family: AppleGaramond;
        src: url(Asset/AppleGaramond.ttf) format('truetype');
    }

    .footer-bg {
        background-color: var(--navbar-bg);
        color: var(--text-primary);
        width: 100%;
        margin: 0;
        display: block;
        overflow-x: hidden;
        border-top: 1px solid var(--border-color);
    }

    .footer-content {
        padding: 60px 0;
        font-family: AppleGaramond;
    }

    .footer-content h4, .footer-content h5 {
        margin-bottom: 15px;
        color: var(--text-primary);
    }

    .footer-content p {
        margin-bottom: 0;
        color: var(--text-primary);
        font-family: AppleGaramond;
    }

    /* LOGO */
    .logo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
    }

    /* SOCIAL ICON */
    .social img {
        width: 28px;
        margin-right: 10px;
        border-radius: 0;
    }
</style>
<!-- FOOTER -->
<nav class="footer-bg">
    <div class="footer-content">

        <!-- Title -->
        <h4 class="text-center mb-5">Connect With Us</h4>

        <div class="row align-items-center justify-content-center">

            <!-- LEFT -->
            <div class="col-md-6 d-flex justify-content-center align-items-center ">
                <img src="{{ asset('Asset/Pic/logo.jpeg') }}" class="logo me-3">

                <div>
                    <h5>Wong Tulus</h5>
                    <p>Menghubungkan ketulusan hati, untuk mereka yang tak bersuara.</p>

                    <!-- ICON -->
                    <div class="social mt-3">
                        <img src="{{ asset('Asset/Pic/tiktok.png') }}">
                        <img src="{{ asset('Asset/Pic/gmail.png') }}">
                        <img src="{{ asset('Asset/Pic/instagram.gif') }}">
                        <img src="{{ asset('Asset/Pic/whatsapp.png') }}">
                    </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="col-md-6 justify-content-center d-flex flex-column align-items-center">
                <h5>Universitas Muhammadiyah Surakarta</h5>
                <p>
                    Jl. A. Yani, Mendungan, Pabelan, Kec. Kartasura,<br>
                    Kabupaten Sukoharjo, Jawa Tengah 57169
                </p>
            </div>

        </div>

        <!-- COPYRIGHT -->
        <p class="text-center mt-5"><i>@copyright 2026</i></p>
    </div>
    </div>