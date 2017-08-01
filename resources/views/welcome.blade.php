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
            <div id="poll-info-message" class="alert alert-info" style="display:none;font-size: 16px;">
                <span id="poll-info-message-text"></span>
            </div>
            <img id="poll-loading-wedge" style="display:none;margin: auto;width: 25%;" src="{{ asset('img/Wedges.svg') }}" />
                <h1 class="main-header">Create a poll</h1>
                        {{--  @php $obj = json_decode('[{"a":1,"b":2,"c":3,"d":4,"e":5}]', true);@endphp 
                    <poll :options='{{ json_encode($obj) }}'></poll>  --}}
                    <poll></poll>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection