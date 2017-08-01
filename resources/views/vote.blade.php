@extends('layouts.app')
@section('nav')
    @include('components.nav')
@endsection
@section('content')
    <div class="container-fluid poll-main-body">
        <div class="row">
            <div class="col-md-5 col-md-offset-4">
                <div id="poll-error-message" class="alert alert-danger" role="alert" style="display:none;font-size: 16px;">
                    <span id="poll-error-message-text"></span>
                </div>
                <voter poll="{{ json_encode($poll) }}"></voter>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection