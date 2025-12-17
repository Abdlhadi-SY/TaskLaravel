<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateDetailsRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public  function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }

    public function showAllTasks(Request $request){
        $perPage = $request->get('per_page', 10);
        $tasks = $this->taskService->getTasks($request->user()->id, $request->status,$perPage);
        return $tasks;
    }

    public function showTask(Request $request){
        return new TaskResource($this->taskService->findTask($request->id));
    }

    public function addTask(StoreTaskRequest $request){

        $data=$request->validated();
        $this->taskService->addTask($data,$request->user()->id);
        return response()->json([
            'message' => 'Task  added successfully'
        ],200);
    }

    public function updateTaskStatus(Request $request,Task $task){
        $this->authorize('ownsTask', $task);
        $request->validate(['status' => 'required|string|in:pending,done,in_progress']);
        $task->update(["status"=>$request->status]);
        return response()->json(['message' => 'Task status updated successfully',]);
    }

    public function updateTaskDetails(UpdateDetailsRequest $request,Task $task){
        $this->authorize('ownsTask', $task);
        $data=$request->validated();
        if($data["title"]!=$task->title)
            $request->validate(["title"=>"unique:tasks"]);
        $task->update([
            "title"=>$data["title"],
            "description"=>$data["description"]
        ]);
        return response()->json(['message' => 'The task has been updated successfully.']);
    }

    public function deleteTask(Task $task){
        $this->authorize('ownsTask', $task);
        $task->delete();
    }
}
