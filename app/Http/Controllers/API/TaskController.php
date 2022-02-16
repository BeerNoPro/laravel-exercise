<?php

namespace App\Http\Controllers\API;

use App\Models\TaskApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    
    public function index()
    {
        // $tasks = TaskApi::all();
        $tasks = TaskApi::paginate(4);
        return response()->json(array(
            'status' => 200, 
            'tasks' => $tasks
        ));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|min:4',
            'description' => 'required|min:3',
            'completed' => 'required|min:3',
        ]);
         
        if ($validator->fails()) {
            return response()->json([
                'status'=> 422,
                'validate_err'=> $validator->messages(),
            ]);

        } else {
            $task = new TaskApi;
            $task->name        = $request->input('name');
            $task->description = $request->input('description');
            $task->completed   = $request->input('completed');
            $task->save();
    
            return response()->json(array(
                'status' => 200,
                'success' => 'Task added successfully'
            ));
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $task = TaskApi::find($id);
        return response()->json(array(
            'status' => 200,
            'task' => $task
        ));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|min:4',
            'description' => 'required|min:3',
            'completed' => 'required|min:3',
        ]);
         
        if ($validator->fails()) {
            return response()->json([
                'status'=> 422,
                'validate_err'=> $validator->messages(),
            ]);

        } else {
            $task = TaskApi::find($id);
            $task->name = $request->input('name');
            $task->description = $request->input('description');
            $task->completed = $request->input('completed');
            $task->update();
            return response()->json(array(
                'status' => 200
            ));
        }
    }

    public function destroy($id)
    {
        $task = TaskApi::find($id);
        if ($task) {
            $task->delete();
            return response()->json(array(
                'status' => 200,
                'success' => 'Deleted task successfully'
            ));
        }
    }
}
