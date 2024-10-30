<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'position'];

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withPivot('role');
    }

    public function projectsWithRoles()
    {
        return $this->projects()->get()->map(function ($project) {
            $project->role = $project->pivot->role;
            return $project;
        });
    }
}
