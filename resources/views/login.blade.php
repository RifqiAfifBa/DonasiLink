@extends('layout.navbarUser')
@section('content')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="login-wrapper">
    <div class="login-container">
        <div class="login-header">
            <h1>Masuk ke DonasiLink</h1>
            <p>Silakan masuk dengan akun Anda untuk melanjutkan</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="login-form">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Masukkan email Anda" class="form-input" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="Masukkan password Anda" class="form-input">
            </div>

            <div class="form-remember">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">Masuk</button>
        </form>

        <div class="login-footer">
            <p>Belum punya akun? <a href="#" class="link-signup">Daftar di sini</a></p>
        </div>
    </div>
</div>

@endsection
