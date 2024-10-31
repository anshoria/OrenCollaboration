<?php

namespace App\Http\Controllers;

use App\Models\ProjectContent;
use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projectContent = ProjectContent::first();
        $projects = Projects::all();
        return view('projects', compact('projects', 'projectContent'));
    }
    public function show(Projects $project)
    {
        return view('projects.show', compact('project'));
    }
}
