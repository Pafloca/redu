<?php

use App\Http\Controllers\GroupsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function () {

    Route::get('/', [GroupsController::class, 'index']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('groups', 'GroupsController');
    Route::resource('tasks', 'TasksController');
    Route::resource('taskAlumn', 'TaskAlumnController');

    Route::get('/groupsInvite/{id}', [\App\Http\Controllers\GroupsController::class, 'invite']);
    Route::post('/addStudentGroup', [\App\Http\Controllers\GroupsController::class, 'addAlumnGroup']);
    Route::post('/deleteStudentGroup', [\App\Http\Controllers\GroupsController::class, 'deleteUserList']);
    Route::get('/studentList/{id}', [\App\Http\Controllers\GroupsController::class, 'alumnList']);

    Route::get('/userTasks/{id}', [ProfileController::class, 'userTasks']);

    Route::get('/profile/{id}', [ProfileController::class, 'profile']);

    Route::put("/updateNote/{id}", [\App\Http\Controllers\TaskAlumnController::class, 'updateMark']);
});




require __DIR__.'/auth.php';
