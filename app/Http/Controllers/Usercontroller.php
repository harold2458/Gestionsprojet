<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
   
    public function index(){
       
            
        $users = User::where('role', '!=', 'admin')->with('projects')->get();

        return view('admin.users', compact('users'));

    }
    

   

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        foreach ($user->projects as $project) {
            $project->tasks()->delete();
            $project->delete();
        }

        $user->delete();

        return redirect()->route('admin.user')->with('success', 'Utilisateur supprimé avec succès.');
    }

}
