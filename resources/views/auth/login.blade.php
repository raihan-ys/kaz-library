@extends('layouts.auth')
@section('title', 'Login')
@section('content')

<div class="card">
    <div class="card-body login-card-body rounded-lg">
        <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>

        <form action="{{ route('login') }}" method="post">
            {{-- CSRF protection --}}
            @csrf

            {{-- email --}}
            <div class="input-group mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" autocomplete="email" placeholder="user1@gmail.com" value="{{ old('email') }}" required autofocus>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            {{-- /.email --}}

            {{-- password --}}
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="password123" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            {{-- /.password --}}
            
            <div class="row">
                {{-- remember me --}}
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Ingat Saya</label>
                    </div>
                </div>

                {{-- submit --}}
                <div class="col-4">
                    <button type="submit" class="btn btn-danger" style="font-size: 1rem;">Masuk</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.login-card-body -->
</div>
@endsection
