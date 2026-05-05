@extends('layout.navbarUser')
@section('content')
<style>

</style>

<div class="content-wrapper">
    <div class="checkout-container">
        <div class="checkout-header">
            <h2>Checkout - Donasi Sekarang</h2>
        </div>

        <form id="checkoutForm">
            <div class="form-group">
                <label>Pilih Jumlah Donasi</label>
                <div class="amount-options">
                    <button type="button" class="amount-btn" data-amount="50000">Rp 50rb</button>
                    <button type="button" class="amount-btn" data-amount="100000">Rp 100rb</button>
                    <button type="button" class="amount-btn" data-amount="250000">Rp 250rb</button>
                    <button type="button" class="amount-btn" data-amount="500000">Rp 500rb</button>
                </div>
            </div>
            <div class="paymentSelf justify-content-center d-flex gap-5">
                <div class="selfInfo p-2 amount-btn" data-amount="custom">
                    <input type="text" placeholder="Silahkan Isi Nominal" class="form-control text-center" id="customAmount">
                </div>
            </div>
            <div class="payment-info">
                <div class="payment-info-row">
                    <span>Kampanye:</span>
                    <strong>Pakan Sehat</strong>
                </div>
                <div class="payment-info-row">
                    <span>Jumlah:</span>
                    <strong id="displayAmount">Rp 50.000</strong>
                </div>
                <div class="payment-info-row">
                    <span>Fee Admin:</span>
                    <strong>Gratis</strong>
                </div>
                <div class="payment-info-row total">
                    <span>Total Donasi:</span>
                    <strong id="totalAmount">Rp 50.000</strong>
                </div>
            </div>

            <div class="form-group">
                <label for="donorName">Nama Lengkap</label>
                <input type="text" id="donorName" name="donor_name" required placeholder="Masukkan nama lengkap Anda">
            </div>

            <div class="form-group">
                <label for="donorEmail">Email</label>
                <input type="email" id="donorEmail" name="donor_email" required placeholder="Masukkan email Anda">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="donorPhone">Nomor Telepon</label>
                    <input type="tel" id="donorPhone" name="donor_phone" required placeholder="08xxxxxxxxx">
                </div>
                <div class="form-group">
                    <label for="paymentMethod">Metode Pembayaran</label>
                    <select id="paymentMethod" name="payment_method" required>
                        <option value="">-- Pilih Metode --</option>
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="e_wallet">E-Wallet</option>
                        <option value="credit_card">Kartu Kredit</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn-submit">Lanjutkan Pembayaran</button>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('.amount-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.amount-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.custom-amount').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const amount = parseInt(this.dataset.amount);
            const formatted = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
            document.getElementById('displayAmount').textContent = formatted;
            document.getElementById('totalAmount').textContent = formatted;
        });
    });

    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Terima kasih! Donasi Anda sedang diproses.');
    });
</script>

@endsection