<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = "tasks";
    protected $primaryKey = 'id';
    protected $fillable = ['value', 'estimated_duration'];
}
