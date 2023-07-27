<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index(Request $request)
    // {
        
    //     $limit = $request->get('limit');
    //     $Tasks = Task::where('project_id' , auth()->user()->id)->paginate($limit?? 8 );
    //     return response()->json($Tasks , 200);
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'body' =>'required',
            'project_id' =>'required',

        ]);
        
        Task::create(request()->all());
        return response()->noContent(200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {    
        // Validate the request data
        $request->validate([
            'body' => 'nullable|unique:projects,title,' . $task->id,
            'importance' => 'nullable|in:low,average,high',
            'completed' => 'nullable',
        ]);
    
        // Update the $project variable directly with the validated data from the request
        $task->update($request->all());
    
        return response()->json($task);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->noContent(200);
    }
}
