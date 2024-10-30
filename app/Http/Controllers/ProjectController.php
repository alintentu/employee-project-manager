<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        return $this->projectService->getAllProjects();
    }

    public function listProjectsWithEmployees()
    {
        $projects = \App\Models\Project::with(['employees' => function ($query) {
            $query->select('employees.id as employee_id', 'employees.name', 'employee_project.project_id', 'employee_project.role');
        }])->get();

        return response()->json($projects);
    }

    public function projectsWithRole($role)
    {
        $projects = \App\Models\Project::whereHas('employees', function ($query) use ($role) {
            $query->where('role', $role);
        })->get();

        return response()->json($projects);
    }

    public function updateEmployeeRole($projectId, $employeeId, $newRole)
    {
        $project = Project::find($projectId);
        $employee = Employee::find($employeeId);

        if (!$project || !$employee) {
            return response()->json(['message' => 'Project or Employee not found'], 404);
        }

        $validRoles = ['Developer', 'Designer', 'Manager', 'Lead Developer'];
        if (!in_array($newRole, $validRoles)) {
            return response()->json(['message' => 'Invalid role specified'], 400);
        }

        $project->employees()->updateExistingPivot($employeeId, ['role' => $newRole]);

        return response()->json(['message' => 'Role updated successfully']);
    }

    public function removeEmployeeFromProject($projectId, $employeeId)
    {
        $project = \App\Models\Project::find($projectId);
        $project->employees()->detach($employeeId);

        return response()->json(['message' => 'Employee removed from project']);
    }

    public function store(StoreEmployeeRequest $request)
    {
        $validatedData = $request->validated();
        Employee::create($validatedData);
        return response()->json(['message' => 'Employee created successfully']);
    }
}
