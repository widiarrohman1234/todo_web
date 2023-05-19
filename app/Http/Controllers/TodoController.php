<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index()
    {
        $id_user = Auth::user()->id;
        $data['todo_list'] = Todo::where('id_user', $id_user)->get();
        // dd($data['todo_list']);
        $data['user'] = User::where('id', $id_user)->first();
        return view('todo.index', $data);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Membuat instance model dan mengisi data
        $todo = new Todo;
        $todo->id_user = $request->id_user;
        $todo->todos = $request->todos;

        // Menyimpan data ke database
        $todo->save();
        return to_route('todos');
    }

    public function todoStatus($id)
    {
        // dd($id);
        $response = DB::table('todos')
            ->where('id', $id)
            ->update(['status_finish' => 1]);
        // return redirect('todos/index');
        return response()->json(['data' => $response, 'status' => 'success']);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        // dd(request()->all());
        $delete = DB::table('todos')->where('todos.id', $id)->delete();
        return redirect('todos/index');
    }
}
