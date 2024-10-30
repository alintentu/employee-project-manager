<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function employees()
    {
        return $this->belongsToMany(Employee::class)->withPivot('role');
    }

    public function employeesWithRoles()
    {
        return $this->employees()->get()->groupBy('pivot.role');
    }

    public function countEmployeesByRole()
    {
        return $this->employees()
                    ->select('role', \DB::raw('count(*) as count'))
                    ->groupBy('role')
                    ->get();
    }
}
