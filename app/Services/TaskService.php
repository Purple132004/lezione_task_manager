<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createTask(array $data, int $userId)
    {
        return Task::create ([
            ...$data,
            'user_id' => $userId
        ]);
    }

}
