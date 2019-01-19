<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'author', 'project_id', 'subject', 'description', 'state'
    ];
}