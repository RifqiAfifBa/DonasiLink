@extends('layouts.shelter')

@section('title', 'Penarikan Dana')

@section('content')
<section class="max-w-5xl mx-auto px-6 py-10 lg:py-14">
    <div>
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100 dark:bg-brand-900/40 text-brand-700 dark:text-brand-200 text-xs font-bold uppercase tracking-wider">
            <i class="fas fa-money-bill-wave"></i> Penarikan Dana
        </span>
        <h1 class="mt-3 text-3xl font-extrabold text-ink-900 dark:text-white">Ajukan Penarikan</h1>
        <p class="mt-2 text-ink-500 dark:text-ink-400">Pilih kampanye yang ingin dicairkan dananya. Setelah disetujui admin, Anda <strong class="text-ink-700 dark:text-ink-200">wajib mengunggah bukti pengeluaran</strong> agar donatur dapat memantau transparansi penggunaan dana.</p>
    </div>

    @if(session('success'))
        <x-alert type="success" class="mt-6">{{ session('success') }}</x-alert>
    @endif
    @if(session('error'))
        <x-alert type="danger" class="mt-6">{{ session('error') }}</x-alert>
    @endif
    @if($errors->any())
        <x-alert type="danger" class="mt-6">{{ $errors->first() }}</x-alert>
    @endif

    <div class="mt-8 space-y-4">
        @forelse($kampanye as $item)
            <article class="flex flex-col sm:flex-row sm:items-center gap-4 p-5 bg-white dark:bg-ink-800 border border-ink-200 dark:border-ink-700 rounded-2xl shadow-[0_1px_3px_rgba(15,23,42,0.05)] hover:shadow-[0_8px_24px_rgba(124,58,237,0.10)] transition-shadow">
                <img src="{{ $item->gambar ? route('foto.show', $item->gambar) : asset('Asset/Pic/kucing.jpeg') }}" alt="{{ $item->nama_hewan }}" class="w-full sm:w-24 h-24 rounded-xl object-cover">
                <div class="flex-1 min-w-0">
                    <h3 class="text-base font-bold text-ink-900 dark:text-white">{{ $item->nama_hewan }}</h3>
                    <p class="mt-1 text-sm text-ink-500 dark:text-ink-400 line-clamp-2">{{ Str::limit($item->deskripsi_hewan, 100) }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-ink-400 dark:text-ink-500">Sisa Dana</p>
                    <p class="text-lg font-extrabold text-brand-700 dark:text-brand-300">Rp {{ number_format($item->sisa_dana, 0, ',', '.') }}</p>
                    <p class="text-[10px] text-ink-400 dark:text-ink-500 mt-0.5">dari Rp {{ number_format($item->total_terkumpul, 0, ',', '.') }}</p>
                </div>
                <button type="button"
                        data-kampanye-id="{{ $item->id }}"
                        data-kampanye-name="{{ $item->nama_hewan }}"
                        data-sisa-dana="{{ $item->sisa_dana }}"
                        class="withdraw-btn inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl btn-gradient text-white text-sm font-semibold shadow-[0_8px_20px_-6px_rgba(124,58,237,0.45)] hover:-translate-y-0.5 transition-all">
                    <i class="fas fa-arrow-down"></i> Withdraw
                </button>
            </article>
        @empty
            <x-card padding="p-0">
                <x-empty-state icon="coins" title="Tidak ada dana yang dapat ditarik" message="Semua dana sudah ditarik atau belum ada donasi masuk untuk kampanye Anda." />
            </x-card>
        @endforelse
    </div>

    <div id="withdrawModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-ink-900/60 backdrop-blur-sm">
        <div class="relative w-full max-w-lg max-h-[90vh] overflow-y-auto bg-white dark:bg-ink-800 rounded-3xl shadow-2xl">
            <div class="sticky top-0 z-10 flex items-center justify-between p-6 border-b border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-800">
                <div>
                    <h2 class="text-lg font-bold text-ink-900 dark:text-white">Formulir Penarikan Dana</h2>
                    <p class="text-xs text-ink-500 dark:text-ink-400 mt-0.5" id="modalCampaign">Pilih bank dan masukkan detail rekening.</p>
                </div>
                <button type="button" id="closeModal" class="w-9 h-9 rounded-lg flex items-center justify-center text-ink-500 hover:bg-ink-100 dark:hover:bg-ink-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="uploadBuktiForm" action="{{ route('shelter.storePenarikan') }}" method="POST" class="p-6 space-y-5">
                @csrf
                <input type="hidden" name="kampanye_id" id="kampanye_id">

                <x-form.group label="Bank Tujuan" for="bank" required>
                    <select id="bank" name="bank" required class="block w-full px-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500">
                        <option value="" disabled selected>Pilih Bank</option>
                        <option value="BCA">BCA</option>
                        <option value="Mandiri">Mandiri</option>
                        <option value="BNI">BNI</option>
                        <option value="BRI">BRI</option>
                    </select>
                </x-form.group>

                <x-form.group label="Nomor Rekening" for="nomor_rekening" required>
                    <x-form.input name="nomor_rekening" id="nomor_rekening" icon="hashtag" placeholder="Contoh: 1234567890" required />
                </x-form.group>

                <x-form.group label="Nama Pemilik Rekening" for="nama_rekening" required>
                    <x-form.input name="nama_rekening" id="nama_rekening" icon="user" placeholder="Contoh: John Doe" required />
                </x-form.group>

                <x-form.group label="Total Penarikan" for="total_penarikan" required hint="Tidak boleh melebihi sisa dana kampanye yang tersedia.">
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-ink-500 dark:text-ink-400 font-semibold text-sm">Rp</span>
                        <input type="number" name="total_penarikan" id="total_penarikan" min="10000" required placeholder="500000"
                               class="block w-full pl-12 pr-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500">
                    </div>
                    <p id="sisaDanaHint" class="mt-1.5 text-xs text-brand-600 dark:text-brand-300"></p>
                </x-form.group>

                <x-form.group label="Tujuan Penarikan" for="keterangan" required hint="Jelaskan untuk apa dana ini akan digunakan.">
                    <textarea id="keterangan" name="keterangan" rows="3" required placeholder="Contoh: Untuk biaya operasi tumor pada Milo di klinik hewan ABC..."
                              class="block w-full px-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500 resize-y"></textarea>
                </x-form.group>

                <div class="flex items-start gap-2 p-3 rounded-xl bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300 text-xs">
                    <i class="fas fa-circle-info shrink-0 mt-0.5"></i>
                    <span>Setelah penarikan disetujui admin, Anda <strong>wajib mengunggah bukti pengeluaran</strong> (struk/foto) agar donatur dapat memantau transparansi penggunaan dana.</span>
                </div>

                <div class="flex gap-3 pt-2">
                    <x-button type="button" id="cancelBtn" variant="ghost" size="md" class="flex-1">Batal</x-button>
                    <x-button type="submit" variant="primary" size="md" icon="paper-plane" class="flex-1">Ajukan Penarikan</x-button>
                </div>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<script>
(function() {
    const modal = document.getElementById('withdrawModal');
    const open = () => { modal.classList.remove('hidden'); modal.classList.add('flex'); document.body.style.overflow = 'hidden'; };
    const close = () => { modal.classList.add('hidden'); modal.classList.remove('flex'); document.body.style.overflow = ''; document.getElementById('uploadBuktiForm').reset(); };

    const formatRp = (n) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(n);

    document.querySelectorAll('.withdraw-btn').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const sisa = parseInt(btn.dataset.sisaDana, 10) || 0;
            document.getElementById('modalCampaign').textContent = `Kampanye: ${btn.dataset.kampanyeName}`;
            document.getElementById('kampanye_id').value = btn.dataset.kampanyeId;
            document.getElementById('total_penarikan').value = sisa;
            document.getElementById('total_penarikan').max = sisa;
            document.getElementById('sisaDanaHint').innerHTML = `<i class="fas fa-coins mr-1"></i>Sisa dana kampanye ini: <strong>${formatRp(sisa)}</strong>`;
            open();
        });
    });
    document.getElementById('closeModal').addEventListener('click', close);
    document.getElementById('cancelBtn').addEventListener('click', close);
    modal.addEventListener('click', (e) => { if (e.target === modal) close(); });
})();
</script>
@endpush
@endsection
