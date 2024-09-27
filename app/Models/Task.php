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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->value <= 0 || $model->estimated_duration <= 0) {
                throw new \Exception('Task value and estimated duration must be positive numbers.');
            }
        });
    }
}
