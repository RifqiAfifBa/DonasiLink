@extends('layouts.public')

@section('title', 'Impact Story')

@section('content')
@php
    $stories = [
        [
            'title' => 'Pakan Sehat Mengubah Usaha Ternak Ibu Siti',
            'author' => 'Ibu Siti, Petani Ternak',
            'date' => '15 Maret 2026',
            'image' => 'Asset/Pic/WhatsApp Image 2026-04-25 at 12.02.13.jpeg',
            'paragraphs' => [
                'Ibu Siti adalah petani ternak dari Sukoharjo yang telah berjuang selama bertahun-tahun untuk menyediakan pakan berkualitas bagi ternak miliknya. Dengan program Pakan Sehat dari Wong Tulus, hidupnya berubah total.',
                '"Saya sangat bersyukur. Sebelumnya, ternak saya sering sakit karena pakan yang kurang berkualitas. Sekarang dengan pakan dari program ini, produktivitas meningkat 40% dan ternak jauh lebih sehat," ungkap Ibu Siti.',
                'Dampaknya tidak hanya terasa pada usaha Ibu Siti, tetapi juga keluarganya. Sekarang ketiga anaknya bisa sekolah dengan lebih baik, dan kehidupan keluarga menjadi lebih stabil.',
            ],
            'likes' => 234,
            'comments' => 45,
        ],
        [
            'title' => 'Dari Kesulitan Menjadi Harapan',
            'author' => 'Pak Budi, Peternak Kambing',
            'date' => '22 Maret 2026',
            'image' => 'Asset/Pic/WhatsApp Image 2026-04-25 at 12.02.13.jpeg',
            'paragraphs' => [
                'Pak Budi adalah peternak kambing yang hampir menyerah dengan usahanya. Modal terbatas dan harga pakan yang terus naik membuat bisnisnya hampir bangkrut.',
                'Dengan bantuan dari Wong Tulus, Pak Budi mendapatkan pakan berkualitas dengan harga yang terjangkau. Dalam 6 bulan, pendapatannya meningkat dua kali lipat.',
                '"Saya sangat berterima kasih. Program ini sungguh menyelamatkan bisnis saya. Sekarang saya bisa memperluas usaha," tutur Pak Budi.',
            ],
            'likes' => 189,
            'comments' => 32,
        ],
        [
            'title' => 'Hamil Sehat untuk Masa Depan yang Cerah',
            'author' => 'Ibu Wati, Ibu Hamil',
            'date' => '8 April 2026',
            'image' => 'Asset/Pic/WhatsApp Image 2026-04-25 at 12.02.13.jpeg',
            'paragraphs' => [
                'Program Hamil Sehat bukan hanya tentang kesehatan ibu hamil, tetapi juga tentang memberikan harapan bagi generasi masa depan.',
                'Dengan dukungan medis dan nutrisi yang tepat, Ibu Wati dapat menjalani kehamilan yang lebih nyaman dan aman.',
                '"Saya merasa sangat diperhatikan dan didukung. Sekarang bayi saya tumbuh dengan sehat dan cerdas," kata Ibu Wati.',
            ],
            'likes' => 312,
            'comments' => 78,
        ],
    ];
@endphp

<section class="max-w-5xl mx-auto px-6 lg:px-8 py-12 lg:py-16">
    <div class="text-center max-w-2xl mx-auto">
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100 dark:bg-brand-900/40 text-brand-700 dark:text-brand-200 text-xs font-bold uppercase tracking-wider">
            <i class="fas fa-quote-left"></i> Impact Story
        </span>
        <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-ink-900 dark:text-white">Kisah Dampak Nyata</h1>
        <p class="mt-3 text-ink-500 dark:text-ink-400">Setiap donasi membawa perubahan. Inilah cerita mereka yang telah Anda bantu.</p>
    </div>

    <div class="mt-12 space-y-8">
        @foreach($stories as $story)
            <article class="bg-white dark:bg-ink-800 border border-ink-200 dark:border-ink-700 rounded-3xl overflow-hidden shadow-[0_1px_3px_rgba(15,23,42,0.05)] hover:shadow-[0_16px_40px_rgba(124,58,237,0.10)] transition-shadow">
                <div class="grid md:grid-cols-[280px_1fr]">
                    <div class="bg-gradient-to-br from-brand-100 to-fuchsia-100 dark:from-ink-700 dark:to-ink-800 md:h-full h-56">
                        <img src="{{ asset($story['image']) }}" alt="{{ $story['author'] }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-7">
                        <h2 class="text-xl font-bold text-ink-900 dark:text-white">{{ $story['title'] }}</h2>
                        <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-ink-500 dark:text-ink-400">
                            <span><i class="fas fa-user mr-1 text-brand-500"></i> {{ $story['author'] }}</span>
                            <span><i class="fas fa-calendar mr-1 text-brand-500"></i> {{ $story['date'] }}</span>
                        </div>
                        <div class="mt-4 space-y-3 text-sm text-ink-600 dark:text-ink-300 leading-relaxed">
                            @foreach($story['paragraphs'] as $p)
                                <p>{{ $p }}</p>
                            @endforeach
                        </div>
                        <div class="mt-5 pt-5 border-t border-ink-200 dark:border-ink-700 flex items-center justify-between">
                            <div class="flex items-center gap-4 text-xs text-ink-500 dark:text-ink-400">
                                <span><i class="fas fa-heart text-rose-500 mr-1"></i> {{ $story['likes'] }} Suka</span>
                                <span><i class="fas fa-comment text-brand-500 mr-1"></i> {{ $story['comments'] }} Komentar</span>
                            </div>
                            <a href="#" class="text-sm font-semibold text-brand-600 dark:text-brand-300 hover:underline inline-flex items-center gap-1">
                                Baca Selengkapnya <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endsection
