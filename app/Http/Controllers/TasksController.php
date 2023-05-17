<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\UpdateTaskRequest;
use Exception;
use App\Models\Task;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Task\StoreTaskRequest;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        // Get todo
        $response['todo'] = Todo::find($id);
        // Get all tasks according to todo
        $response['tasks'] = Task::where('todo_id', $id)->orderBy('due_date')->orderBy('due_time')->get();
        return view('task.index')->with($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        try {
            $data = $request->all();

            Task::create($data);

            return back()->with('success', 'Task created successfully');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::find($id);
        if ($task) {
            $response['task'] = $task;
            return view('task.edit')->with($response);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        try {
            $task = Task::find($id);
            if ($task) {
                $data = $request->all();
                $task->update($data);

                return back()->with('success', 'Task updated successfully');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // Get delete modal
    public function getModal(Request $request)
    {
        $response['task'] = $request->task_id;
        return view('task.delete-modal')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $task = Task::find($id);
            if ($task) {
                // Delete Task    
                $task->delete();

                return back()->with('success', 'Task deleted successfully');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // Change the status of the Task
    public function status(string $id)
    {
        try {
            $task = Task::find($id);
            if ($task) {
                $status = 0;
                if ($task->status == 0)
                    $status = 1;

                $data['status'] = $status;
                $task->update($data);

                return back()->with('success', 'Task changed successfully');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}