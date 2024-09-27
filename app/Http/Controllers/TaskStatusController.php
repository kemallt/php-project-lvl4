<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('taskStatuses.index', [
            'taskStatuses' => TaskStatus::all()->map(function ($status) {
                $statusDate = Carbon::parse($status->created_at)->format('d-m-Y');
                $status->date = $statusDate;
                return $status;
            }),
            'userIsLoggedIn' => Auth::check(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('taskStatuses.create', [
            'userIsLoggedIn' => Auth::check(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskStatusRequest $request)
    {
        TaskStatus::create($request->validated());
        return redirect('/task_statuses', 201)->with('status', __('main.flashes.status_added'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskStatus $taskStatus)
    {
        return view('taskStatuses.edit', [
            'userIsLoggedIn' => Auth::check(),
            'taskStatus' => $taskStatus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus)
    {
        $taskStatus['name'] = $request->validated()['name'];
        $taskStatus->save();
        return redirect('/task_statuses')->with('status', __('main.flashes.status_changed'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        if ($taskStatus->tasks()->get()->count() > 0) {
            return redirect('/task_statuses')->with('status', __('main.flashes.status_has_tasks'));
        }
        $taskStatus->delete();
        return redirect('/task_statuses')->with('status', __('main.flashes.status_deleted'));
    }
}
