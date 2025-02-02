<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(){

        $tasks = $this->allTasksFromDB();
        return view('tasks.all_tasks', compact('tasks'));
    }

    public function deleteTaskFromDB($id){

        DB::table('tasks')->where('id', $id)->delete();
        return back();

    }

    public function viewTask($id){

        $task = DB::table('tasks')
        ->join('users', 'tasks.user_id', 'users.id')
        ->where('tasks.id', $id)
        ->select('tasks.*', 'users.name as username')
        ->first();


        return view('tasks.view_task', compact('task'));
    }

    private function allTasksFromDB(){

        $tasks = DB::table('tasks')
        ->join('users', 'tasks.user_id','=' ,'users.id')
        ->select('tasks.*', 'users.name as username')
        ->get();

        return $tasks;

    }

    public  function viewTaskForm(){
        $usersSelection = DB::table('users')->select('id', 'name')->get();

        return view('tasks.add_task', compact('usersSelection'));

    }

    public function createTask(request $request)
    {


        $request->validate([
            'name' => 'required | string | min:3',
            'description' => 'required | string | min:8',
            'due_at' => 'required | date'
        ]);

    DB::table('tasks')->insert([
            'name' => $request -> name,
            'description' => $request -> description,
            'due_at' => $request -> due_at,
            'user_id' => $request -> user_id

        ]);

        return redirect () ->route('tasks.all') -> with('message', 'tarefa adicionada com sucesso');
    }


}

