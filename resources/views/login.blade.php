@extends('layout.navbarLogin')
@section('content')

<style>
    body { font-family: 'Inter', sans-serif; }

    /* Split Layout */
    .login-page {
        min-height: calc(100vh - 68px);
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    /* Left Panel */
    .login-left {
        background: linear-gradient(160deg, #1a0f1f 0%, #2b1b2f 40%, #4a2060 100%);
        display: flex; flex-direction: column;
        justify-content: center; align-items: center;
        padding: 60px 48px; position: relative; overflow: hidden;
    }
    .login-left::before {
        content: '';
        position: absolute; top: -100px; right: -100px;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(201,166,212,0.12) 0%, transparent 70%);
        border-radius: 50%;
    }
    .login-left::after {
        content: '';
        position: absolute; bottom: -80px; left: -80px;
        width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(155,89,182,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    .left-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(201,166,212,0.12);
        border: 1px solid rgba(201,166,212,0.2);
        border-radius: 30px; padding: 6px 16px;
        color: #c9a6d4; font-size: 13px; font-weight: 600;
        margin-bottom: 32px; position: relative; z-index: 1;
    }
    .login-left h1 {
        font-size: 42px; font-weight: 800; color: #fff;
        line-height: 1.15; margin-bottom: 20px;
        position: relative; z-index: 1;
    }
    .login-left h1 span { color: #c9a6d4; }
    .login-left p {
        font-size: 16px; color: #9b7fa8; line-height: 1.7;
        margin-bottom: 40px; position: relative; z-index: 1;
    }
    .left-features { display: flex; flex-direction: column; gap: 16px; position: relative; z-index: 1; width: 100%; }
    .left-feature-item {
        display: flex; align-items: center; gap: 14px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(201,166,212,0.12);
        border-radius: 12px; padding: 14px 18px;
    }
    .feature-icon {
        width: 40px; height: 40px; border-radius: 10px;
        background: linear-gradient(135deg, rgba(201,166,212,0.2), rgba(155,89,182,0.2));
        display: flex; align-items: center; justify-content: center;
        font-size: 18px; flex-shrink: 0;
    }
    .feature-text h4 { font-size: 14px; font-weight: 600; color: #e0d0e6; margin: 0 0 2px; }
    .feature-text p { font-size: 12px; color: #7a6080; margin: 0; }

    /* Right Panel */
    .login-right {
        background: var(--bg-secondary);
        display: flex; flex-direction: column;
        justify-content: center; padding: 60px 56px;
    }
    .login-right .back-link {
        display: inline-flex; align-items: center; gap: 6px;
        color: #9b7fa8; font-size: 13px; font-weight: 500;
        text-decoration: none; margin-bottom: 40px;
        transition: color 0.2s;
    }
    .login-right .back-link:hover { color: #7c3f8e; }
    .form-title { font-size: 30px; font-weight: 800; color: var(--text-primary); margin-bottom: 6px; }
    .form-subtitle { font-size: 14px; color: var(--text-secondary); margin-bottom: 36px; }

    .alert-box {
        padding: 12px 16px; border-radius: 10px;
        font-size: 13px; font-weight: 500; margin-bottom: 20px;
        display: flex; align-items: center; gap: 10px;
    }
    .alert-success { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
    .alert-danger  { background: #fff1f2; color: #9f1239; border: 1px solid #fecdd3; }

    .field-group { margin-bottom: 20px; }
    .field-label { display: block; font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 7px; }
    .field-input {
        width: 100%; padding: 13px 16px;
        border: 1.5px solid var(--border-color); border-radius: 10px;
        font-size: 14px; font-family: 'Inter', sans-serif;
        color: var(--text-primary); background: var(--bg-primary);
        transition: all 0.2s; outline: none;
    }
    .field-input:hover { border-color: var(--accent-primary); }
    .field-input:focus { border-color: var(--accent-secondary); box-shadow: 0 0 0 3px rgba(155,89,182,0.1); background: var(--bg-secondary); }
    .field-input::placeholder { color: var(--text-secondary); opacity: 0.6; }

    .input-icon-wrap { position: relative; }
    .input-icon-wrap .field-icon {
        position: absolute; left: 14px; top: 50%;
        transform: translateY(-50%); color: #c9a6d4; font-size: 15px;
    }
    .input-icon-wrap .field-input { padding-left: 42px; padding-right: 46px; }
    .toggle-pw {
        position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
        background: none; border: none; cursor: pointer; padding: 4px;
        color: #c9a6d4; font-size: 16px; line-height: 1; transition: color 0.2s;
        display: flex; align-items: center; justify-content: center;
    }
    .toggle-pw:hover { color: #9b59b6; }

    .remember-row {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 24px;
    }
    .remember-label {
        display: flex; align-items: center; gap: 8px;
        font-size: 13px; color: var(--text-secondary); cursor: pointer;
    }
    .remember-label input { accent-color: var(--accent-secondary); width: 16px; height: 16px; }

    .btn-submit-login {
        width: 100%; padding: 15px;
        background: linear-gradient(135deg, #c9a6d4 0%, #9b59b6 100%);
        color: #fff; border: none; border-radius: 10px;
        font-size: 15px; font-weight: 700; cursor: pointer;
        box-shadow: 0 8px 24px rgba(155,89,182,0.3);
        transition: all 0.25s; letter-spacing: 0.2px;
    }
    .btn-submit-login:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(155,89,182,0.4); }
    .btn-submit-login:active { transform: translateY(0); }

    .divider { text-align: center; margin: 24px 0; position: relative; }
    .divider::before {
        content: ''; position: absolute;
        top: 50%; left: 0; right: 0; height: 1px; background: var(--border-color);
    }
    .divider span {
        background: var(--bg-secondary); padding: 0 12px;
        font-size: 12px; color: var(--text-secondary); position: relative;
    }
    .signup-link { text-align: center; font-size: 14px; color: #888; margin-top: 4px; }
    .signup-link a { color: #9b59b6; font-weight: 600; text-decoration: none; }
    .signup-link a:hover { text-decoration: underline; }

    @media (max-width: 768px) {
        .login-page { grid-template-columns: 1fr; }
        .login-left { display: none; }
        .login-right { padding: 40px 28px; }
    }
</style>

<div class="login-page">
    <!-- Left Panel -->
    <div class="login-left">
        <div class="left-badge">🐾 Platform Donasi Hewan</div>
        <h1>Selamat datang di <span>DonasiLink</span></h1>
        <p>Bergabunglah dengan ribuan donatur yang telah membantu hewan-hewan yang membutuhkan.</p>
        <div class="left-features">
            <div class="left-feature-item">
                <div class="feature-icon">🛡️</div>
                <div class="feature-text">
                    <h4>Aman & Terpercaya</h4>
                    <p>Setiap donasi diverifikasi dan transparan</p>
                </div>
            </div>
            <div class="left-feature-item">
                <div class="feature-icon">📊</div>
                <div class="feature-text">
                    <h4>Pantau Donasi Anda</h4>
                    <p>Dashboard lengkap riwayat donasi</p>
                </div>
            </div>
            <div class="left-feature-item">
                <div class="feature-icon">🐕</div>
                <div class="feature-text">
                    <h4>Dampak Nyata</h4>
                    <p>Lihat langsung perubahan yang Anda buat</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="login-right">
        <a href="{{ route('beranda') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>

        <h2 class="form-title">Masuk ke Akun</h2>
        <p class="form-subtitle">Masukkan email atau username dan password Anda</p>

        @if(session('success'))
            <div class="alert-box alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert-box alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="field-group">
                <label class="field-label" for="email">Email / Username</label>
                <div class="input-icon-wrap">
                    <i class="fas fa-user field-icon"></i>
                    <input type="text" id="email" name="email" class="field-input"
                        placeholder="Masukkan email atau username" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="field-group">
                <label class="field-label" for="password">Password</label>
                <div class="input-icon-wrap">
                    <i class="fas fa-lock field-icon"></i>
                    <input type="password" id="password" name="password" class="field-input"
                        placeholder="Masukkan password Anda" required>
                    <button type="button" class="toggle-pw" onclick="togglePassword('password', this)" tabindex="-1">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="remember-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember"> Ingat saya
                </label>
            </div>
            <button type="submit" class="btn-submit-login">
                <i class="fas fa-sign-in-alt me-2"></i>Masuk
            </button>
        </form>

        <div class="divider"><span>atau</span></div>
        <p class="signup-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    </div>
</div>

<script>
function togglePassword(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
        btn.title = 'Sembunyikan password';
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
        btn.title = 'Tampilkan password';
    }
}
</script>

@endsection
