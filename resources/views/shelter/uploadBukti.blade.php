@extends('layouts.shelter')

@section('title', 'Upload Bukti Pengeluaran')

@section('content')
<section class="max-w-3xl mx-auto px-6 py-10 lg:py-14">
    <nav class="flex items-center gap-2 text-sm mb-6">
        <a href="{{ route('shelter.landingpage') }}" class="text-brand-600 dark:text-brand-300 font-medium hover:underline"><i class="fas fa-home mr-1"></i>Dashboard</a>
        <span class="text-ink-300">/</span>
        <a href="{{ route('shelter.uploadStruk') }}" class="text-brand-600 dark:text-brand-300 font-medium hover:underline">Riwayat Penarikan</a>
        <span class="text-ink-300">/</span>
        <span class="text-ink-500 dark:text-ink-400">Upload Bukti</span>
    </nav>

    <div>
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 text-xs font-bold uppercase tracking-wider">
            <i class="fas fa-shield-halved"></i> Transparansi Dana
        </span>
        <h1 class="mt-3 text-3xl font-extrabold text-ink-900 dark:text-white">Bukti Pengeluaran Dana</h1>
        <p class="mt-2 text-ink-500 dark:text-ink-400">Unggah bukti pengeluaran (struk/nota/foto) dan jelaskan rincian penggunaan dana. Donatur akan melihat ini di halaman kampanye sebagai bentuk pertanggungjawaban transparan.</p>
    </div>

    <x-card padding="p-6" class="mt-7 bg-brand-50 dark:bg-brand-900/20 border-brand-200 dark:border-brand-800/50">
        <div class="flex flex-wrap items-center gap-6">
            <div>
                <p class="text-xs text-ink-500 dark:text-ink-400">Kampanye</p>
                <p class="text-base font-bold text-ink-900 dark:text-white">{{ $penarikan->kampanye->nama_hewan ?? '—' }}</p>
            </div>
            <div>
                <p class="text-xs text-ink-500 dark:text-ink-400">Nominal Disetujui</p>
                <p class="text-base font-extrabold text-brand-700 dark:text-brand-300">Rp {{ number_format($penarikan->total_penarikan, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-xs text-ink-500 dark:text-ink-400">Tanggal Disetujui</p>
                <p class="text-base font-semibold text-ink-900 dark:text-white">{{ $penarikan->tanggal_disetujui?->format('d M Y, H:i') ?? '—' }}</p>
            </div>
            <div>
                <p class="text-xs text-ink-500 dark:text-ink-400">Rekening</p>
                <p class="text-sm font-semibold text-ink-900 dark:text-white">{{ $penarikan->bank }} · {{ $penarikan->nomor_rekening }}</p>
            </div>
        </div>
    </x-card>

    @if($errors->any())
        <x-alert type="danger" class="mt-6">
            <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </x-alert>
    @endif

    <x-card padding="p-7 sm:p-10" class="mt-6">
        <form action="{{ route('shelter.bukti.store', $penarikan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-7">
            @csrf

            <x-form.group label="Foto Bukti Pengeluaran" for="bukti_pengeluaran" required hint="Format JPG/PNG/WEBP, maksimal 4 MB. Pastikan foto jelas terbaca.">
                <div id="uploadZone" class="relative rounded-2xl border-2 border-dashed border-ink-200 dark:border-ink-700 bg-ink-50 dark:bg-ink-900 hover:border-brand-400 hover:bg-brand-50/30 dark:hover:bg-ink-800 transition-colors cursor-pointer overflow-hidden">
                    <input type="file" name="bukti_pengeluaran" id="bukti_pengeluaran" accept="image/*" required class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImg(this)">
                    <img src="" id="img-preview" alt="Preview" class="hidden w-full h-64 object-contain bg-ink-100 dark:bg-ink-800">
                    <button type="button" id="changeBtn" class="hidden absolute bottom-3 right-3 z-20 px-3 py-1.5 rounded-full bg-ink-900/70 text-white text-xs font-semibold backdrop-blur-sm hover:bg-ink-900" onclick="document.getElementById('bukti_pengeluaran').click()">
                        <i class="fas fa-camera mr-1"></i>Ganti Foto
                    </button>
                    <div id="uploadPlaceholder" class="flex flex-col items-center justify-center py-12 text-center">
                        <div class="w-14 h-14 rounded-2xl btn-gradient flex items-center justify-center text-white text-xl shadow-lg mb-3">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <p class="text-sm font-semibold text-ink-900 dark:text-white">Klik atau seret foto struk/nota</p>
                        <p class="mt-1 text-xs text-ink-500 dark:text-ink-400">JPG, PNG, WEBP &middot; Maks 4MB</p>
                    </div>
                </div>
            </x-form.group>

            <x-form.group label="Deskripsi Penggunaan Dana" for="deskripsi_penggunaan" required hint="Jelaskan secara rinci untuk apa dana ini digunakan. Minimal 20 karakter.">
                <textarea id="deskripsi_penggunaan" name="deskripsi_penggunaan" rows="6" required minlength="20" maxlength="2000"
                          oninput="document.getElementById('charCount').textContent = this.value.length"
                          class="block w-full px-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500 resize-y min-h-[160px]"
                          placeholder="Contoh:&#10;- Biaya konsultasi & operasi tumor: Rp 350.000&#10;- Obat antibiotik 7 hari: Rp 80.000&#10;- Perban dan vitamin: Rp 70.000&#10;Operasi dilakukan di Klinik Hewan ABC tanggal 20 Mei 2026, dan kondisi Milo saat ini sudah membaik.">{{ old('deskripsi_penggunaan') }}</textarea>
                <p class="mt-1 text-xs text-ink-400 text-right"><span id="charCount">0</span>/2000 karakter</p>
            </x-form.group>

            <div class="flex items-start gap-2 p-3 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 text-xs">
                <i class="fas fa-eye shrink-0 mt-0.5"></i>
                <span>Foto dan deskripsi ini akan <strong>tampil publik</strong> di halaman kampanye sebagai bukti transparansi kepada donatur.</span>
            </div>

            <div class="flex flex-col-reverse sm:flex-row gap-3 pt-3">
                <x-button :href="route('shelter.uploadStruk')" variant="ghost" size="lg" icon="arrow-left">Batal</x-button>
                <x-button type="submit" variant="primary" size="lg" icon="cloud-arrow-up" class="sm:flex-1">Unggah Bukti Pengeluaran</x-button>
            </div>
        </form>
    </x-card>
</section>

@push('scripts')
<script>
function previewImg(input) {
    const file = input.files && input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        const preview = document.getElementById('img-preview');
        const placeholder = document.getElementById('uploadPlaceholder');
        const changeBtn = document.getElementById('changeBtn');
        preview.src = e.target.result;
        preview.classList.remove('hidden');
        placeholder?.classList.add('hidden');
        changeBtn?.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}
document.addEventListener('DOMContentLoaded', () => {
    const ta = document.getElementById('deskripsi_penggunaan');
    if (ta) document.getElementById('charCount').textContent = ta.value.length;

    const zone = document.getElementById('uploadZone');
    zone.addEventListener('dragover', (e) => { e.preventDefault(); zone.classList.add('border-brand-500'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('border-brand-500'));
    zone.addEventListener('drop', (e) => {
        e.preventDefault();
        zone.classList.remove('border-brand-500');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            document.getElementById('bukti_pengeluaran').files = e.dataTransfer.files;
            previewImg({ files: e.dataTransfer.files });
        }
    });
});
</script>
@endpush
@endsection
