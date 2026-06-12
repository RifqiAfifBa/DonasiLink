<?php

namespace Database\Seeders;

use App\Models\Kampanye;
use Illuminate\Database\Seeder;

class KampanyeSeeder extends Seeder
{
    public function run(): void
    {
        $kampanyes = [
            [
                'shelter_id' => 1,
                'nama_hewan' => 'Milo',
                'usia_hewan' => '2 Tahun',
                'sedang_sakit' => 'ya',
                'kebutuhan_hewan' => 'Operasi Kaki',
                'deskripsi_hewan' => 'Milo adalah kucing jalanan yang ditemukan dengan luka di kaki kanannya. Kami perlu biaya untuk operasi dan perawatan pasca operasi.',
                'target_donasi' => 5000000,
                'total_terkumpul' => 3250000,
                'status' => 'aktif',
            ],
            [
                'shelter_id' => 1,
                'nama_hewan' => 'Buddy',
                'usia_hewan' => '3 Tahun',
                'sedang_sakit' => 'tidak',
                'kebutuhan_hewan' => 'Makanan Bulanan',
                'deskripsi_hewan' => 'Buddy adalah anjing yang kami selamatkan dari penelantaran. Kami membutuhkan donasi untuk makanan dan vitamin bulanannya.',
                'target_donasi' => 2000000,
                'total_terkumpul' => 2000000,
                'status' => 'selesai',
            ],
            [
                'shelter_id' => 1,
                'nama_hewan' => 'Luna',
                'usia_hewan' => '1 Tahun',
                'sedang_sakit' => 'ya',
                'kebutuhan_hewan' => 'Vaksinasi & Sterilisasi',
                'deskripsi_hewan' => 'Luna adalah kucing betina yang baru kami rescue. Ia membutuhkan vaksinasi lengkap dan sterilisasi agar bisa diadopsi.',
                'target_donasi' => 1500000,
                'total_terkumpul' => 750000,
                'status' => 'aktif',
            ],
            [
                'shelter_id' => 1,
                'nama_hewan' => 'Charlie',
                'usia_hewan' => '5 Bulan',
                'sedang_sakit' => 'tidak',
                'kebutuhan_hewan' => 'Tempat Tinggal & Makanan',
                'deskripsi_hewan' => 'Charlie adalah anak kucing yang dipisahkan dari induknya. Kami perlu biaya untuk kandang, makanan, dan perawatan sehari-hari.',
                'target_donasi' => 3000000,
                'total_terkumpul' => 500000,
                'status' => 'aktif',
            ],
        ];

        foreach ($kampanyes as $kampanye) {
            Kampanye::create($kampanye);
        }

        $this->command->info('4 kampanye tambahan berhasil dibuat!');
    }
}