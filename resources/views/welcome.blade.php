@extends('layouts.app')
@section('nav')
    @include('components.nav')
@endsection
@section('content')
    <div class="container-fluid poll-main-body">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="panel poll-form">
                    

                    <div class="input-group input-group-lg full-width">
                        <input type="text" class="form-control poll-input" placeholder="Type your question here">
                    </div>
                    <br>
                    <div class="input-group full-width">
                        <input type="text" class="form-control poll-input" placeholder="Enter poll option">
                        <input type="text" class="form-control poll-input" placeholder="Enter poll option">
                        <input type="text" class="form-control poll-input" placeholder="Enter poll option">
                    </div>

                    <button type="button" class="btn btn-primary">Create</button>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection