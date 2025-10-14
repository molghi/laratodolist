<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // allow mass assignment of fields
    protected $fillable = ['title', 'description', 'status', 'user_id', 'due_date', 'priority', 'category'];
}
