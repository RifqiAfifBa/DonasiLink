@extends('layouts.app')

@section('body')
    @include('partials.navbar-donatur')
    <main class="min-h-[calc(100vh-64px)]">
        @yield('content')
    </main>
    @include('partials.footer')
@endsection
