@extends('layouts.app')
@section('nav')
    @include('components.nav')
@endsection
@section('title')
<title>Poll Maker | About Poll Jam</title>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="jumbotron">
            <h1 style="font-size:50px;">The Best Place to Create a Free Poll</h1>
            <br>
            <p class="lead">Welcome to PollJam! If you’re looking for a place that allows you to easily create and share polls, look no further! And the best part? PollJam is completely free!</p>
            <hr class="my-4">
            <h2>Poll Making Features</h2>
            <p>Currently, PollJam allows you to:</p>
            <ul>
                <li>Create a free poll</li>
                <li>Save drafts of your polls</li>
                <li>Create unique links that allow you to share your polls with friends</li>
                <li>Add a captcha to protect your polls from spam</li>
                <li>Prevent people from messing with your poll results by prohibiting people from taking your poll more than once</li>
            </ul>
            <hr class="my-4">
            <h2>Planned Features</h2>
            <p>Features currently being developed:</p>
            <ul>
                <li>Facebook sharing support</li>
                <li>HTML embedding support</li>
                <li>Ability to add a password or keyword to a poll that the user must enter before they can take the poll</li>
                <li>Ability to register and login to manage your polls and results</li>
                <li>Ability to add media to polls</li>
                <li>Much, much more!</li>
            </ul>
            <hr class="my-4">
            <h2>Support</h2>
            <p>For questions, feature requests, or to report a bug, contact: PollJamDevelopment@gmail.com</p>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection