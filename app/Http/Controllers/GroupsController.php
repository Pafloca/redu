<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupPost;
use App\Models\Groups;
use App\Models\TaskAlumn;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $groups = $user->myGroups;
        return view('layouts/redu.groups', compact('groups'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Illuminate\Support\Facades\Auth::user()->rol === 'alumn') {
            return redirect("/groups");
        }

        return view('layouts/redu.createGroup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupPost $request)
    {
        $group = new Groups();
        $group->name = $request->get('name');
        $group->acronym = $request->get('acronym');
        $group->user_teacher_id = Auth::id();

        $group->save();

        if ($request->file('foto')) {
            $imagen = $group->id . "-group.jpg";
            $request->file('foto')->move(public_path('img'), $imagen);
        }

        $group->teacherGroup()->attach(Auth::user());

        return redirect("/groups/$group->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Groups::findOrFail($id);

        $arrayTeacher = [];
        foreach ($group->teacherGroup as $profe) {
            $arrayTeacher[] = $profe;
        }

        $arrayAlumn = [];
        foreach ($group->alumnGroup as $alumn) {
            $arrayAlumn[] = $alumn;
        }

        $arrayUserId = [];
        foreach ($group->userGroup as $user) {
            $arrayUserId[] = $user->id;
        }
        if(!in_array(Auth::id(), $arrayUserId)) {
            return redirect("/groups");
        }

        $tasks = Tasks::where('group_id', '=', $id)->get();

        $tareas = TaskAlumn::where("student_id", "=", Auth::id())->get();
        $usersRealiced = [];
        foreach ($tareas as $alumn) {
            $usersRealiced[] = $alumn->task_id;
        }

        return view('layouts/redu.groupShow', compact('group', 'arrayTeacher', 'arrayAlumn', 'tasks', "usersRealiced"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Illuminate\Support\Facades\Auth::user()->rol === 'alumn') {
            return redirect("/groups");
        }
        $group = Groups::findOrFail($id);
        return view('layouts/redu.editGroup', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupPost $request, $id)
    {
        $group = Groups::findOrFail($id);
        $group->name = $request->get('name');
        $group->acronym = $request->get('acronym');

        $group->save();

        if ($request->file('foto')) {
            $imagen = $group->id . "-group.jpg";
            $request->file('foto')->move(public_path('img'), $imagen);
        }

        return redirect("/groups/$group->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Groups::findOrFail($id);
        $group->delete();
        $imagen = public_path('/img/'.$id.'-group.jpg');
        if (@getimagesize($imagen)) {
            unlink($imagen);
        }
        return redirect("/groups");
    }
    public function invite($id) {
        $group = Groups::findOrFail($id);
        $group->teacherGroup()->attach(Auth::user());
        return redirect("/groups");
    }

    public function addAlumnGroup(Request $request) {
        $user_id = $request->get('user_id');
        $group_id = $request->get('group_id');
        $user = User::findOrFail($user_id);
        $group = Groups::findOrFail($group_id);
        $group->teacherGroup()->attach($user);
        return redirect("/studentList/$group_id");
    }

    public function alumnList($id) {
        $group = Groups::findOrFail($id);
        $students = User::where("rol", "=", 'alumn')->get();
        $teachers = User::where("rol", "=", 'teacher')->get();
        $arrayAlumn = [];
        foreach ($group->alumnGroup as $alumn) {
            $arrayAlumn[] = $alumn->id;
        }
        $arrayTeacher = [];
        foreach ($group->teacherGroup as $profe) {
            $arrayTeacher[] = $profe->id;
        }
        return view('layouts/redu.listAlumn', compact('group', 'students', 'teachers', 'id', 'arrayAlumn', 'arrayTeacher'));
    }

    public function deleteUserList(Request $request) {
        $user_id = $request->get('user_id');
        $group_id = $request->get('group_id');
        $user = User::findOrFail($user_id);
        $group = Groups::findOrFail($group_id);
        $group->teacherGroup()->detach($user);
        return redirect("/studentList/$group_id");
    }

}
