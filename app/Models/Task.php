<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    public function creator()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function points()
    {
        return $this->hasMany('App\Models\TaskPoint');
    }

    public function files()
    {
        return $this->hasMany('App\Models\File');
    }
}
