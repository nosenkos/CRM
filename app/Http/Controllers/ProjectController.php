<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('user_id','=',auth()->user()->id)->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = auth()->user()->clients;
        return view('projects.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
            'client'=>'required|integer',
            'description'=>'nullable|string',
            'estimation'=>'nullable|integer'
        ]);

        $project = Project::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'client_id'=>$request->client,
            'user_id'=>auth()->user()->id,
            'estimation'=>$request->estimation,
            'time_spent'=> 0,
            'status'=>'ongoing'
        ]);

        if($project){
            Session::flash('success',__('Project has been created'));
            return redirect('/projects');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->authorize('owner', $project);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $this->authorize('owner', $project);

        $clients = auth()->user()->clients;
        return view('projects.edit', compact('project','clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('owner', $project);

        $request->validate([
            'name'=>'required|string',
            'client'=>'required|integer',
            'description'=>'nullable|string',
            'estimation'=>'nullable|integer',
            'time_spent'=>'nullable|integer',
            'status'=>'required'
        ]);

        $project->name = $request->name;
        $project->client_id = $request->client;
        $project->description = $request->description;
        $project->estimation = $request->estimation;
        $project->time_spent = $request->time_spent;
        $project->status = $request->status;

        if($project->save()){
            Session::flash('success',__('Project updated'));
            return redirect('/projects');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('owner', $project);

        if(Project::destroy($project->id)){
            Session::flash('error',__('Project removed'));
            return redirect()->back();
        }
    }
}
