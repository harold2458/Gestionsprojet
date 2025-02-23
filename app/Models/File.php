<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model

{
    protected $fillable = ['file_path', 'task_id'];
    
    public function task() {
        return $this->belongsTo(Task::class);
    }
}
