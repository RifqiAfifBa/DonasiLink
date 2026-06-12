@extends('layouts.shelter')

@section('title', 'Buat Kampanye')

@section('content')
<section class="max-w-3xl mx-auto px-6 py-10 lg:py-14">
    <nav class="flex items-center gap-2 text-sm mb-6">
        <a href="{{ route('shelter.landingpage') }}" class="text-brand-600 dark:text-brand-300 font-medium hover:underline"><i class="fas fa-home mr-1"></i>Dashboard</a>
        <span class="text-ink-300">/</span>
        <span class="text-ink-500 dark:text-ink-400">Buat Kampanye Baru</span>
    </nav>

    <h1 class="text-3xl font-extrabold text-ink-900 dark:text-white">🐾 Buat Kampanye Baru</h1>
    <p class="mt-2 text-ink-500 dark:text-ink-400">Isi informasi hewan dan kebutuhan donasi untuk membuat kampanye.</p>

    @if($errors->any())
        <x-alert type="danger" class="mt-6">
            <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </x-alert>
    @endif

    <x-card padding="p-7 sm:p-10" class="mt-7">
        <form action="{{ route('shelter.storeKampanye') }}" method="POST" enctype="multipart/form-data" id="campForm" class="space-y-8">
            @csrf

            <section>
                <p class="text-[11px] font-bold uppercase tracking-widest text-brand-600 dark:text-brand-300 mb-3 pb-2 border-b border-ink-100 dark:border-ink-700"><i class="fas fa-image mr-2"></i>Foto Hewan</p>
                <div id="uploadZone" class="relative rounded-2xl border-2 border-dashed border-ink-200 dark:border-ink-700 bg-ink-50 dark:bg-ink-900 hover:border-brand-400 hover:bg-brand-50/30 dark:hover:bg-ink-800 transition-colors cursor-pointer overflow-hidden">
                    <input type="file" name="image" id="imageInput" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImg(this)">
                    <img src="" id="img-preview" alt="Preview" class="hidden w-full h-56 object-cover">
                    <button type="button" id="changeBtn" class="hidden absolute bottom-3 right-3 z-20 px-3 py-1.5 rounded-full bg-ink-900/70 text-white text-xs font-semibold backdrop-blur-sm hover:bg-ink-900" onclick="document.getElementById('imageInput').click()">
                        <i class="fas fa-camera mr-1"></i>Ganti Foto
                    </button>
                    <div id="uploadPlaceholder" class="flex flex-col items-center justify-center py-12 text-center">
                        <div class="w-14 h-14 rounded-2xl btn-gradient flex items-center justify-center text-white text-xl shadow-lg mb-3">
                            <i class="fas fa-cloud-arrow-up"></i>
                        </div>
                        <p class="text-sm font-semibold text-ink-900 dark:text-white">Klik atau seret foto ke sini</p>
                        <p class="mt-1 text-xs text-ink-500 dark:text-ink-400">Format: JPG, PNG, WEBP &middot; Maks 2MB</p>
                    </div>
                </div>
            </section>

            <section>
                <p class="text-[11px] font-bold uppercase tracking-widest text-brand-600 dark:text-brand-300 mb-3 pb-2 border-b border-ink-100 dark:border-ink-700"><i class="fas fa-paw mr-2"></i>Informasi Hewan</p>

                <div class="grid sm:grid-cols-2 gap-4">
                    <x-form.group label="Nama Hewan" for="nama_hewan" required>
                        <x-form.input name="nama_hewan" id="nama_hewan" placeholder="cth: Milo, Buddy..." :value="old('nama_hewan')" required />
                    </x-form.group>
                    <x-form.group label="Usia Hewan" for="usia_hewan" required>
                        <x-form.input name="usia_hewan" id="usia_hewan" placeholder="cth: 2 tahun, 6 bulan..." :value="old('usia_hewan')" required />
                    </x-form.group>
                </div>

                <x-form.group label="Kebutuhan Hewan" for="kebutuhan_hewan" required>
                    <x-form.input name="kebutuhan_hewan" id="kebutuhan_hewan" placeholder="cth: Obat-obatan, Vaksin, Operasi, Makanan harian..." :value="old('kebutuhan_hewan')" required />
                </x-form.group>

                <x-form.group label="Kondisi Kesehatan" required>
                    <div class="grid sm:grid-cols-2 gap-3">
                        @foreach([
                            ['val' => 'ya',    'icon' => 'heartbeat',    'title' => 'Sedang Sakit', 'sub' => 'Membutuhkan perawatan medis', 'tone' => 'danger'],
                            ['val' => 'tidak', 'icon' => 'check-circle', 'title' => 'Sehat',        'sub' => 'Kebutuhan dasar (makan, dll)', 'tone' => 'success'],
                        ] as $opt)
                            <label class="relative flex items-center gap-3 p-4 rounded-2xl border-2 cursor-pointer transition-all
                                          border-ink-200 dark:border-ink-700 hover:border-brand-300
                                          has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50 dark:has-[:checked]:bg-brand-900/30">
                                <input type="radio" name="sedang_sakit" value="{{ $opt['val'] }}" {{ old('sedang_sakit') === $opt['val'] ? 'checked' : '' }} class="sr-only peer">
                                <span class="w-10 h-10 rounded-xl flex items-center justify-center
                                    {{ $opt['tone'] === 'danger' ? 'bg-rose-100 text-rose-600 dark:bg-rose-900/40 dark:text-rose-300' : 'bg-emerald-100 text-emerald-600 dark:bg-emerald-900/40 dark:text-emerald-300' }}">
                                    <i class="fas fa-{{ $opt['icon'] }}"></i>
                                </span>
                                <div>
                                    <p class="text-sm font-bold text-ink-900 dark:text-white">{{ $opt['title'] }}</p>
                                    <p class="text-xs text-ink-500 dark:text-ink-400">{{ $opt['sub'] }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>
                </x-form.group>

                <x-form.group label="Deskripsi" for="deskripsi_hewan" required hint="Ceritakan kondisi hewan secara detail untuk menarik donatur.">
                    <textarea id="deskripsi_hewan" name="deskripsi_hewan" rows="5" required maxlength="1000"
                              oninput="document.getElementById('charCount').textContent = this.value.length"
                              class="block w-full px-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500 resize-y min-h-[140px]"
                              placeholder="Tuliskan cerita tentang hewan ini, kondisinya, dan kenapa ia membutuhkan bantuan...">{{ old('deskripsi_hewan') }}</textarea>
                    <p class="mt-1 text-xs text-ink-400 text-right"><span id="charCount">0</span>/1000 karakter</p>
                </x-form.group>
            </section>

            <section>
                <p class="text-[11px] font-bold uppercase tracking-widest text-brand-600 dark:text-brand-300 mb-3 pb-2 border-b border-ink-100 dark:border-ink-700"><i class="fas fa-bullseye mr-2"></i>Target Donasi</p>
                <x-form.group label="Jumlah Target" for="target_donasi" required hint="Masukkan jumlah dana yang dibutuhkan.">
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-ink-500 dark:text-ink-400 font-semibold text-sm z-10">Rp</span>
                        <input type="number" id="target_donasi" name="target_donasi" min="100000" step="10000" required
                               value="{{ old('target_donasi', 100000) }}"
                               oninput="validateTarget()"
                               class="block w-full pl-12 pr-14 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none">
                        <div class="absolute right-1 top-1/2 -translate-y-1/2 flex flex-col">
                            <button type="button" onclick="stepper(10000)"
                                    class="px-3 py-0.5 rounded-t-lg hover:bg-ink-100 dark:hover:bg-ink-700 text-ink-500 dark:text-ink-400 transition-colors leading-none">
                                <i class="fas fa-chevron-up text-xs"></i>
                            </button>
                            <button type="button" onclick="stepper(-10000)"
                                    class="px-3 py-0.5 rounded-b-lg hover:bg-ink-100 dark:hover:bg-ink-700 text-ink-500 dark:text-ink-400 transition-colors leading-none">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                        </div>
                    </div>
                    <p id="targetWarning" class="mt-1.5 text-xs text-rose-600 dark:text-rose-400 hidden"><i class="fas fa-exclamation-circle mr-1"></i>Tidak bisa kurang dari 100.000</p>
                </x-form.group>
            </section>

            <div class="flex flex-col-reverse sm:flex-row gap-3 pt-3">
                <x-button :href="route('shelter.landingpage')" variant="ghost" size="lg" icon="arrow-left">Batal</x-button>
                <x-button type="submit" variant="primary" size="lg" icon="paper-plane" class="sm:flex-1">Publikasikan Kampanye</x-button>
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

function validateTarget() {
    const input = document.getElementById('target_donasi');
    const warning = document.getElementById('targetWarning');
    const min = parseInt(input.min, 10) || 100000;
    const val = parseInt(input.value, 10) || 0;
    if (val < min) {
        warning.classList.remove('hidden');
    } else {
        warning.classList.add('hidden');
    }
}

function stepper(delta) {
    const input = document.getElementById('target_donasi');
    const min = parseInt(input.min, 10) || 100000;
    const step = parseInt(input.step, 10) || 10000;
    let val = parseInt(input.value.replace(/\D/g, ''), 10) || 0;
    val = Math.round(val / step) * step;
    val += delta;
    if (val < min) val = min;
    input.value = val;
    validateTarget();
    input.dispatchEvent(new Event('input', { bubbles: true }));
}

document.addEventListener('DOMContentLoaded', () => {
    const ta = document.getElementById('deskripsi_hewan');
    if (ta) document.getElementById('charCount').textContent = ta.value.length;

    validateTarget();

    const zone = document.getElementById('uploadZone');
    zone.addEventListener('dragover', (e) => { e.preventDefault(); zone.classList.add('border-brand-500'); });
    zone.addEventListener('dragleave', () => zone.classList.remove('border-brand-500'));
    zone.addEventListener('drop', (e) => {
        e.preventDefault();
        zone.classList.remove('border-brand-500');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            document.getElementById('imageInput').files = e.dataTransfer.files;
            previewImg({ files: e.dataTransfer.files });
        }
    });

    document.getElementById('campForm').addEventListener('submit', (e) => {
        validateTarget();
        const warning = document.getElementById('targetWarning');
        if (!warning.classList.contains('hidden')) {
            e.preventDefault();
            document.getElementById('target_donasi').focus();
        }
    });
});
</script>
@endpush
@endsection
