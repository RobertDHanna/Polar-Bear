@extends('layouts.app')
@section('nav')
    @include('components.nav')
@endsection
@section('content')
    <div class="container-fluid poll-main-body">
        <div class="row">
            <div class="col-md-5 col-md-offset-4">
                <hat loading_gif_url="{{ asset('img/Wedges.svg') }}"></hat>
                @php dd($results->toArray()); @endphp
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection