<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Task extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'body' => $this->body , 
            'completed' => $this->completed,
            'importance' => $this->importance,
            'updatedAt' => $this->updated_at,
            'project' => $this->project->id
        ];
    }
}
