@extends('layouts.app')

@section('content')
    <h1>お問い合わせありがとうございました！</h1>

    <!-- HOMEボタン -->
    <a href="{{ route('contacts.index') }}">
        <button>HOME</button>
    </a>
@endsection
