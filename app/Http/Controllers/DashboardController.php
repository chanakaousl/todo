<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Todo;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $date = now()->toDateString();
        // Get all daily task details categorized by the dates of the tasks, arranged in ascending order of the due times
        $response['tasks'] = Task::where('due_date', $date)->orderBy('due_date')->orderBy('due_time')->get();

        // Get all user's todos and tasks
        $response['todos'] = Todo::where('user_id', auth()->id())->get();
        
        return view('dashboard.index')->with($response);
    }
}
