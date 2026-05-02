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

    .detail-container {
        display: flex;
        width: 100%;
        max-width: 700px;
        padding: 30px;
        border-radius: 8px;
        box-sizing: border-box;
    }

    .detail-header {
        margin-bottom: 20px;
    }

    .detail-header img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .detail-header h2 {
        font-size: 28px;
        color: #2b1b2f;
        margin-bottom: 10px;
        font-family: 'Instrument Serif-Regular', serif;
    }

    .detail-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 14px;
        color: #666;
    }

    .detail-content {
        color: #333;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .detail-content h3 {
        color: #2b1b2f;
        margin-top: 20px;
        margin-bottom: 10px;
        font-family: 'Instrument Serif-Regular', serif;
    }

    .detail-footer {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .btn-primary {
        flex: 1;
        padding: 12px 20px;
        background-color: #CCB3D1;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none;
        text-align: center;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #b89bc4;
    }

    .btn-secondary {
        flex: 1;
        padding: 12px 20px;
        background-color: #f0f0f0;
        color: #333;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none;
        text-align: center;
        transition: background-color 0.3s;
    }

    .btn-secondary:hover {
        background-color: #e0e0e0;
    }

    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px;
            margin: 15px auto;
        }

        .detail-container {
            padding: 20px;
        }

        .detail-header h2 {
            font-size: 22px;
        }
    }
</style>

<div class="content-wrapper">
    <div class="detail-container" style="background-color: #CCB3D1;">
        <div class="detail-header">
            <img src="{{ asset('Asset/Pic/WhatsApp Image 2026-04-25 at 12.02.13.jpeg') }}" alt="Campaign Detail">
            <h2>Pakan Sehat</h2>
            <div class="detail-meta">
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

    </div>
    <div class="detail-footer">
        <a href="#checkout" class="btn-primary">Donasi Sekarang</a>
        <a href="#campaign-feed" class="btn-secondary">Kembali</a>
    </div>
</div>

@endsection