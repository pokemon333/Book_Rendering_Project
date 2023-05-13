<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class clientBookResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'category' => $this->category->name,
            'author' => $this->author->name,
            'description' => $this->description,
            'book_type' => $this->book_type,
            'image_id' => $this->image->image,
            'file_id' => $this->file->file,
        ];
    }
}
