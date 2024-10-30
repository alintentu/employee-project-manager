<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/projects', [ProjectController::class, 'listProjectsWithEmployees']);
Route::get('/projects/role/{role}', [ProjectController::class, 'projectsWithRole']);
Route::post('/projects/{projectId}/employees/{employeeId}/role', [ProjectController::class, 'updateEmployeeRole']);
Route::delete('/projects/{projectId}/employees/{employeeId}', [ProjectController::class, 'removeEmployeeFromProject']);
