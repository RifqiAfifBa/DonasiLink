@extends('layouts.shelter')

@section('title', 'Edit Kampanye')

@section('content')
<section class="max-w-3xl mx-auto px-6 py-10 lg:py-14">
    <nav class="flex items-center gap-2 text-sm mb-6">
        <a href="{{ route('shelter.landingpage') }}" class="text-brand-600 dark:text-brand-300 font-medium hover:underline"><i class="fas fa-home mr-1"></i>Dashboard</a>
        <span class="text-ink-300">/</span>
        <span class="text-ink-500 dark:text-ink-400">Edit Kampanye</span>
    </nav>

    <h1 class="text-3xl font-extrabold text-ink-900 dark:text-white">✏️ Edit Kampanye</h1>
    <p class="mt-2 text-ink-500 dark:text-ink-400">Perbarui informasi kampanye untuk <strong class="text-ink-700 dark:text-ink-200">{{ $kampanye->nama_hewan }}</strong>.</p>

    @if($errors->any())
        <x-alert type="danger" class="mt-6">
            <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </x-alert>
    @endif

    <x-card padding="p-7 sm:p-10" class="mt-7">
        <form action="{{ route('shelter.updateKampanye', $kampanye->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <section>
                <p class="text-[11px] font-bold uppercase tracking-widest text-brand-600 dark:text-brand-300 mb-3 pb-2 border-b border-ink-100 dark:border-ink-700"><i class="fas fa-image mr-2"></i>Foto Hewan</p>
                <div id="uploadZone" class="relative rounded-2xl border-2 border-dashed border-ink-200 dark:border-ink-700 bg-ink-50 dark:bg-ink-900 hover:border-brand-400 transition-colors cursor-pointer overflow-hidden">
                    <input type="file" name="image" id="imageInput" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewImg(this)">
                    @if($kampanye->gambar)
                        <img src="{{ route('foto.show', $kampanye->gambar) }}" id="img-preview" alt="{{ $kampanye->nama_hewan }}" class="w-full h-60 object-cover">
                        <div id="imgOverlay" class="absolute inset-x-0 bottom-0 p-4 bg-gradient-to-t from-ink-900/80 to-transparent text-white pointer-events-none">
                            <p class="text-sm font-semibold"><i class="fas fa-camera mr-1"></i>Klik untuk ganti foto</p>
                            <p class="text-xs text-white/70">Kosongkan jika tidak ingin mengganti foto.</p>
                        </div>
                    @else
                        <img src="" id="img-preview" alt="Preview" class="hidden w-full h-60 object-cover">
                        <div id="uploadPlaceholder" class="flex flex-col items-center justify-center py-12 text-center">
                            <div class="w-14 h-14 rounded-2xl btn-gradient flex items-center justify-center text-white text-xl shadow-lg mb-3">
                                <i class="fas fa-cloud-arrow-up"></i>
                            </div>
                            <p class="text-sm font-semibold text-ink-900 dark:text-white">Klik untuk upload foto baru</p>
                            <p class="mt-1 text-xs text-ink-500 dark:text-ink-400">Format: JPG, PNG, WEBP &middot; Maks 2MB</p>
                        </div>
                    @endif
                </div>
            </section>

            <section>
                <p class="text-[11px] font-bold uppercase tracking-widest text-brand-600 dark:text-brand-300 mb-3 pb-2 border-b border-ink-100 dark:border-ink-700"><i class="fas fa-paw mr-2"></i>Informasi Hewan</p>
                <div class="grid sm:grid-cols-2 gap-4">
                    <x-form.group label="Nama Hewan" for="nama_hewan" required>
                        <x-form.input name="nama_hewan" id="nama_hewan" placeholder="cth: Milo" :value="old('nama_hewan', $kampanye->nama_hewan)" required />
                    </x-form.group>
                    <x-form.group label="Usia Hewan" for="usia_hewan" required>
                        <x-form.input name="usia_hewan" id="usia_hewan" placeholder="cth: 2 tahun" :value="old('usia_hewan', $kampanye->usia_hewan)" required />
                    </x-form.group>
                </div>

                <x-form.group label="Kebutuhan Hewan" for="kebutuhan_hewan" required>
                    <x-form.input name="kebutuhan_hewan" id="kebutuhan_hewan" placeholder="cth: Obat-obatan, Vaksin..." :value="old('kebutuhan_hewan', $kampanye->kebutuhan_hewan)" required />
                </x-form.group>

                <x-form.group label="Kondisi Kesehatan" required>
                    <div class="grid sm:grid-cols-2 gap-3">
                        @foreach([
                            ['val' => 'ya',    'icon' => 'heartbeat',    'title' => 'Sedang Sakit', 'sub' => 'Butuh perawatan medis', 'tone' => 'danger'],
                            ['val' => 'tidak', 'icon' => 'check-circle', 'title' => 'Sehat',        'sub' => 'Kebutuhan dasar',       'tone' => 'success'],
                        ] as $opt)
                            <label class="relative flex items-center gap-3 p-4 rounded-2xl border-2 cursor-pointer transition-all
                                          border-ink-200 dark:border-ink-700 hover:border-brand-300
                                          has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50 dark:has-[:checked]:bg-brand-900/30">
                                <input type="radio" name="sedang_sakit" value="{{ $opt['val'] }}"
                                       {{ old('sedang_sakit', $kampanye->sedang_sakit) === $opt['val'] ? 'checked' : '' }} class="sr-only peer">
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

                <x-form.group label="Deskripsi" for="deskripsi_hewan" required>
                    <textarea id="deskripsi_hewan" name="deskripsi_hewan" rows="5" required maxlength="1000"
                              oninput="document.getElementById('charCount').textContent = this.value.length"
                              class="block w-full px-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500 resize-y min-h-[140px]">{{ old('deskripsi_hewan', $kampanye->deskripsi_hewan) }}</textarea>
                    <p class="mt-1 text-xs text-ink-400 text-right"><span id="charCount">0</span>/1000 karakter</p>
                </x-form.group>
            </section>

            <section>
                <p class="text-[11px] font-bold uppercase tracking-widest text-brand-600 dark:text-brand-300 mb-3 pb-2 border-b border-ink-100 dark:border-ink-700"><i class="fas fa-bullseye mr-2"></i>Target Donasi</p>
                <x-form.group label="Jumlah Target" for="target_donasi" required>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-ink-500 dark:text-ink-400 font-semibold text-sm">Rp</span>
                        <input type="number" id="target_donasi" name="target_donasi" min="10000" required
                               value="{{ old('target_donasi', $kampanye->target_donasi) }}" placeholder="500000"
                               class="block w-full pl-12 pr-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500">
                    </div>
                    @if($kampanye->total_terkumpul > 0)
                        <p class="mt-2 text-xs text-brand-600 dark:text-brand-300"><i class="fas fa-coins mr-1"></i> Sudah terkumpul: <strong>Rp {{ number_format($kampanye->total_terkumpul, 0, ',', '.') }}</strong></p>
                    @endif
                </x-form.group>
            </section>

            <div class="flex flex-col-reverse sm:flex-row gap-3 pt-3">
                <x-button :href="route('shelter.landingpage')" variant="ghost" size="lg" icon="arrow-left">Batal</x-button>
                <x-button type="submit" variant="primary" size="lg" icon="save" class="sm:flex-1">Simpan Perubahan</x-button>
            </div>
        </form>
    </x-card>

    <x-card padding="p-7 sm:p-10" class="mt-8 border-2 border-rose-200 dark:border-rose-900/50">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-2xl bg-rose-100 dark:bg-rose-900/40 flex items-center justify-center text-rose-600 dark:text-rose-300 text-xl shrink-0">
                <i class="fas fa-trash-can"></i>
            </div>
            <div class="flex-1 min-w-0">
                <h2 class="text-lg font-bold text-ink-900 dark:text-white">Hapus Kampanye</h2>
                <p class="mt-1 text-sm text-ink-500 dark:text-ink-400">Setelah dihapus, semua data kampanye dan donasi terkait akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
                <form action="{{ route('shelter.deleteKampanye', $kampanye->id) }}" method="POST" class="mt-4" onsubmit="return confirm('Yakin ingin menghapus kampanye &quot;{{ $kampanye->nama_hewan }}&quot;? Semua data donasi terkait akan ikut terhapus. Tindakan ini tidak dapat dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit" variant="danger" size="lg" icon="trash-can">Hapus Kampanye</x-button>
                </form>
            </div>
        </div>
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
        const overlay = document.getElementById('imgOverlay');
        preview.src = e.target.result;
        preview.classList.remove('hidden');
        placeholder?.classList.add('hidden');
        overlay?.classList.add('hidden');
    };
    reader.readAsDataURL(file);
}
document.addEventListener('DOMContentLoaded', () => {
    const ta = document.getElementById('deskripsi_hewan');
    if (ta) document.getElementById('charCount').textContent = ta.value.length;
});
</script>
@endpush
@endsection
