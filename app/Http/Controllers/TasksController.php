<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;


class TasksController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $newTask = new Task();
        $newTask->setTaskName($request->taskName);
        $newTask->setTaskDueDate($request->dueDate) ;
        $result = $newTask->storeTask();

        $addedInfo = [
            'id' => $result->id,
            'name' =>  $result->name,
            'dueDate' => $result->due_date
        ];

         return response()->json($addedInfo);
    }

    public function update(Request $request): Task
    {
        $task = new Task();
        $task->setTaskId($request->taskId);
        $task->setTaskDueDate($request->dueDateUpdate);
        $task->setTaskStatus($request->statusUpdate);
        $task->setTaskName($request->taskName);
        $task->updateTask();
        return $task;
    }

    public function delete(Request $request): bool
    {
        $task = new Task();
        $task->destroy($request['id']);
        return true;
    }

}
