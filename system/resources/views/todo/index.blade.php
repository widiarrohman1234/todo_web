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
                    <a class="nav-link" aria-current="page" href="#">Users</a>
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

    <div class="text-center mt-5">
        <h2>Add Todo</h2>

        <form class="row g-3 justify-content-center" method="POST" action="{{route('todos.store')}}">
            @csrf
            <div class="col-6">
                <input type="text" class="form-control" name="todos" placeholder="Title">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </div>
        </form>

        <div class="text-center">
            <h2>All Todos</h2>
            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Todo</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php $counter=1 @endphp

                            @foreach($todo_lists as $t)
                            <tr>
                                <th>{{$counter}}</th>
                                <td>{{$t->todos}}</td>
                                <td>
                                    @if($t->status_finish)
                                    <div class="badge bg-success">Completed</div>
                                    @else
                                    <div class="badge bg-warning">Not Completed</div>
                                    @endif
                                </td>
                                <td>{{$t->created_at}}</td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$t->id}}">
                                        Edit
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$t->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form action="{{route('todos.edit', $t->id)}}" method="POST" onsubmit="return confirm('Apakah anda yakin sudah selesai ??')">
                                                        @csrf
                                                        @method("PUT")
                                                        <input type="hidden" value="{{$t->id}}" name="id">
                                                        <input type="hidden" value="{{request()->user()->id}}" name="id_user">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Are you done?</label><br>
                                                            <!-- <input type="text" class="form-control" id="recipient-name"> -->
                                                            <button type="submit" class="btn btn-primary">Finish</button>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="message-text" class="col-form-label">Todo:</label>
                                                            <textarea class="form-control" id="message-text" name="todos">{{$t->todos}}</textarea>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form action="{{route('todos.destroy', $t->id)}}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ??')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>

                            @php $counter++; @endphp

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Jumbotron -->


@endsection