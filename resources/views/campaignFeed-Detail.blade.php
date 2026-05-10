@extends('layout.navbarUser')
@section('content')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="content-wrapper justify-content-center d-flex flex-column align-items-center pt-5 pb-5 text-center">
    <div class="detail-container">
        <div class="detail-header">
            <img class="detail-image" src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.02.13.jpeg') }}" alt="Campaign Detail">
            <h2 class="detail-title">Pakan Sehat</h2>

            <div class="detail-content">
                <h3>Tentang Kampanye</h3>
                <p>
                    Program Pakan Sehat adalah inisiatif yang bertujuan untuk memberikan nutrisi terbaik bagi hewan-hewan ternak
                    milik petani lokal. Kami percaya bahwa kesehatan hewan adalah fondasi dari kesejahteraan petani dan keberlanjutan
                    pertanian lokal.
                </p>

                <h3>Target dan Manfaat</h3>
                <p>
                    Dengan program ini, kami menargetkan untuk membantu 100 petani di wilayah Sukoharjo mendapatkan akses ke pakan
                    berkualitas tinggi dengan harga terjangkau. Manfaatnya termasuk peningkatan produktivitas ternak, kesehatan yang
                    lebih baik, dan pendapatan petani yang lebih stabil.
                </p>

                <h3>Bagaimana Anda Dapat Membantu</h3>
                <p>
                    Setiap donasi Anda akan langsung membantu petani lokal mendapatkan pakan berkualitas. Anda dapat memilih untuk
                    mendukung 1 ekor ternak, 5 ekor ternak, atau lebih. Semua kontribusi akan membuat perbedaan nyata bagi komunitas
                    petani kami.
                </p>
            </div>
        </div>
    </div>

    <div class="detail-footer">
        <a href="CampaignFeed" class="btn-secondary text-center detail-btn">Kembali</a>
        <a href="Checkout" class="btn-primary text-center detail-btn">Donasi Sekarang</a>
    </div>
</div>

@endsection