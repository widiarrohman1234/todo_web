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
        $data['user'] = User::where('id', $id_user)->first();
        $data['list_user'] = DB::table('users')->select('*')->get();
        $data['todo_lists'] = DB::table('todos')->select('*')->get();
        return view('todo.index', $data);
    }

    public function create(Request $request)
    {
        Todo::create([
            'todo'=>$request->get('todo')
        ]);
               return redirect()->route('todos.index')->with('success', 'Inserted');

    }

    public function store(Request $request)
    {
        $todo = new Todo;
        $todo->id_user = $request->id_user;
        $todo->todos = $request->todos;

        $todo->save();
        return to_route('todos');
    }

    public function todoStatus($id)
    {
        $response = DB::table('todos')
            ->where('id', $id)
            ->update(['status_finish' => 1]);
        return response()->json(['data' => $response, 'status' => 'success']);
    }

    public function edit($id)
    {
        $todo=Todo::where('id',$id)->first();
        return view('edit-todo',compact('todo'));
    }

    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'todos' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('todos.edit',['todo'=>$id])->withErrors($validator);
        }
        $todo=Todo::where('id',$id)->first();
        $todo->title=$request->get('todos');
        $todo->is_completed=$request->get('status_finish');
        $todo->save();

        return redirect()->route('todos')->with('success', 'Updated Todo');
    }

    public function destroy(Request $request, $id)
    {
        $request=Todo::where('id', $id)->delete();
        return redirect()->route('todos')->with('success', 'Deleted Todo');
    }
}
