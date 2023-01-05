<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TasksController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {

        $validator = Validator::make($request->all(), [
            'taskName' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 400); // 400 being the HTTP code for an invalid request.
        }

        $newTask = new Task();
        $newTask->setTaskName($request->taskName);
        $newTask->setTaskDueDate($request->dueDate);
        $result = $newTask->storeTask();

        $addedInfo = [
            'id' => $result->id,
            'name' => $result->name,
            'dueDate' => $result->due_date
        ];

        return response()->json($addedInfo);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'taskName' => 'required'
        ]);
        if ($validator->fails())
        {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 400); // 400 being the HTTP code for an invalid request.
        }
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
