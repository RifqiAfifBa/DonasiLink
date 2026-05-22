<footer class="bg-ink-900 dark:bg-black text-ink-300 mt-20">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="md:col-span-2">
            <a href="{{ route('beranda') }}" class="flex items-center gap-2 text-xl font-extrabold text-white mb-3">
                <span class="w-9 h-9 rounded-xl btn-gradient flex items-center justify-center shadow-md">
                    <i class="fas fa-paw text-sm"></i>
                </span>
                DonasiLink
            </a>
            <p class="text-sm text-ink-400 max-w-md leading-relaxed">
                Platform donasi terpercaya yang menghubungkan donatur dengan shelter hewan di seluruh Indonesia. Setiap donasi membawa perubahan nyata.
            </p>
            <div class="flex items-center gap-3 mt-4">
                <a href="#" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-brand-600 flex items-center justify-center transition-colors" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-brand-600 flex items-center justify-center transition-colors" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="w-9 h-9 rounded-lg bg-white/5 hover:bg-brand-600 flex items-center justify-center transition-colors" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>

        <div>
            <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-3">Jelajah</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('beranda') }}" class="hover:text-brand-300 transition-colors">Beranda</a></li>
                <li><a href="{{ route('kampanye.index') }}" class="hover:text-brand-300 transition-colors">Kampanye</a></li>
                <li><a href="{{ route('impact-story') }}" class="hover:text-brand-300 transition-colors">Impact Story</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-3">Bergabung</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('register') }}" class="hover:text-brand-300 transition-colors">Daftar Donatur</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-brand-300 transition-colors">Masuk</a></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p class="text-xs text-ink-500">&copy; {{ date('Y') }} DonasiLink. Dibuat dengan <i class="fas fa-heart text-rose-500"></i> untuk hewan-hewan di Indonesia.</p>
            <p class="text-xs text-ink-500">v1.0.0</p>
        </div>
    </div>
</footer>
