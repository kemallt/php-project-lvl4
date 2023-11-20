<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(Task::class);    
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tasks.index', [
            'tasks' => Task::with('status', 'created_by', 'assigned_to')->get()->map(function ($task) {
                $taskDate = Carbon::parse($task->created_at)->format('d.m.Y');
                $task->date = $taskDate;
                return $task;
            }),
            'task_statuses' => TaskStatus::all(),
            'users' => User::all(),
            'userIsLoggedIn' => Auth::check(),
            'task_status_id' => null,
            'created_by_id' => null,
            'assigned_to_id' => null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', [
            'task' => $task,
            'userIsLoggedIn' => Auth::check(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
