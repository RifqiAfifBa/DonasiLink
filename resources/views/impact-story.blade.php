@extends('layout.navbarUser')
@section('content')
<style>
    .content-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        margin: 20px auto;
        width: 100%;
        box-sizing: border-box;
        overflow-x: hidden;
    }

    .stories-container {
        width: 100%;
        max-width: 800px;
    }

    .page-title {
        text-align: center;
        font-size: 32px;
        color: #2b1b2f;
        margin-bottom: 40px;
        font-family: 'Instrument Serif-Regular', serif;
    }

    .story-card {
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 8px;
        margin-bottom: 30px;
        box-sizing: border-box;
    }

    .story-header {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .story-image {
        flex-shrink: 0;
        width: 120px;
        height: 120px;
        border-radius: 8px;
        overflow: hidden;
    }

    .story-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .story-meta {
        flex: 1;
    }

    .story-title {
        font-size: 22px;
        color: #2b1b2f;
        margin-bottom: 8px;
        font-family: 'Instrument Serif-Regular', serif;
    }

    .story-author {
        color: #666;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .story-date {
        color: #999;
        font-size: 13px;
    }

    .story-content {
        color: #333;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .story-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .story-stats {
        display: flex;
        gap: 20px;
        font-size: 13px;
        color: #666;
    }

    .story-link {
        color: #CCB3D1;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .story-link:hover {
        color: #b89bc4;
    }

    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px;
        }

        .page-title {
            font-size: 24px;
            margin-bottom: 30px;
        }

        .story-card {
            padding: 20px;
        }

        .story-header {
            flex-direction: column;
        }

        .story-image {
            width: 100%;
            height: 200px;
        }
    }
</style>

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