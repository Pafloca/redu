<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Groups;
use App\Models\TaskAlumn;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index()
    {

    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/login');
    }

    public function userTasks($id)
    {
        $group = Groups::findOrFail($_GET["group"]);
        $arrayUserId = [];
        foreach ($group->userGroup as $user) {
            $arrayUserId[] = $user->id;
        }
        if(\Illuminate\Support\Facades\Auth::user()->rol !== 'teacher' || !in_array(Auth::id(), $arrayUserId)) {
            return redirect("/groups");
        }

        $user = User::findOrFail($id);
        $tasks = Tasks::where('group_id', '=', $_GET["group"])->get();

        $tareas = TaskAlumn::where("student_id", "=", $id)->get();
        $usersRealiced = [];
        foreach ($tareas as $alumn) {
            $usersRealiced[] = $alumn->task_id;
        }

        return view('layouts/redu.user', compact("user", "tasks", "usersRealiced"));
    }

    public function profile($id)
    {
        if(\Illuminate\Support\Facades\Auth::id() != $id) {
            return redirect("/groups");
        }
        $user = User::findOrFail($id);
        return view('layouts/redu.profile', compact("user"));
    }
}
