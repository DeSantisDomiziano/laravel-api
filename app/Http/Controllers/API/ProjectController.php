<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::with(['technologies', 'type'])->orderByDesc('id')->get();

        return response()->json([
            'success' => true,
            'projects' => $projects
        ]);
    }

    function show( $slug) {

        $project = Project::with(['technologies', 'type'])->where('slug', $slug)->first();

        if ($project) {

            return response()->json([
                'success' => true,
                'project' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Post not found 404',
            ]);
        }
    }
    
}
