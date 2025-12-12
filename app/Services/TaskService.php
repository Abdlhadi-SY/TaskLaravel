<?php

namespace App\Services;

use App\Models\Task;
use App\Models\User;

class TaskService
{

    public function getTasks(int $id, string $filters="all", int $perPage = 10){
        if($filters=="all")
            $tasks = User::find($id)->tasks()->paginate($perPage);
        else
            $tasks = User::find($id)->tasks()->where("status",$filters)->paginate($perPage);
        $allTask=User::find($id)->tasks();
        $pending=User::find($id)->tasks()->where("status","pending")->get();
        $in_progress=User::find($id)->tasks()->where("status","in_progress")->get();
        $done=User::find($id)->tasks()->where("status","done")->get();
        return (object)[
            "tasks"=>$tasks,
            "totalTasks"=>(object)[
                "allTask"=>$allTask->count(),
                "pending"=>$pending->count(),
                "in_progress"=>$in_progress->count(),
                "done"=>$done->count(),
            ]
        ];
    }

    public function findTask(int $id){
        return Task::findOrFail($id);
    }

    public function addTask(array $data, int $userId){
        Task::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id'=>$userId
        ]);
    }


}
