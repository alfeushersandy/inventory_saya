@extends('layouts.auth.master', ['title' => 'login - SIDA'])

@section('content')
<form class="card card-md border-0 rounded-3" action="{{ route('login') }}" method="POST">
    @csrf
    <div class="card-body">
        <h3 class="text-center mb-3 font-weight-medium">
            Login Page
        </h3>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="masukan email anda" name="email">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Kata Sandi</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="masukan kata sandi anda" name="password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
        </div>
    </div>
</form>
@endsection