<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Log;

class ProjectService
{
    protected $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Get all projects with their associated employees.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProjects()
    {
        try {
            return $this->project->with('employees')->get();
        } catch (\Exception $e) {
            Log::error("Failed to retrieve projects: " . $e->getMessage());
            return response()->json(['error' => 'Failed to retrieve projects'], 500);
        }
    }

    /**
     * Create a new project.
     *
     * @param array $data
     * @return \App\Models\Project
     */
    public function createProject(array $data)
    {
        return $this->project->create($data);
    }
}
