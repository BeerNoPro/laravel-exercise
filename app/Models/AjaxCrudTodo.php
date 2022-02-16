<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjaxCrudTodo extends Model
{
    use HasFactory;

    protected $table = 'ajax_crud_todos';
    protected $fillable = [
        'title', 'description'
    ];
}
