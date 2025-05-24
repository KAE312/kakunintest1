@extends('layouts.app')

@section('content')
<div class="register-wrapper">
    <h1 class="brand">FashionablyLate</h1>
    <div class="register-box">
        <h2 class="register-title">Register</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">お名前</label>
                <input type="text" id="name" name="name" placeholder="例: 山田 太郎" value="{{ old('name') }}" required>
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}" required>
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
                <button type="submit">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection