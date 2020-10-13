<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    public function task()
    {
        return $this->belongsTo('App\Models\Task');
    }
}
