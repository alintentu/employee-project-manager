<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of projects with employees.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $projects = $this->projectService->getAllProjects();
        return ProjectResource::collection($projects);
    }

    /**
     * Store a new project in the database.
     *
     * @param \App\Http\Requests\StoreProjectRequest $request
     * @return \App\Http\Resources\ProjectResource
     */
    public function store(StoreProjectRequest $request)
    {
        $project = $this->projectService->createProject($request->validated());
        return new ProjectResource($project);
    }
}
