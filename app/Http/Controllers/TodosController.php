<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Todo\StoreTodoRequest;
use App\Http\Requests\Todo\UpdateTodoRequest;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Get all user's todos
        $response['todos'] = Todo::where('user_id', auth()->id())->get();

        return view('todo.index')->with($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request)
    {
        try {
            $data = $request->all();
            $data['user_id'] = auth()->id();

            Todo::create($data);

            return back()->with('success', 'Todo created successfully');
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
        // Check whether particular user's todo or not
        $todo = $this->checkParticularUser($id);
        if ($todo) {
            $response['todo'] = $todo;
            return view('todo.edit')->with($response);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, string $id)
    {
        try {
            // Check whether particular user's todo or not
            $todo = $this->checkParticularUser($id);
            if ($todo) {
                $data = $request->all();
                $data['user_id'] = auth()->id();
                $todo->update($data);

                return back()->with('success', 'Todo updated successfully');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getModal(Request $request)
    {
        // Modal delete form
        $response['todo'] = $request->todo_id;
        
        return view('todo.delete-modal')->with($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Check whether particular user's todo or not
            $todo = $this->checkParticularUser($id);
            if ($todo) {
                // Delete Todo    
                $todo->delete();

                return back()->with('success', 'Todo deleted successfully');
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /*
    @param  int|id
    @return $todo
    */
    private function checkParticularUser($id)
    {
        // Get the Todo detail
        $todo = Todo::find($id);
        if ($todo) {
            // Check whether particular user's todo or not
            if ($todo->user_id != auth()->id())
                abort('403', 'Unauthorized action');
            else
                return $todo;
        } else {
            abort('404', 'Todo not found');
        }
    }
}