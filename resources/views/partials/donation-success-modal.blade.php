@if(session('donation_success'))
    @php $ds = session('donation_success'); @endphp
    <div id="donationSuccessModal"
         class="fixed inset-0 z-[60] flex items-center justify-center p-4 bg-ink-900/70 backdrop-blur-sm opacity-0 transition-opacity duration-300"
         role="dialog" aria-modal="true" aria-labelledby="donationSuccessTitle">

        <div id="donationSuccessCard"
             class="relative w-full max-w-md bg-white dark:bg-ink-800 rounded-3xl shadow-2xl overflow-hidden scale-95 opacity-0 transition-all duration-300">

            <button type="button" data-close-donation-success aria-label="Tutup"
                    class="absolute top-3 right-3 z-20 w-9 h-9 rounded-full flex items-center justify-center text-white/80 hover:text-white hover:bg-white/15 transition-colors">
                <i class="fas fa-times"></i>
            </button>

            <div class="relative bg-gradient-to-br from-emerald-400 via-emerald-500 to-brand-600 px-6 pt-8 pb-7 text-center overflow-hidden">
                <div class="absolute -top-12 -right-12 w-40 h-40 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>

                <div class="relative mx-auto w-16 h-16 rounded-full bg-white shadow-xl flex items-center justify-center">
                    <span class="absolute inset-0 rounded-full bg-emerald-300/50 animate-ping"></span>
                    <i class="fas fa-check text-2xl text-emerald-500 relative"></i>
                </div>

                <h2 id="donationSuccessTitle" class="relative mt-4 text-2xl font-extrabold text-white">Donasi Berhasil!</h2>
                <p class="relative mt-1.5 text-sm text-white/90 leading-relaxed">
                    Terima kasih, <strong>{{ $ds['donor_name'] ?? 'Donatur' }}</strong>. Semoga kebaikan Anda dibalas berlipat <span class="inline-block">🙏</span>
                </p>
            </div>

            <div class="p-6 space-y-4">
                <div class="rounded-2xl bg-ink-50 dark:bg-ink-900 border border-ink-100 dark:border-ink-700 divide-y divide-ink-100 dark:divide-ink-700">
                    <div class="flex items-center justify-between gap-3 px-4 py-3 text-sm">
                        <span class="text-ink-500 dark:text-ink-400 shrink-0">Kampanye</span>
                        <strong class="text-ink-900 dark:text-white text-right truncate">{{ $ds['nama_hewan'] ?? '-' }}</strong>
                    </div>
                    <div class="flex items-center justify-between gap-3 px-4 py-3 text-sm">
                        <span class="text-ink-500 dark:text-ink-400 shrink-0">Metode</span>
                        <strong class="text-ink-900 dark:text-white text-right">{{ str_replace('_', ' ', ucfirst($ds['metode'] ?? '-')) }}</strong>
                    </div>
                    <div class="flex items-center justify-between gap-3 px-4 py-3.5">
                        <span class="text-sm font-bold text-ink-900 dark:text-white">Total Donasi</span>
                        <strong class="text-lg font-extrabold text-emerald-600 dark:text-emerald-300">
                            Rp {{ number_format($ds['jumlah'] ?? 0, 0, ',', '.') }}
                        </strong>
                    </div>
                </div>

                <div class="flex items-center gap-2 px-3 py-2.5 rounded-xl bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-300 text-xs">
                    <i class="fas fa-clock shrink-0"></i>
                    <span>Status donasi saat ini <strong>Pending</strong> dan akan segera diproses.</span>
                </div>

                <div class="grid grid-cols-2 gap-3 pt-1">
                    <a href="{{ route('kampanye.index') }}"
                       class="inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-ink-100 dark:bg-ink-700 text-ink-700 dark:text-ink-200 text-sm font-semibold hover:bg-ink-200 dark:hover:bg-ink-600 transition-colors">
                        <i class="fas fa-list"></i> Kampanye Lain
                    </a>
                    <button type="button" data-close-donation-success
                            class="inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl btn-gradient text-white text-sm font-bold shadow-[0_8px_20px_-6px_rgba(124,58,237,0.45)] hover:-translate-y-0.5 transition-all">
                        <i class="fas fa-check"></i> Selesai
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function() {
        const overlay = document.getElementById('donationSuccessModal');
        const card    = document.getElementById('donationSuccessCard');

        const open = () => {
            document.body.style.overflow = 'hidden';
            requestAnimationFrame(() => {
                overlay.classList.replace('opacity-0', 'opacity-100');
                card.classList.replace('scale-95', 'scale-100');
                card.classList.replace('opacity-0', 'opacity-100');
            });
        };
        const close = () => {
            overlay.classList.replace('opacity-100', 'opacity-0');
            card.classList.replace('scale-100', 'scale-95');
            card.classList.replace('opacity-100', 'opacity-0');
            setTimeout(() => { overlay.remove(); document.body.style.overflow = ''; }, 280);
        };

        document.querySelectorAll('[data-close-donation-success]').forEach(b => b.addEventListener('click', close));
        overlay.addEventListener('click', (e) => { if (e.target === overlay) close(); });
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', open);
        } else {
            open();
        }
    })();
    </script>
@endif
