<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $projects = Project::with('user')->get();
            return view('admin.project', compact('projects'));


        } else {
            $projects = Auth::user()->projects;
            return view('project', compact('projects'));
        }

       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createproject');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'status' => 'required|string|in:En cours',
        ]);

        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->deadline = $request->deadline;
        $project->status = $request->status;
        $project->user_id = Auth::id();
        $project->save();

        return redirect()->route('project')->with('success', 'Projet créé avec succès');
    }
    public function complete($id)
{
    $project = Project::findOrFail($id);

    if ($project->status === 'En cours') {
        $project->status = 'Terminé';
        $project->save();
    }

    return response()->json(['success' => true, 'status' => $project->status]);
}



    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('editproject', compact('project'));
    }


    /** 
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'status' => 'required|string|in:En cours',
        ]);

        $project = Project::findOrFail($id);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->deadline = $request->deadline;
        $project->status = $request->status;
        $project->save();

        return redirect()->route('project')->with('success', 'Projet mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $project = Project::findOrFail($id);

    $project->tasks()->delete();

    $project->delete();

    return redirect()->route('project')->with('success', 'Projet et ses tâches supprimés avec succès');
}

}
