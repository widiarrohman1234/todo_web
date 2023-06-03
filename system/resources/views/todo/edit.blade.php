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
                        <form action="{{route('todos.destroy', $t->id)}}" method="POST">
                            <a class="btn btn-primary">Edit</a>
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

        <div class="row justify-content-center mt-5">

            <div class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" value="{{$todo->todos}}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="is_completed" id="" class="form-control">
                        <option value="1" @if($todo->status_finish==1) selected @endif>Complete</option>
                        <option value="0" @if($todo->status_finish==0) selected @endif>Not Complete</option>
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
    </div>
    <!-- /Jumbotron -->


@endsection
