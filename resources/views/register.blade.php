@extends('layout.navbarLogin')
@section('content')

<style>
    body { font-family: 'Inter', sans-serif; }

    .register-page {
        min-height: calc(100vh - 68px);
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    /* Left Panel */
    .register-left {
        background: linear-gradient(160deg, #1a0f1f 0%, #2b1b2f 40%, #3d2060 100%);
        display: flex; flex-direction: column;
        justify-content: center; align-items: flex-start;
        padding: 60px 52px; position: relative; overflow: hidden;
    }
    .register-left::before {
        content: ''; position: absolute; top: -80px; right: -80px;
        width: 350px; height: 350px;
        background: radial-gradient(circle, rgba(201,166,212,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    .register-left .r-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(201,166,212,0.1); border: 1px solid rgba(201,166,212,0.2);
        border-radius: 30px; padding: 6px 16px; color: #c9a6d4;
        font-size: 13px; font-weight: 600; margin-bottom: 28px; position: relative; z-index:1;
    }
    .register-left h1 {
        font-size: 38px; font-weight: 800; color: #fff;
        line-height: 1.15; margin-bottom: 16px; position: relative; z-index:1;
    }
    .register-left h1 span { color: #c9a6d4; }
    .register-left .r-desc {
        font-size: 15px; color: #8a6898; line-height: 1.7;
        margin-bottom: 36px; position: relative; z-index:1;
    }
    .step-list { display: flex; flex-direction: column; gap: 14px; position: relative; z-index:1; }
    .step-item {
        display: flex; align-items: flex-start; gap: 14px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(201,166,212,0.1);
        border-radius: 12px; padding: 16px 18px;
    }
    .step-num {
        width: 28px; height: 28px; border-radius: 8px;
        background: linear-gradient(135deg, #c9a6d4, #9b59b6);
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; font-weight: 700; color: #fff; flex-shrink: 0;
    }
    .step-text h4 { font-size: 14px; font-weight: 600; color: #e0d0e6; margin: 0 0 2px; }
    .step-text p  { font-size: 12px; color: #7a6080; margin: 0; }

    /* Right Panel */
    .register-right {
        background: var(--bg-secondary);
        display: flex; flex-direction: column;
        justify-content: center; padding: 48px 56px; overflow-y: auto;
    }
    .register-right .back-link {
        display: inline-flex; align-items: center; gap: 6px;
        color: #9b7fa8; font-size: 13px; font-weight: 500;
        text-decoration: none; margin-bottom: 32px; transition: color 0.2s;
    }
    .register-right .back-link:hover { color: #7c3f8e; }
    .form-title  { font-size: 28px; font-weight: 800; color: var(--text-primary); margin-bottom: 4px; }
    .form-subtitle { font-size: 14px; color: var(--text-secondary); margin-bottom: 28px; }

    .alert-box {
        padding: 12px 16px; border-radius: 10px;
        font-size: 13px; font-weight: 500; margin-bottom: 18px;
        display: flex; align-items: center; gap: 10px;
    }
    .alert-danger { background: #fff1f2; color: #9f1239; border: 1px solid #fecdd3; }

    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .field-group { margin-bottom: 16px; }
    .field-label { display: block; font-size: 13px; font-weight: 600; color: var(--text-primary); margin-bottom: 6px; }
    .field-label .optional { font-weight: 400; color: var(--text-secondary); opacity: 0.6; font-size: 12px; margin-left: 4px; }
    .field-input {
        width: 100%; padding: 13px 16px 13px 42px;
        border: 1.5px solid var(--border-color); border-radius: 10px;
        font-size: 14px; font-family: 'Inter', sans-serif;
        color: var(--text-primary); background: var(--bg-primary); transition: all 0.2s; outline: none;
    }
    .field-input:hover { border-color: var(--accent-primary); }
    .field-input:focus { border-color: var(--accent-secondary); box-shadow: 0 0 0 3px rgba(155,89,182,0.1); background: var(--bg-secondary); }
    .field-input::placeholder { color: var(--text-secondary); opacity: 0.6; }
    .field-input.no-icon { padding-left: 16px; }
    .input-wrap { position: relative; }
    .input-wrap .fi { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #c9a6d4; font-size: 14px; }
    /* Beri ruang kanan untuk tombol eye */
    .input-wrap .field-input { padding-right: 44px; }
    .toggle-pw {
        position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
        background: none; border: none; cursor: pointer; padding: 4px;
        color: #c9a6d4; font-size: 15px; line-height: 1; transition: color 0.2s;
        display: flex; align-items: center; justify-content: center;
    }
    .toggle-pw:hover { color: #9b59b6; }

    .btn-register {
        width: 100%; padding: 15px; margin-top: 8px;
        background: linear-gradient(135deg, #c9a6d4 0%, #9b59b6 100%);
        color: #fff; border: none; border-radius: 10px;
        font-size: 15px; font-weight: 700; cursor: pointer;
        box-shadow: 0 8px 24px rgba(155,89,182,0.3); transition: all 0.25s;
    }
    .btn-register:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(155,89,182,0.4); }
    .login-link { text-align: center; font-size: 14px; color: #888; margin-top: 20px; }
    .login-link a { color: #9b59b6; font-weight: 600; text-decoration: none; }
    .login-link a:hover { text-decoration: underline; }

    @media (max-width: 768px) {
        .register-page { grid-template-columns: 1fr; }
        .register-left { display: none; }
        .register-right { padding: 40px 24px; }
        .field-row { grid-template-columns: 1fr; }
    }
</style>

<div class="register-page">
    <!-- Left Panel -->
    <div class="register-left">
        <div class="r-badge">✨ Bergabung Gratis</div>
        <h1>Mulai perjalanan <span>kebaikan</span> Anda</h1>
        <p class="r-desc">Daftar dalam 1 menit dan mulai membantu hewan yang membutuhkan.</p>
        <div class="step-list">
            <div class="step-item">
                <div class="step-num">1</div>
                <div class="step-text">
                    <h4>Buat Akun</h4>
                    <p>Isi data diri Anda dengan mudah</p>
                </div>
            </div>
            <div class="step-item">
                <div class="step-num">2</div>
                <div class="step-text">
                    <h4>Pilih Kampanye</h4>
                    <p>Temukan hewan yang perlu bantuan Anda</p>
                </div>
            </div>
            <div class="step-item">
                <div class="step-num">3</div>
                <div class="step-text">
                    <h4>Berdonasi & Pantau</h4>
                    <p>Lihat dampak nyata dari donasi Anda</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Panel -->
    <div class="register-right">
        <a href="{{ route('beranda') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Beranda
        </a>

        <h2 class="form-title">Buat Akun Baru</h2>
        <p class="form-subtitle">Isi formulir di bawah untuk memulai</p>

        @if($errors->any())
            <div class="alert-box alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="field-row">
                <div class="field-group">
                    <label class="field-label" for="username">Username</label>
                    <div class="input-wrap">
                        <i class="fas fa-at fi"></i>
                        <input type="text" id="username" name="username" class="field-input"
                            placeholder="username_kamu" value="{{ old('username') }}" required>
                    </div>
                </div>
                <div class="field-group">
                    <label class="field-label" for="no_telepon">
                        No. Telepon <span class="optional">(opsional)</span>
                    </label>
                    <div class="input-wrap">
                        <i class="fas fa-phone fi"></i>
                        <input type="text" id="no_telepon" name="no_telepon" class="field-input"
                            placeholder="08xx-xxxx-xxxx" value="{{ old('no_telepon') }}">
                    </div>
                </div>
            </div>

            <div class="field-group">
                <label class="field-label" for="email">Alamat Email</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope fi"></i>
                    <input type="email" id="email" name="email" class="field-input"
                        placeholder="email@contoh.com" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="field-row">
                <div class="field-group">
                    <label class="field-label" for="password">Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock fi"></i>
                        <input type="password" id="password" name="password" class="field-input"
                            placeholder="Min. 6 karakter" required>
                        <button type="button" class="toggle-pw" onclick="togglePw('password', this)" tabindex="-1" title="Tampilkan password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="field-group">
                    <label class="field-label" for="password_confirmation">Konfirmasi Password</label>
                    <div class="input-wrap">
                        <i class="fas fa-lock fi"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="field-input"
                            placeholder="Ulangi password" required>
                        <button type="button" class="toggle-pw" onclick="togglePw('password_confirmation', this)" tabindex="-1" title="Tampilkan password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-register">
                <i class="fas fa-user-plus me-2"></i>Buat Akun Sekarang
            </button>
        </form>

        <p class="login-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
    </div>
</div>

<script>
function togglePw(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const icon  = btn.querySelector('i');
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
