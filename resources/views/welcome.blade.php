@extends('layouts.app')
@section('nav')
    @include('components.nav')
@endsection
@section('content')
    <div class="container-fluid poll-main-body">
            <div class="row">
                <div class="col-md-5 col-md-offset-4">
                    <h1 class="main-header">Create a poll</h1>
                        <poll></poll>
                </div>
            </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection