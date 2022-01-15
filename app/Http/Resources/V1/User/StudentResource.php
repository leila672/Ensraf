<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $voice = $this->voice ? asset($this->voice->getUrl()) : null;
        $voice = str_replace('public/public','public',$voice);
        return [
            'id' => $this->id,
            'name' => $this->user->name ?? '',
            'last_name' => $this->user->last_name ?? '',
            'email' => $this->user->email ?? '',
            'phone' => $this->user->phone ?? '',
            'identity_num' => $this->user->identity_num ?? '',
            'city' => $this->user->city->name_ar ?? '',
            'number' => $this->number,
            'academic_level' => $this->academic_level,
            'class_number' => $this->class_number,
            'school' => $this->school->name,
            'start_time' => $this->school->start_time,
            'end_time' => $this->school->end_time,
            'voice' => $voice,
        ];
    }
}
