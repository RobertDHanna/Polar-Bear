@extends('layouts.app')
@section('nav')
    @include('components.nav')
@endsection
@section('title')
    <title>Create a Free Poll | Poll Jam</title>
@endsection
@section('content')
    <div class="container-fluid poll-main-body">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <hat loading_gif_url="{{ asset('img/Wedges.svg') }}"></hat>
                <h1 class="main-header">Create a free poll</h1>
                <poll></poll>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection