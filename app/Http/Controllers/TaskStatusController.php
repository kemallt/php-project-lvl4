<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Auth;

class TaskStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('taskStatuses.index', [
            'taskStatuses' => TaskStatus::all(),
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
        flash('Статус успешно добавлен')->success();
        return redirect('/task_statuses')->with('status', 'Статус успешно создан');
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
        flash('Статус успешно обновлен')->success();    
        return redirect('/task_statuses')->with('status', 'Статус успшено изменён');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskStatus $taskStatus)
    {
        $taskStatus->delete();
        flash('Статус успешно удален')->success();
        return redirect('/task_statuses');
    }
}
