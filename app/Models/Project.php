<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\DataTables;


class Project extends Model
{
    use HasFactory;


    // Définir les colonnes qui peuvent être remplies
    protected $fillable = ['title', 'description', 'deadline', 'status', 'user_id'];

    // Relation avec User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec Task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
}

