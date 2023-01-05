<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $guarded =[];


    public function storeTask(): Task
    {
        $newTask = new Task();
        $newTask->name = $this->taskName;
        $newTask->due_date = $this->taskDueDate;
        $newTask->save();
        return $newTask;

    }
    public function updateTask(): Task
    {
        $task = self::find($this->taskId);
        $task->due_date = $this->taskDueDate;
        $task->status = $this->taskStatus;
        $task->name = $this->taskName;
        $task->save();
        return $task;

    }

    protected $taskDueDate;
    protected $taskStatus;
    protected $taskName;
    protected $taskId;

    /**
     * @param mixed $taskDueDate
     */
    public function setTaskDueDate($taskDueDate): void
    {
        $this->taskDueDate = $taskDueDate;
    }

    /**
     * @param mixed $taskStatus
     */
    public function setTaskStatus($taskStatus): void
    {
        $this->taskStatus = $taskStatus;
    }

    /**
     * @param mixed $taskName
     */
    public function setTaskName($taskName): void
    {
        $this->taskName = $taskName;
    }

    /**
     * @param mixed $taskId
     */
    public function setTaskId($taskId): void
    {
        $this->taskId = $taskId;
    }

}
