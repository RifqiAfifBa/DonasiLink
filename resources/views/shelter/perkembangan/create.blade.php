@extends('layouts.shelter')

@section('title', 'Tambah Update Perkembangan — ' . $kampanye->nama_hewan)

@section('content')
<section class="max-w-3xl mx-auto px-6 py-10 lg:py-14">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm mb-6">
        <a href="{{ route('shelter.landingpage') }}" class="text-brand-600 dark:text-brand-300 font-medium hover:underline"><i class="fas fa-home mr-1"></i>Dashboard</a>
        <span class="text-ink-300">/</span>
        <a href="{{ route('shelter.perkembangan.index', $kampanye->id) }}" class="text-brand-600 dark:text-brand-300 font-medium hover:underline">Perkembangan</a>
        <span class="text-ink-300">/</span>
        <span class="text-ink-500 dark:text-ink-400">Tambah Update</span>
    </nav>

    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-100 dark:bg-teal-900/40 text-teal-700 dark:text-teal-200 text-xs font-bold uppercase tracking-wider">
        <i class="fas fa-stethoscope"></i> Update Perkembangan
    </span>
    <h1 class="mt-3 text-3xl font-extrabold text-ink-900 dark:text-white">Catat Perkembangan Hewan</h1>
    <p class="mt-2 text-ink-500 dark:text-ink-400">Posting update terbaru untuk <strong class="text-ink-700 dark:text-ink-200">{{ $kampanye->nama_hewan }}</strong>. Donatur akan mendapat notifikasi otomatis.</p>

    @if($errors->any())
        <x-alert type="danger" class="mt-6">
            <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </x-alert>
    @endif

    <x-card padding="p-7 sm:p-10" class="mt-7">
        <form action="{{ route('shelter.perkembangan.store', $kampanye->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="perkembanganForm">
            @csrf

            {{-- Judul --}}
            <x-form.group label="Judul Update" for="judul" required hint="Ringkasan singkat, cth: 'Operasi tumor selesai — kondisi membaik'">
                <x-form.input name="judul" id="judul" placeholder="cth: Operasi selesai, kondisi stabil" :value="old('judul')" required maxlength="200" />
            </x-form.group>

            {{-- Jenis & Kondisi --}}
            <div class="grid sm:grid-cols-2 gap-4">

                <x-form.group label="Jenis Update" for="jenis" required>
                    <div class="grid grid-cols-2 gap-2" id="jenisGroup">
                        @foreach([
                            ['val' => 'medis',     'icon' => 'kit-medical',  'label' => 'Medis',     'color' => 'rose'],
                            ['val' => 'pakan',     'icon' => 'bowl-food',    'label' => 'Pakan',     'color' => 'amber'],
                            ['val' => 'perawatan', 'icon' => 'shower',       'label' => 'Perawatan', 'color' => 'blue'],
                            ['val' => 'umum',      'icon' => 'notes-medical','label' => 'Umum',      'color' => 'teal'],
                        ] as $opt)
                        <label class="relative flex items-center gap-2 px-3 py-2.5 rounded-xl border-2 cursor-pointer transition-all
                                      border-ink-200 dark:border-ink-700 hover:border-brand-300
                                      has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50 dark:has-[:checked]:bg-brand-900/30">
                            <input type="radio" name="jenis" value="{{ $opt['val'] }}" {{ old('jenis', 'umum') === $opt['val'] ? 'checked' : '' }} class="sr-only peer">
                            <i class="fas fa-{{ $opt['icon'] }} text-{{ $opt['color'] }}-500 w-4"></i>
                            <span class="text-sm font-semibold text-ink-900 dark:text-white">{{ $opt['label'] }}</span>
                        </label>
                        @endforeach
                    </div>
                </x-form.group>

                <x-form.group label="Kondisi Hewan Saat Ini" for="kondisi" hint="Opsional">
                    <select name="kondisi" id="kondisi"
                        class="block w-full px-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500">
                        <option value="">— Pilih kondisi —</option>
                        <option value="membaik"  {{ old('kondisi') === 'membaik'  ? 'selected' : '' }}>✅ Membaik</option>
                        <option value="stabil"   {{ old('kondisi') === 'stabil'   ? 'selected' : '' }}>🔵 Stabil</option>
                        <option value="kritis"   {{ old('kondisi') === 'kritis'   ? 'selected' : '' }}>🔴 Kritis</option>
                        <option value="sembuh"   {{ old('kondisi') === 'sembuh'   ? 'selected' : '' }}>🌟 Sudah Sembuh</option>
                    </select>
                </x-form.group>
            </div>

            {{-- Tanggal --}}
            <x-form.group label="Tanggal Update / Kejadian" for="tanggal_update" required hint="Tanggal saat kejadian berlangsung">
                <x-form.input type="date" name="tanggal_update" id="tanggal_update"
                    :value="old('tanggal_update', now()->format('Y-m-d'))"
                    max="{{ now()->format('Y-m-d') }}" required />
            </x-form.group>

            {{-- Catatan --}}
            <x-form.group label="Catatan Perkembangan" for="catatan" required hint="Jelaskan kondisi hewan, tindakan yang dilakukan, dan hasil pemeriksaan secara detail.">
                <textarea id="catatan" name="catatan" rows="6" required maxlength="3000"
                          oninput="document.getElementById('charCount').textContent = this.value.length"
                          class="block w-full px-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500 resize-y min-h-[160px]"
                          placeholder="Contoh:&#10;- Hewan menjalani operasi pengangkatan tumor di Klinik Hewan Sehat pada 10 Juni 2026.&#10;- Operasi berlangsung 2 jam, berjalan lancar tanpa komplikasi.&#10;- Hewan sudah sadar dan nafsu makan mulai pulih.&#10;- Dijadwalkan kontrol 1 minggu lagi.">{{ old('catatan') }}</textarea>
                <p class="mt-1 text-xs text-ink-400 text-right"><span id="charCount">0</span>/3000 karakter</p>
            </x-form.group>

            {{-- Foto Sebelum & Sesudah --}}
            <div>
                <p class="text-[11px] font-bold uppercase tracking-widest text-brand-600 dark:text-brand-300 mb-3 pb-2 border-b border-ink-100 dark:border-ink-700">
                    <i class="fas fa-images mr-2"></i>Dokumentasi Foto (Opsional)
                </p>
                <div class="grid sm:grid-cols-2 gap-5">
                    @foreach([['field' => 'foto_sebelum', 'label' => 'Foto Sebelum', 'icon' => 'fa-arrow-circle-left', 'color' => 'rose'], ['field' => 'foto_sesudah', 'label' => 'Foto Sesudah / Terkini', 'icon' => 'fa-arrow-circle-right', 'color' => 'emerald']] as $foto)
                    <div>
                        <p class="text-xs font-semibold text-ink-600 dark:text-ink-300 mb-2">
                            <i class="fas {{ $foto['icon'] }} text-{{ $foto['color'] }}-500 mr-1"></i>{{ $foto['label'] }}
                        </p>
                        <div id="zone_{{ $foto['field'] }}" class="relative rounded-2xl border-2 border-dashed border-ink-200 dark:border-ink-700 bg-ink-50 dark:bg-ink-900 hover:border-brand-400 transition-colors cursor-pointer overflow-hidden">
                            <input type="file" name="{{ $foto['field'] }}" id="{{ $foto['field'] }}" accept="image/*"
                                   class="absolute inset-0 opacity-0 cursor-pointer z-10"
                                   onchange="previewFoto(this, '{{ $foto['field'] }}')">
                            <img src="" id="preview_{{ $foto['field'] }}" alt="Preview" class="hidden w-full h-40 object-cover">
                            <div id="placeholder_{{ $foto['field'] }}" class="flex flex-col items-center justify-center py-8 text-center">
                                <i class="fas fa-cloud-arrow-up text-3xl text-ink-300 dark:text-ink-600 mb-2"></i>
                                <p class="text-xs font-semibold text-ink-600 dark:text-ink-300">Klik atau seret</p>
                                <p class="text-[10px] text-ink-400 mt-0.5">JPG, PNG, WEBP · Maks 4MB</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Info notifikasi --}}
            <div class="flex items-start gap-2 p-3 rounded-xl bg-teal-50 dark:bg-teal-900/20 text-teal-700 dark:text-teal-300 text-xs">
                <i class="fas fa-bell shrink-0 mt-0.5"></i>
                <span>Setelah disimpan, semua donatur yang pernah berdonasi ke kampanye ini akan mendapat <strong>notifikasi otomatis</strong>.</span>
            </div>

            <div class="flex flex-col-reverse sm:flex-row gap-3 pt-3">
                <x-button :href="route('shelter.perkembangan.index', $kampanye->id)" variant="ghost" size="lg" icon="arrow-left">Batal</x-button>
                <x-button type="submit" variant="primary" size="lg" icon="paper-plane" class="sm:flex-1">Simpan & Kirim Notifikasi</x-button>
            </div>
        </form>
    </x-card>
</section>

@push('scripts')
<script>
function previewFoto(input, fieldId) {
    const file = input.files && input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        const preview = document.getElementById('preview_' + fieldId);
        const placeholder = document.getElementById('placeholder_' + fieldId);
        preview.src = e.target.result;
        preview.classList.remove('hidden');
        placeholder?.classList.add('hidden');
    };
    reader.readAsDataURL(file);
}

document.addEventListener('DOMContentLoaded', () => {
    const ta = document.getElementById('catatan');
    if (ta) document.getElementById('charCount').textContent = ta.value.length;

    // Drag & drop untuk kedua zone foto
    ['foto_sebelum', 'foto_sesudah'].forEach(fieldId => {
        const zone = document.getElementById('zone_' + fieldId);
        if (!zone) return;
        zone.addEventListener('dragover', (e) => { e.preventDefault(); zone.classList.add('border-brand-500'); });
        zone.addEventListener('dragleave', () => zone.classList.remove('border-brand-500'));
        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            zone.classList.remove('border-brand-500');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                document.getElementById(fieldId).files = e.dataTransfer.files;
                previewFoto({ files: e.dataTransfer.files }, fieldId);
            }
        });
    });
});
</script>
@endpush
@endsection
