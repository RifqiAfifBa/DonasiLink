@extends('layout.navbarUser')
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="content-wrapper">
    <h1 class="page-title">Kisah Dampak Nyata</h1>

    <div class="stories-container">
        <div class="story-card">
            <div class="story-header">
                <div class="story-image">
                    <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.02.13.jpeg') }}" alt="Ibu Siti">
                </div>
                <div class="story-meta">
                    <h3 class="story-title">Pakan Sehat Mengubah Usaha Ternak Ibu Siti</h3>
                    <p class="story-author">👤 Ibu Siti, Petani Ternak</p>
                    <p class="story-date">📅 15 Maret 2026</p>
                </div>
            </div>

            <div class="story-content">
                <p>
                    Ibu Siti adalah petani ternak dari Sukoharjo yang telah berjuang selama bertahun-tahun untuk menyediakan
                    pakan berkualitas bagi ternak miliknya. Dengan program Pakan Sehat dari Wong Tulus, hidupnya berubah total.
                </p>
                <p>
                    "Saya sangat bersyukur. Sebelumnya, ternak saya sering sakit karena pakan yang kurang berkualitas. Sekarang,
                    dengan pakan dari program ini, produktivitas meningkat 40% dan ternak jauh lebih sehat. Penghasilan saya
                    naik signifikan," ungkap Ibu Siti dengan senyuman.
                </p>
                <p>
                    Dampaknya tidak hanya terasa pada usaha Ibu Siti, tetapi juga keluarganya. Sekarang ketiga anaknya bisa
                    sekolah dengan lebih baik, dan kehidupan keluarga menjadi lebih stabil.
                </p>
            </div>

            <div class="story-footer">
                <div class="story-stats">
                    <span>❤️ 234 Suka</span>
                    <span>💬 45 Komentar</span>
                </div>
                <a href="#" class="story-link">Baca Selengkapnya →</a>
            </div>
        </div>

        <div class="story-card">
            <div class="story-header">
                <div class="story-image">
                    <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.02.13.jpeg') }}" alt="Pak Budi">
                </div>
                <div class="story-meta">
                    <h3 class="story-title">Dari Kesulitan Menjadi Harapan</h3>
                    <p class="story-author">👤 Pak Budi, Peternak Kambing</p>
                    <p class="story-date">📅 22 Maret 2026</p>
                </div>
            </div>

            <div class="story-content">
                <p>
                    Pak Budi adalah peternak kambing yang hampir menyerah dengan usahanya. Modal terbatas dan harga pakan yang
                    terus naik membuat bisnisnya hampir bangkrut. Namun semuanya berubah ketika ia mengenal program Pakan Sehat.
                </p>
                <p>
                    Dengan bantuan dari Wong Tulus, Pak Budi mendapatkan pakan berkualitas dengan harga yang terjangkau. Hasilnya
                    luar biasa - ternak kambingnya tumbuh lebih cepat dan sehat. Dalam 6 bulan, pendapatannya meningkat dua kali lipat.
                </p>
                <p>
                    "Saya sangat berterima kasih kepada Wong Tulus. Program ini sungguh menyelamatkan bisnis saya. Sekarang saya
                    bisa memperluas usaha dan memberikan pekerjaan kepada anak saya," tutur Pak Budi.
                </p>
            </div>

            <div class="story-footer">
                <div class="story-stats">
                    <span>❤️ 189 Suka</span>
                    <span>💬 32 Komentar</span>
                </div>
                <a href="#" class="story-link">Baca Selengkapnya →</a>
            </div>
        </div>

        <div class="story-card">
            <div class="story-header">
                <div class="story-image">
                    <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.02.13.jpeg') }}" alt="Ibu Wati">
                </div>
                <div class="story-meta">
                    <h3 class="story-title">Hamil Sehat untuk Masa Depan yang Cerah</h3>
                    <p class="story-author">👤 Ibu Wati, Ibu Hamil</p>
                    <p class="story-date">📅 8 April 2026</p>
                </div>
            </div>

            <div class="story-content">
                <p>
                    Program Hamil Sehat bukan hanya tentang kesehatan ibu hamil, tetapi juga tentang memberikan harapan bagi
                    generasi masa depan. Ibu Wati adalah salah satu peserta yang merasakan manfaatnya.
                </p>
                <p>
                    Dengan dukungan medis dan nutrisi yang tepat dari program Hamil Sehat, Ibu Wati dapat menjalani kehamilan
                    yang lebih nyaman dan aman. Bayi yang dilahirkannya lahir dalam kondisi sehat dan cukup bulan.
                </p>
                <p>
                    "Saya merasa sangat diperhatikan dan didukung selama hamil. Tim medis dari Wong Tulus sangat profesional dan
                    peduli. Sekarang bayi saya tumbuh dengan sehat dan cerdas," kata Ibu Wati dengan penuh kebahagiaan.
                </p>
            </div>

            <div class="story-footer">
                <div class="story-stats">
                    <span>❤️ 312 Suka</span>
                    <span>💬 78 Komentar</span>
                </div>
                <a href="#" class="story-link">Baca Selengkapnya →</a>
            </div>
        </div>
    </div>
</div>

@endsection