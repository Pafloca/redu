<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskAlumnPost;
use App\Models\TaskAlumn;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskAlumnController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskAlumnPost $request)
    {
        $task = new TaskAlumn();
        $task->title = $request->get('title');
        $task->description = $request->get('description');
        $task->user_alumn_id = Auth::id();
        $task->task_id = $request->get('task_id');

        $task->save();

        if ($request->file('foto')) {
            $imagen = $task->id . "-task.jpg";
            $request->file('foto')->move(public_path('taskImg'), $imagen);
        }

        return redirect("/groups");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(\Illuminate\Support\Facades\Auth::user()->rol === 'alumn') {
            return redirect("/groups");
        }

        $task = TaskAlumn::findOrFail($id);
        return view('layouts/redu.alumnTaskShow', compact("task"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $taskAlumn = TaskAlumn::findOrFail($id);
        $task = Tasks::findOrFail($taskAlumn->task_id);
        return view('layouts/redu.taskShowEdit', compact('task', "taskAlumn"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskAlumnPost $request, $id)
    {
        $task = TaskAlumn::findOrFail($id);
        $task->title = $request->get('title');
        $task->description = $request->get('description');

        $task->save();

        if ($request->file('foto')) {
            $imagen = $task->id . "-task.jpg";
            $request->file('foto')->move(public_path('taskImg'), $imagen);
        }

        return redirect("/groups");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
