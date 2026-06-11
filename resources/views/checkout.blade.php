@extends('layouts.public')

@section('title', 'Checkout Donasi')

@section('content')
<section class="max-w-3xl mx-auto px-6 lg:px-8 py-10 lg:py-14">
    <div class="text-center mb-8">
        <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-100 dark:bg-brand-900/40 text-brand-700 dark:text-brand-200 text-xs font-bold uppercase tracking-wider">
            <i class="fas fa-heart"></i> Checkout Donasi
        </span>
        <h1 class="mt-3 text-3xl font-extrabold text-ink-900 dark:text-white">Selesaikan Donasi Anda</h1>
        <p class="mt-2 text-ink-500 dark:text-ink-400">Setiap donasi membawa harapan baru.</p>
    </div>

    @if(session('success'))
        <x-alert type="success" class="mb-6">{{ session('success') }}</x-alert>
    @endif

    <x-card padding="p-6 sm:p-8">
        <form id="checkoutForm" action="{{ route('checkout.store', $kampanye->id) }}" method="POST" class="space-y-6">
            @csrf

            <x-form.group label="Pilih Jumlah Donasi" required>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                    @foreach([50000, 100000, 250000, 500000] as $idx => $amount)
                        <button type="button"
                                data-amount="{{ $amount }}"
                                class="amount-btn px-4 py-3 rounded-xl border-2 text-sm font-bold transition-all
                                       {{ $idx === 0
                                          ? 'border-brand-500 bg-brand-50 text-brand-700 dark:bg-brand-900/40 dark:text-brand-200 dark:border-brand-500 active'
                                          : 'border-ink-200 dark:border-ink-700 text-ink-700 dark:text-ink-200 hover:border-brand-400 hover:text-brand-700 dark:hover:text-brand-300' }}">
                            Rp {{ number_format($amount/1000, 0) }}{{ $amount >= 1000000 ? '' : 'rb' }}
                        </button>
                    @endforeach
                </div>
            </x-form.group>

            <x-form.group label="Atau nominal lain" for="customAmount">
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-ink-500 font-semibold text-sm">Rp</span>
                    <input type="text" id="customAmount" placeholder="0"
                           class="block w-full pl-10 pr-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm font-semibold focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500">
                </div>
            </x-form.group>

            <input type="hidden" name="jumlah" id="jumlahInput" value="50000">

            <div class="bg-gradient-to-br from-brand-50 to-fuchsia-50 dark:from-ink-800 dark:to-ink-900 rounded-2xl p-5 space-y-2.5 text-sm border border-brand-100 dark:border-ink-700">
                <div class="flex justify-between">
                    <span class="text-ink-600 dark:text-ink-300">Kampanye:</span>
                    <strong class="text-ink-900 dark:text-white">{{ $kampanye->nama_hewan }}</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-ink-600 dark:text-ink-300">Jumlah:</span>
                    <strong id="displayAmount" class="text-ink-900 dark:text-white">Rp 50.000</strong>
                </div>
                <div class="flex justify-between">
                    <span class="text-ink-600 dark:text-ink-300">Fee Admin:</span>
                    <strong class="text-emerald-600 dark:text-emerald-300">Gratis</strong>
                </div>
                <div class="flex justify-between pt-3 border-t border-brand-200/60 dark:border-ink-700">
                    <span class="font-bold text-ink-900 dark:text-white">Total Donasi:</span>
                    <strong id="totalAmount" class="text-xl font-extrabold text-brand-700 dark:text-brand-300">Rp 50.000</strong>
                </div>
            </div>

            @php
                $isDonatur     = session('role') === 'donatur';
                $defaultName   = old('donor_name', $isDonatur ? session('donatur_nama') : '');
                $defaultEmail  = old('donor_email', $isDonatur ? (auth()->user()->email ?? \App\Models\Donatur::find(session('donatur_id'))?->email) : '');
            @endphp

            <x-form.group label="Nama Lengkap" for="donorName" required :error="$errors->first('donor_name')">
                <x-form.input name="donor_name" id="donorName" icon="user" placeholder="Masukkan nama lengkap Anda" :value="$defaultName" required />
            </x-form.group>

            <x-form.group label="Email" for="donorEmail" required :error="$errors->first('donor_email')" :hint="$isDonatur ? 'Riwayat donasi akan terkait ke akun Anda.' : null">
                <x-form.input type="email" name="donor_email" id="donorEmail" icon="envelope" placeholder="Masukkan email Anda" :value="$defaultEmail" required />
            </x-form.group>

            <div class="grid sm:grid-cols-2 gap-4">
                <x-form.group label="Nomor Telepon" for="donorPhone" required :error="$errors->first('donor_phone')">
                    <x-form.input type="tel" name="donor_phone" id="donorPhone" icon="phone" placeholder="08xxxxxxxxx" :value="old('donor_phone')" required />
                </x-form.group>
                <x-form.group label="Metode Pembayaran" for="paymentMethod" required :error="$errors->first('payment_method')">
                    <select id="paymentMethod" name="payment_method" required
                            class="block w-full px-4 py-3 rounded-xl border border-ink-200 dark:border-ink-700 bg-white dark:bg-ink-900 text-sm focus:outline-none focus:ring-4 focus:ring-brand-100 focus:border-brand-500">
                        <option value="">-- Pilih Metode --</option>
                        <option value="bank_transfer" @selected(old('payment_method') === 'bank_transfer')>Transfer Bank</option>
                        <option value="e_wallet"     @selected(old('payment_method') === 'e_wallet')>E-Wallet</option>
                        <option value="credit_card"  @selected(old('payment_method') === 'credit_card')>Kartu Kredit</option>
                    </select>
                </x-form.group>
            </div>

            <x-button type="submit" variant="primary" size="lg" icon="lock" class="w-full">
                Lanjutkan Pembayaran
            </x-button>
        </form>
    </x-card>
</section>

@push('scripts')
<script>
(function() {
    const formatRp = (n) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(n);
    const updateAmount = (amount) => {
        const out = formatRp(amount);
        document.getElementById('displayAmount').textContent = out;
        document.getElementById('totalAmount').textContent = out;
        document.getElementById('jumlahInput').value = amount;
    };

    document.querySelectorAll('.amount-btn[data-amount]').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelectorAll('.amount-btn').forEach((b) => {
                b.classList.remove('border-brand-500', 'bg-brand-50', 'text-brand-700', 'dark:bg-brand-900/40', 'dark:text-brand-200', 'dark:border-brand-500', 'active');
                b.classList.add('border-ink-200', 'dark:border-ink-700', 'text-ink-700', 'dark:text-ink-200');
            });
            btn.classList.remove('border-ink-200', 'dark:border-ink-700', 'text-ink-700', 'dark:text-ink-200');
            btn.classList.add('border-brand-500', 'bg-brand-50', 'text-brand-700', 'dark:bg-brand-900/40', 'dark:text-brand-200', 'dark:border-brand-500', 'active');
            const amount = parseInt(btn.dataset.amount, 10);
            document.getElementById('customAmount').value = '';
            updateAmount(amount);
        });
    });

    document.getElementById('customAmount').addEventListener('input', (e) => {
        const amount = parseInt(e.target.value.replace(/\D/g, ''), 10) || 0;
        document.querySelectorAll('.amount-btn').forEach((b) => {
            b.classList.remove('border-brand-500', 'bg-brand-50', 'text-brand-700', 'dark:bg-brand-900/40', 'dark:text-brand-200', 'dark:border-brand-500', 'active');
            b.classList.add('border-ink-200', 'dark:border-ink-700', 'text-ink-700', 'dark:text-ink-200');
        });
        updateAmount(amount);
    });
})();
</script>
@endpush
@endsection
