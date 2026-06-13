@extends('layouts.shelter')

@section('title', 'Edit Update Perkembangan — ' . $kampanye->nama_hewan)

@section('content')
<section class="max-w-3xl mx-auto px-6 py-10 lg:py-14">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm mb-6">
        <a href="{{ route('shelter.landingpage') }}" class="text-brand-600 dark:text-brand-300 font-medium hover:underline"><i class="fas fa-home mr-1"></i>Dashboard</a>
        <span class="text-ink-300">/</span>
        <a href="{{ route('shelter.perkembangan.index', $kampanye->id) }}" class="text-brand-600 dark:text-brand-300 font-medium hover:underline">Perkembangan</a>
        <span class="text-ink-300">/</span>
        <span class="text-ink-500 dark:text-ink-400 truncate">Edit Update</span>
    </nav>

    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-200 text-xs font-bold uppercase tracking-wider">
        <i class="fas fa-pen"></i> Edit Update
    </span>
    <h1 class="mt-3 text-3xl font-extrabold text-ink-900 dark:text-white">Edit Perkembangan</h1>
    <p class="mt-2 text-ink-500 dark:text-ink-400">Perbarui catatan perkembangan untuk <strong class="text-ink-700 dark:text-ink-200">{{ $kampanye->nama_hewan }}</strong>.</p>

    @if($errors->any())
        <x-alert type="danger" class="mt-6">
            <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </x-alert>
    @endif

    <x-card padding="p-7 sm:p-10" class="mt-7">
        <form action="{{ route('shelter.perkembangan.update', [$kampanye->id, $perkembangan->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            {{-- Judul --}}
            <x-form.group label="Judul Update" for="judul" required>
                <x-form.input name="judul" id="judul" :value="old('judul', $perkembangan->judul)" required maxlength="200" />
            </x-form.group>

            {{-- Jenis & Kondisi --}}
            <div class="grid sm:grid-cols-2 gap-4">
                <x-form.group label="Jenis Update" for="jenis" required>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach([
                            ['val' => 'medis',     'icon' => 'kit-medical',  'label' => 'Medis'],
                            ['val' => 'pakan',     'icon' => 'bowl-food',    'label' => 'Pakan'],
                            ['val' => 'perawatan', 'icon' => 'shower',       'label' => 'Perawatan'],
                            ['val' => 'umum',      'icon' => 'notes-medical','label' => 'Umum'],
                        ] as $opt)
                        <label class="relative flex items-center gap-2 px-3 py-2.5 rounded-xl border-2 cursor-pointer transition-all
                                      border-ink-200 dark:border-ink-700 hover:border-brand-300
                                      has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50 dark:has-[:checked]:bg-brand-900/30">
                            <input type="radio" name="jenis" value="{{ $opt['val'] }}"
                                   {{ old('jenis', $perkembangan->jenis) === $opt['val'] ? 'checked' : '' }} class="sr-only peer">
                            <i class="fas fa-{{ $opt['icon'] }} w-4"></i>
                            <span class="text-sm font-semibold text-ink-900 dark:text-white">{{ $opt['label'] }}</span>
                        </label>
                        @endforeach
                    </div>
                </x-form.group>

                <x-form.group label="Kondisi Hewan Saat Ini" for="kondisi">
                    <select name="kondisi" id="kondisi"
                        class="block w-full px-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500">
                        <option value="">— Pilih kondisi —</option>
                        <option value="membaik" {{ old('kondisi', $perkembangan->kondisi) === 'membaik' ? 'selected' : '' }}>✅ Membaik</option>
                        <option value="stabil"  {{ old('kondisi', $perkembangan->kondisi) === 'stabil'  ? 'selected' : '' }}>🔵 Stabil</option>
                        <option value="kritis"  {{ old('kondisi', $perkembangan->kondisi) === 'kritis'  ? 'selected' : '' }}>🔴 Kritis</option>
                        <option value="sembuh"  {{ old('kondisi', $perkembangan->kondisi) === 'sembuh'  ? 'selected' : '' }}>🌟 Sudah Sembuh</option>
                    </select>
                </x-form.group>
            </div>

            {{-- Tanggal --}}
            <x-form.group label="Tanggal Update / Kejadian" for="tanggal_update" required>
                <x-form.input type="date" name="tanggal_update" id="tanggal_update"
                    :value="old('tanggal_update', $perkembangan->tanggal_update->format('Y-m-d'))"
                    max="{{ now()->format('Y-m-d') }}" required />
            </x-form.group>

            {{-- Catatan --}}
            <x-form.group label="Catatan Perkembangan" for="catatan" required>
                <textarea id="catatan" name="catatan" rows="6" required maxlength="3000"
                          oninput="document.getElementById('charCount').textContent = this.value.length"
                          class="block w-full px-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500 resize-y min-h-[160px]">{{ old('catatan', $perkembangan->catatan) }}</textarea>
                <p class="mt-1 text-xs text-ink-400 text-right"><span id="charCount">0</span>/3000 karakter</p>
            </x-form.group>

            {{-- Foto --}}
            <div>
                <p class="text-[11px] font-bold uppercase tracking-widest text-brand-600 dark:text-brand-300 mb-3 pb-2 border-b border-ink-100 dark:border-ink-700">
                    <i class="fas fa-images mr-2"></i>Ganti Foto Dokumentasi (Opsional)
                </p>
                <div class="grid sm:grid-cols-2 gap-5">
                    @foreach([
                        ['field' => 'foto_sebelum', 'label' => 'Foto Sebelum', 'icon' => 'fa-arrow-circle-left',  'color' => 'rose',    'existing' => $perkembangan->foto_sebelum],
                        ['field' => 'foto_sesudah', 'label' => 'Foto Sesudah', 'icon' => 'fa-arrow-circle-right', 'color' => 'emerald', 'existing' => $perkembangan->foto_sesudah],
                    ] as $foto)
                    <div>
                        <p class="text-xs font-semibold text-ink-600 dark:text-ink-300 mb-2">
                            <i class="fas {{ $foto['icon'] }} text-{{ $foto['color'] }}-500 mr-1"></i>{{ $foto['label'] }}
                        </p>
                        @if($foto['existing'])
                            <div class="mb-2 rounded-xl overflow-hidden ring-1 ring-ink-200 dark:ring-ink-700 relative">
                                <img src="{{ route('foto.show', $foto['existing']) }}" alt="{{ $foto['label'] }}" class="w-full h-32 object-cover">
                                <span class="absolute bottom-1 left-1 px-2 py-0.5 rounded-full bg-black/60 text-white text-[10px] font-semibold">Foto Saat Ini</span>
                            </div>
                        @endif
                        <div id="zone_{{ $foto['field'] }}" class="relative rounded-2xl border-2 border-dashed border-ink-200 dark:border-ink-700 bg-ink-50 dark:bg-ink-900 hover:border-brand-400 transition-colors cursor-pointer overflow-hidden">
                            <input type="file" name="{{ $foto['field'] }}" id="{{ $foto['field'] }}" accept="image/*"
                                   class="absolute inset-0 opacity-0 cursor-pointer z-10"
                                   onchange="previewFoto(this, '{{ $foto['field'] }}')">
                            <img src="" id="preview_{{ $foto['field'] }}" alt="Preview" class="hidden w-full h-32 object-cover">
                            <div id="placeholder_{{ $foto['field'] }}" class="flex flex-col items-center justify-center py-6 text-center">
                                <i class="fas fa-cloud-arrow-up text-2xl text-ink-300 dark:text-ink-600 mb-1"></i>
                                <p class="text-xs text-ink-500 dark:text-ink-400">{{ $foto['existing'] ? 'Klik untuk ganti foto' : 'Upload foto baru' }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col-reverse sm:flex-row gap-3 pt-3">
                <x-button :href="route('shelter.perkembangan.index', $kampanye->id)" variant="ghost" size="lg" icon="arrow-left">Batal</x-button>
                <x-button type="submit" variant="primary" size="lg" icon="check" class="sm:flex-1">Simpan Perubahan</x-button>
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
});
</script>
@endpush
@endsection
