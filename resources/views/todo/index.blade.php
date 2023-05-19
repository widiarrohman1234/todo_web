@extends('template.base')
@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarExample01" aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarExample01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('logout')}}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- /Navbar -->

<!-- Jumbotron -->
<div class="p-5 text-center bg-light" style="margin-top: 58px;">
    <h1 class="mb-3">Hello, {{$user->username}}. How Are you?</h1>
    <h4 class="mb-3">I hope today's efforts do not betray tomorrow's results</h4>

    <table class="table caption-top">
        <caption>List of users</caption>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Created at</th>
            </tr>
        </thead>
        <tbody>
            @foreach($list_user as $d)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$d->username}}</td>
                <td>{{$d->email}}</td>
                <td>{{$d->created_at}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- /Jumbotron -->


@endsection