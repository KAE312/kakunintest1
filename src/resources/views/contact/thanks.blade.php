@extends('layouts.app')

@section('content')
<div class="thanks-container">
  <p class="thanks-message">お問い合わせありがとうございました</p>
  <a href="{{ route('contact.index') }}" class="thanks-button">HOME</a>
</div>
@endsection
