<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{

    public function __construct(protected TaskService $taskService )
    {
        
    }

    public function store(StoreTaskRequest $request) {
        $task = $this->taskService->createTask($request->validated(),Auth::id());
        return response()->json($task, 201);
    }
}
