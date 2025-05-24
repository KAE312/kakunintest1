@extends('layouts.app')

@section('content')
<div class="contact-confirm-container">
  <h1 class="title">FashionablyLate</h1>
  <h2 class="subtitle">確認画面</h2>

  <form action="{{ route('contact.complete') }}" method="POST">
    @csrf
    <table class="confirm-table">
      <tr>
        <th>お名前</th>
        <td>{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</td>
      </tr>
      <tr>
        <th>性別</th>
        <td>{{ $inputs['gender'] }}</td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>{{ $inputs['email'] }}</td>
      </tr>
      <tr>
        <th>電話番号</th>
       <td>{{ $inputs['tel'] }}</td>
      </tr>
      </tr>
      <tr>
        <th>住所</th>
        <td>{{ $inputs['address'] }}</td>
      </tr>
      <tr>
        <th>建物名</th>
        <td>{{ $inputs['building'] }}</td>
      </tr>
      <tr>
        <th>お問い合わせの種類</th>
        <td>{{ $inputs['category'] }}</td>
      </tr>
      <tr>
        <th>お問い合わせ内容</th>
        <td>{!! nl2br(e($inputs['message'] ?? ' (未入力) ')) !!}</td>
      </tr>
    </table>

    {{-- hidden inputs for completion --}}
@foreach($inputs as $name => $value)
  <input type="hidden" name="{{ $name }}" value="{{ $value }}">
@endforeach
    

    <div class="form-footer">
      <button type="submit" name="action" value="submit" class="submit-button">送信</button>
      <button type="submit" name="action" value="back" class="back-button">修正</button>
    </div>
  </form>
</div>
@endsection

