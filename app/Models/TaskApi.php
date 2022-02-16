<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskApi extends Model
{
    use HasFactory;
    protected $table = 'task_api';
    protected $fillable = [
        'name',
        'description',
        'completed',
    ];
}
