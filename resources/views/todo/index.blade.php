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
    <h1 class="mb-3">What {{$user->username}} has to do!</h1>
    <h4 class="mb-3">I hope today's efforts do not betray tomorrow's results</h4>

    <form action="{{url('todos')}}" method="post">
        @csrf
        <input type="hidden" name="id_user" value="{{$user->id}}">
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Your todo</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="todos" placeholder="Input your todo">
            </div>
        </div>
        <button type="submit" class="btn btn-primary ">Save</button>
    </form>

    <table class="table align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Action</th>
                <th scope="col">To do</th>
                <th scope="col">Complete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($todo_list as $d)
            <tr>
                <td><input type="text" id="id_data" value="{{$d->id}}"></td>
                <th scope="row">{{$loop->iteration}}</th>
                <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal{{$d->id}}">
                        <i class="fa fa-pencil-square" aria-hidden="true"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$d->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail To do</h1>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{$d->todos}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="buttonComplete">Complete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Modal -->

                    <button type="button" class="btn btn-link btn-sm px-3" data-ripple-color="dark">
                        @include('template.utils.delete',['url'=> url('todos', $d->id)])
                    </button>
                </td>
                <td>@if($d->status_finish == 0) {{$d->todos}} @else <s>{{$d->todos}}</s> @endif</td>
                <td><input type="checkbox" id="todo-checkbox"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $('.todo-checkbox').on('change', function() {
                var id = document.getElementById('id_data').value;
                console.log("aaahhhdddd"+id)
                var taskId = $(this).closest('tr').find('td:first').text();
                var completed = $(this).is(':checked') ? 1 : 0;
                var todoCheck = document.getElementById('todo-checkbox');
                $.ajax({
                    url: '/todos-status/' + id,
                    method: 'POST',
                    data: {
                        id: taskId,
                        status_finish: completed
                    },
                    success: function(response) {
                        console.log('success saved to database');
                    },
                    error: function(xhr, status, error) {
                        console.log('Error saved to database');
                    }
                });
            });
        });
        var button = document.getElementById('buttonComplete');
        button.addEventListener('click', sendData);

        var button = document.getElementById('buttonComplete');
        button.addEventListener('click', sendData);

        // menggunakan jQuery
        $('#buttonComplete').click(sendData);

        function sendData() {
            // Mengambil data yang ingin dikirim, misalnya dari field input
            var id_data = document.getElementById('id_data').value;
            console.log("sendData " + id_data)
            // Mengirim data ke server menggunakan Ajax
            $.ajax({
                url: '/todos-status/' + id_data,
                method: 'POST',
                data: data,
                success: function(response) {
                    // Menampilkan pesan jika data berhasil dikirim
                    alert('Data berhasil dikirim!');
                },
                error: function() {
                    // Menampilkan pesan jika terjadi kesalahan saat mengirim data
                    alert('Terjadi kesalahan saat mengirim data.');
                }
            });
        }
    </script>
</div>
<!-- /Jumbotron -->


@endsection