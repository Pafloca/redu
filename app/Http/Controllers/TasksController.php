<?php

namespace App\Http\Controllers;

use App\Models\Groups;
use App\Models\TaskAlumn;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts/redu.createTask');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Tasks();
        $task->title = $request->get('title');
        $task->description = $request->get('description');
        $task->user_teacher_id = Auth::id();
        $task->group_id = $request->get('group_id');

        $task->save();

        return redirect("/groups/$task->group_id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Tasks::findOrFail($id);

        $group = Groups::findOrFail($task->group_id);
        $alumns = $group->alumnGroup;

        $users = TaskAlumn::where("task_id", "=", $id)->get();
        $usersRealiced = [];
        foreach ($users as $alumn) {
            $usersRealiced[] = $alumn->user_alumn_id;
        }

        return view('layouts/redu.taskShow', compact("task", "alumns", "usersRealiced"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Tasks::findOrFail($id);
        $task->title = $request->get('title');
        $task->description = $request->get('description');

        $task->save();

        return redirect("/tasks/$task->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Tasks::findOrFail($id);
        $task->delete();
        return redirect("/groups/$task->group_id");
    }
}
