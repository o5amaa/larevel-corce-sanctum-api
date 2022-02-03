<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'Book' => [
                'name' => $this->name,
                's_body' => Str::limit($this->body, 10, '...'),
                'body' => $this->body,
                'author_name' => $this->user->name,
                'created_at' => $this->created_at->diffForHumans(),
                'like' => $this->like(),
            ],
            'comments' => CommentsResource::collection($this->comment),
        ];
    }
}
