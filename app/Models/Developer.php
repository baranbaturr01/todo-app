<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $connection = 'pgsql';

    protected $table = 'developers';
    protected $primaryKey = 'id';
    protected $fillable = ['dev_name', 'capacity', 'weekly_hours'];
}
