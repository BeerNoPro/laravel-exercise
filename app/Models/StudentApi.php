<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentApi extends Model
{
    use HasFactory;
    protected $table = 'student_api';
    protected $fillable = [
        'name',
        'course',
        'phone',
        'email',
    ];
}
