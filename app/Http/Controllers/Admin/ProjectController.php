<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Http\Request;
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
        $projects = Project::all();
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view("admin.projects.create", compact("types"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $form_data["slug"] = Helpers::generateSlug($form_data['title']);

        if ($request->hasFile("image_cover")) {
            $path = Storage::put("project_images", $form_data["image_cover"]);
            $form_data["image_cover"] = $path;
        }

        //Shortcut per riempire i dati, serve sempre fillable
        $newProject = Project::create($form_data);

        return redirect()->route("admin.projects.show", $newProject->slug)->with('message', "$newProject->title creato con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view("admin.projects.show", compact("project"));
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
        return view("admin.projects.edit", compact("project", "types"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->validated();
        $form_data["slug"] =  Helpers::generateSlug($form_data['title']);

        if ($request->hasFile("image_cover")) {

            //Se il post da modificare ha già l'immagine andiamo a eliminarla
            if ($project->image_cover) {
                Storage::delete($project->image_cover);
            }

            $path = Storage::put("project_images", $form_data["image_cover"]);
            $form_data["image_cover"] = $path;
        }

        $project->update($form_data);
        return redirect()->route("admin.projects.show", $project->slug)->with('message', "$project->title modificato con successo!");;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->image_cover) {
            Storage::delete($project->image_cover);
        }
        $project->delete();
        return redirect()->route("admin.projects.index")->with("message", "$project->title è stato cancellato");
    }
}
