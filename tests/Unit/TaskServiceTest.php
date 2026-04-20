<?php

use App\Models\User;
use App\Services\TaskService;

it('creates a task correctly', function () {
   // Arrange
   $taskData = [
        'title' => 'Test task',
        'description' => 'Test description'
   ];
   $taskService = new TaskService();
   $userId = 1;

   // Act
   $task = $taskService->createTask($taskData, $userId);
   
   // Assert
   expect($task->title)->toBe('Test task');
   expect($task->description)->toBe('Test description');
});
