<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Project as ProjectResource;

use function PHPUnit\Framework\returnSelf;
use function PHPUnit\Framework\throwException;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // public function __construct()
    // {
    //     $this->middleware('auth:api');   
    // }

    
    public function index(Request $request)
    {

        $limit = $request->get('limit');
        $projects = Project::where('user_id' , auth()->user()->id)->paginate($limit?? 4 ); 

        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|unique:projects,title',
            'description' =>'required',
        ]);

        if(request()->get('user_id') != auth()->user()->id)  return response('Cant assign projects to other users', 401);
        Project::create(request()->all());
        return response()->json([], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project = Project::where('user_id', auth()->user()->id ,'and', 'id', $project->id )->first();
        
        return response()->json($project);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {    
        // Validate the request data
        $request->validate([
            'title' => 'nullable|unique:projects,title,' . $project->id,
            'description' => 'nullable',
            'status' => 'nullable|in:done,onGoing,canceled',
            'dead_line' => 'nullable',
        ]);
        if($project->user_id != auth()->user()->id) return response("Project not found" , 401);
        // Update the $project variable directly with the validated data from the request
        $project->update($request->all());
    
        return response()->json($project);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if($project->user_id != auth()->user()->id) return response("Project not found");
        $project->delete();
        return response()->noContent(200);
        //
    }
}
