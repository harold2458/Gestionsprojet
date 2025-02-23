<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Notifications\TaskAssigned;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        $user = auth()->user();
        if (Auth::user()->role === 'admin') {
            $tasks = Task::with('user')->get();
            return view('admin.task', compact('tasks'));


        } else {

            $tasks = Task::with('project', 'assignedTo', 'createdBy')
                ->where(function ($query) use ($user) {
                    $query->where('assigned_to', $user->id)  // Tâches assignées à l'utilisateur
                        ->orWhere('created_by', $user->id); // Tâches créées par l'utilisateur (ajouter `created_by` dans le modèle Task)
                })
                ->get();
            return view('task', compact('tasks'));
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role === 'admin') {
            $projects = Auth::user()->projects;

            $users = User::get();
    
            return view('admin.createtask', compact('projects', 'users'));}

        
        else{$projects = Auth::user()->projects;

            $users = User::where('role', '!=', 'admin')->get();
    
            return view('createtask', compact('projects', 'users'));}

        
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assigned_to' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
            'priority' => 'required|in:Basse,Moyenne,Haute',
            'status' => 'required|in:En cours,Non commencé',

        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to' => $request->assigned_to,
            'project_id' => $request->project_id,
            'priority' => $request->priority,
            'status' => $request->status,
            'created_by' => auth()->user()->id,

        ]);

        if ($task->assigned_to) {
            $user = User::find($task->assigned_to);
            $user->notify(new TaskAssigned($task));
        }

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.tasks')->with('success', 'Task created successfully!');
        }
            else{

            

        return redirect()->route('tasks')->with('success', 'Task created successfully!');
    }
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::with('project', 'assignedTo')->findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Auth::user()->role === 'admin') {
            $task = Task::findOrFail($id);
            $users = User::all();
            $projects = Project::all();
            return view('admin.edittask', compact('task', 'users', 'projects'));

        } else {
            $task = Task::findOrFail($id);
            $users = User::all();
            $projects = Project::all();
            return view('edittask', compact('task', 'users', 'projects'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:Non commencé,En cours,Terminé',
            'priority' => 'required|in:Basse,Moyenne,Haute',
            'project_id' => 'required|exists:projects,id',
            'assigned_to' => 'nullable|exists:users,id',


        ]);


        $task = Task::findOrFail($id);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->assigned_to = $request->assigned_to;
        $task->project_id = $request->project_id;
        $task->priority = $request->priority;
        $task->status = $request->status;
        $task->created_by = auth()->user()->id;
        $task->save();

        if ($task->assigned_to) {
            $user = User::find($task->assigned_to);
            $user->notify(new TaskAssigned($task));
        }

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.tasks')->with('success', 'Tâche mise a jours avec succèe');

        } else {
            return redirect()->route('tasks')->with('success', 'Tâche mise a jours avec succèe');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks')->with('success', 'Tâches supprimée avec succès');
    }


    public function complete($id)
    {
        $task = Task::findOrFail($id);

        if ($task->status === 'En cours') {
            $task->status = 'Terminé';
            $task->save();
        }

        return response()->json(['success' => true, 'status' => $task->status]);
    }
    public function started($id)
    {
        $task = Task::findOrFail($id);

        if ($task->status === 'Non commencé') {
            $task->status = 'En cours';
            $task->save();
        }

        return response()->json(['success' => true, 'status' => $task->status]);
    }
    public function markAsRead($id)
    {
        $notification = DatabaseNotification::find($id);

        if ($notification && $notification->notifiable_id === auth()->id()) {
            $notification->markAsRead();

            return redirect()->route('dashboard')->with('success');
        }

    }


}
