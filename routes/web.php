<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


 Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');  */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/projects/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('project.store');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('project.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
    Route::get('/projects', [ProjectController::class, 'index'])->middleware(['auth'])->name('project');
    Route::post('/projects/{id}/complete', [ProjectController::class, 'complete'])->name('project.complete');

    Route::get('/admin/projects', [ProjectController::class, 'index'])->middleware(['auth'])->name('admin.project');
    Route::get('/admin/projects/create', [ProjectController::class, 'create'])->name('admin.project.create');
    Route::post('/admin/projects', [ProjectController::class, 'store'])->name('admin.project.store');
    Route::get('/admin/projects/{id}/edit', [ProjectController::class, 'edit'])->name('admin.project.edit');
    Route::put('/admin/projects/{id}', [ProjectController::class, 'update'])->name('admin.project.update');
    Route::delete('/admin/projects/{id}', [ProjectController::class, 'destroy'])->name('admin.project.destroy');
    Route::post('/admin/projects/{id}/complete', [ProjectController::class, 'complete'])->name('admin.project.complete');

    Route::get('admin/tasks/create', [TaskController::class, 'create'])->name('admin.task.create');
    Route::post('admin/tasks', [TaskController::class, 'store'])->name('admin.task.store');
    Route::get('admin/tasks/{id}/edit', [TaskController::class, 'edit'])->name('admin.task.edit');
    Route::put('admin/tasks/{id}', [TaskController::class, 'update'])->name('admin.task.update');
    Route::delete('admin/tasks/{id}', [TaskController::class, 'destroy'])->name('admin.task.destroy');
    Route::get('admin/tasks', [TaskController::class, 'index'])->middleware(['auth'])->name('admin.tasks');
    Route::post('admin/tasks/{id}/started', [TaskController::class, 'started'])->name('admin.task.started');
    Route::post('admin/tasks/{id}/complete', [TaskController::class, 'complete'])->name('admin.task.complete');
    


    Route::get('/tasks/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('task.store');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('task.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::get('/tasks', [TaskController::class, 'index'])->middleware(['auth'])->name('tasks');
    Route::post('/tasks/{id}/started', [TaskController::class, 'started'])->name('task.started');
    Route::post('/tasks/{id}/complete', [TaskController::class, 'complete'])->name('task.complete');
    
    
    
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth'])->name('admin.dashboard');
    Route::get('/admin/users', [UserController::class, 'index'])->middleware(['auth'])->name('admin.user');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
    Route::get('/', [DashboardController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

    Route::post('/notifications/{id}/mark-as-read', [TaskController::class, 'markAsRead'])->name('notifications.markAsRead');




});

require __DIR__ . '/auth.php';
