<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->get();
        $types = Type::all();
        return view('admin.projects.index', compact('projects', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {

        $validation = $request->validated();

        $validation['slug'] = Project::generateSlug($validation['title']);

        $new_project = Project::create($validation);
        
        
        if ($request->hasFile('img_path')) {
            $img_path = Storage::put('uploads', $request->img_path);
            
            $new_project->img_path = $img_path;
            $new_project->save();
        }

        if ($request['technologies']) {
            $new_project->technologies()->attach($validation['technologies']);
        }

        return to_route('admin.projects.index')->with('message', 'Project added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validation = $request->validated();

        $validation['slug'] = Project::generateSlug($validation['title']);

        
        if ($request->has('types')) {
            $project->type_id;
        }

        if ($request->has('technologies')) {
            $project->technologies()->detach();
            $project->technologies()->attach($validation['technologies']);
        }

        
        if ($request->hasFile('img_path')) {
            if ($project['img_path']) {
                Storage::delete($project->img_path);
            }
            $img_path = Storage::put('uploads', $request->img_path);
            $validation['img_path'] = $img_path;
        }

        $project->update($validation);

        return to_route('admin.projects.index')->with('message', 'Project edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->img_path) {
            Storage::delete($project->img_path);
        }

        $project->delete();
        return to_route('admin.projects.index')->with('message', 'project deleted');
    }
}
