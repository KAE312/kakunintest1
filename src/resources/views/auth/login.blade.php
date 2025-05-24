@extends('layouts.app')

@section('content')
<div class="login-wrapper">
    <h1 class="brand">FashionablyLate</h1>
    <div class="login-box">
        <h2 class="login-title">Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" placeholder="例: coachtechno6" required>
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group center">
                <button type="submit">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection