<?php
namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user(); 

        if ($user->role === 'admin') {
            $totalUsersCount = User::where('role', '!=', 'admin')->count();
            $ProjectsCount = Project::count();
            $completedProjectsCount = Project::where('status', 'Terminé')->count();

            return view('admin.dashboard', compact(
                'totalUsersCount',
                'ProjectsCount',
                'completedProjectsCount'
            ));
        } else {
            $totalTasksCount = Task::where('assigned_to', $user->id)->count();
            $completedTasksCount = Task::where('status', 'Terminé')->where('assigned_to', $user->id)->count();
            $inProgressTasksCount = Task::where('status', 'En cours')->where('assigned_to', $user->id)->count();
            $notStartedTasksCount = Task::where('status', 'Non commencé')->where('assigned_to', $user->id)->count();

            $totalProjectsCount = Project::where('user_id', $user->id)->count();
            $completedProjectsCount = Project::where('status', 'Terminé')->where('user_id', $user->id)->count();

            return view('dashboard', compact(
                'totalTasksCount',
                'completedTasksCount',
                'inProgressTasksCount',
                'notStartedTasksCount',
                'totalProjectsCount',
                'completedProjectsCount'
            ));
        }
    }
}