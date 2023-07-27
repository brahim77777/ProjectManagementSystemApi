<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Project extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'desc' => $this->description,
            'status' => $this->status,
            'deadLine' => $this->dead_line,
            'userId' => $this->user->name,
            'taskCount' => $this->tasks->count(),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'tasks' => $this->tasks

        ];
    }
}
