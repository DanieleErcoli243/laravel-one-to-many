<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::select('label', 'id')->get();
        $projects = Project::all();
        return view('admin.index', compact('projects','types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $types = Type::select('label', 'id')->get();
        $project = new Project();
        return view('admin.create', compact('project', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $data = $request->validate([
            'title'=>'unique:projects|string|required',
            'description'=> 'required|string',
            'image'=> 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        $project = new Project();

        $project->fill($data);

        if(Arr::exists($data, 'image')){
           $img_url =  Storage::putFile('project_images', $data['image']);
           $project->image = $img_url;
        }

        $project->save();

        return to_route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::select('label', 'id')->get();
        return view('admin.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'=>[Rule::unique('projects')->ignore($project->id), 'string', 'required'],
            'description'=> 'required|string',
            'image'=> 'nullable|image|mimes:png,jpg,jpeg',
        ]);

        if(Arr::exists($data, 'image')){
            $img_url =  Storage::putFile('project_images', $data['image']);
            $project->image = $img_url;
         }; 

        $project->fill($data);

        $project->update($data);

        return to_route('admin.projects.show', $project); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index');
    }
}
