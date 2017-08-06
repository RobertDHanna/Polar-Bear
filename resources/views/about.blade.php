@extends('layouts.app')
@section('nav')
    @include('components.nav')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
        <h1 class="display-3">Hello, there!</h1>
        <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
        <hr class="my-4">
        <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        <h2 class="display-3">What this is</h2>
        <hr class="my-4">
        <h2 class="display-3">What's planned</h2>
        <hr class="my-4">
        <h2 class="display-3">Support</h2>
        <hr class="my-4">
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection