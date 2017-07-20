@extends('layouts.app')
@section('nav')
    @include('components.nav')
@endsection
@section('content')
    <div class="container-fluid poll-main-body">
            <div class="row">
                <div class="col-md-5 col-md-offset-4">
                    <h1 class="main-header">Create a poll</h1>
                        <form class="poll">
                            <label>
                                <input id="fname" type="text" placeholder="You can type your question here.">
                                <span>Question</span>
                            </label>

                            <label>
                                <input class="poll-option-input" id="fname" type="text" placeholder="You can put an option here.">
                                <span>Option</span>
                            </label>

                            <label>
                                <input class="poll-option-input" id="fname" type="text" placeholder="You can put an option here.">
                                <span>Option</span>
                            </label>
                            
                            <input type="submit" value="Create">
                        </form>
                </div>
            </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection