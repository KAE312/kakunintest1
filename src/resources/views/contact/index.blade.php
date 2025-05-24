@extends('layouts.app')

@section('content')
<div class="form-container">
    <h1 class="title">FashionablyLate</h1>
    <h2 class="subtitle">Contact</h2>

    <form action="{{ route('contact.confirm') }}" method="POST">
        @csrf

        {{-- 名前 --}}
        <div class="form-group">
            <label>お名前 <span class="required">※</span></label>
            <div class="name-inputs">
                <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
            </div>
            @error('last_name') 
             <div class="error">{{ $message }}</div>
             @enderror
            @error('first_name') 
             <div class="error">{{ $message }}</div>
             @enderror
        </div>

        {{-- 性別 --}}
        <div class="form-group">
            <label>性別 <span class="required">※</span></label>
            <div class="radio-group">
                <label><input type="radio" name="gender" value="男性" {{ old('gender', '男性') == '男性' ? 'checked' : '' }}> 男性</label>
                <label><input type="radio" name="gender" value="女性" {{ old('gender') == '女性' ? 'checked' : '' }}> 女性</label>
                <label><input type="radio" name="gender" value="その他" {{ old('gender') == 'その他' ? 'checked' : '' }}> その他</label>
            </div>
            @error('gender') <div class="error">{{ $message }}</div> @enderror
        </div>

        {{-- メールアドレス --}}
        <div class="form-group">
            <label>メールアドレス <span class="required">※</span></label>
            <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        {{-- 電話番号 --}}
<div class="form-group">
    <label>電話番号 <span class="required">※</span></label>
    <div class="tel-inputs">
        <input type="text" name="tel1" maxlength="4" placeholder="例: 080" value="{{ old('tel1') }}"> -
        <input type="text" name="tel2" maxlength="4" placeholder="例: 1234" value="{{ old('tel2') }}"> -
        <input type="text" name="tel3" maxlength="4" placeholder="例: 5678" value="{{ old('tel3') }}">
    </div>
    @error('tel1') <div class="error">{{ $message }}</div> @enderror
    @error('tel2') <div class="error">{{ $message }}</div> @enderror
    @error('tel3') <div class="error">{{ $message }}</div> @enderror
</div>

        {{-- 住所 --}}
        <div class="form-group">
            <label>住所 <span class="required">※</span></label>
            <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
            @error('address') 
            <div class="error">{{ $message }}</div>
             @enderror
        </div>

        {{-- 建物名 --}}
        <div class="form-group">
            <label>建物名</label>
            <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
        </div>

        
        {{-- お問い合わせの種類 --}}
<div class="form-group">
    <label>お問い合わせの種類 <span class="required">※</span></label>
    <select name="category_id">
        <option value="">選択してください</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->id }}.{{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id') 
    <div class="error">{{ $message }}</div> @enderror
</div>

        {{-- 内容 --}}
        <div class="form-group">
            <label>お問い合わせ内容 <span class="required">※</span></label>
            <textarea name="message" placeholder="お問い合わせ内容をご記載ください">{{ old('message') }}</textarea>
            @error('message')
             <div class="error">{{ $message }}</div>
              @enderror
        </div>

        <div class="button-wrapper">
            <button type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection
