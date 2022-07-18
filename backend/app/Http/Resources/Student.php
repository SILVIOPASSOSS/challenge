<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
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
            'id'         => $this->id,
            'name'       => $this->name,
            'email'    =>$this->email,
            'academic_record'    =>$this->academic_record,
            'cpf'               =>$this->cpf,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
