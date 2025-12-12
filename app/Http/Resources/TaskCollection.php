<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    public $collects = TaskResource::class;

    public function toArray($request): array
    {
        return [
            'data' => $this->collection->values(),
        ];
    }
}
