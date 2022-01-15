<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $image = $this->photo ? asset($this->photo->getUrl()) : null;
        $image = str_replace('public/public','public',$image);
        $identity_photo = $this->identity_photo ? asset($this->identity_photo->getUrl()) : null;
        $identity_photo = str_replace('public/public','public',$identity_photo);
        return [
            'id' => $this->id,
            'name' => $this->user->name ?? '',
            'last_name' => $this->user->last_name ?? '',
            'email' => $this->user->email ?? '',
            'phone' => $this->user->phone ?? '',
            'identity_num' => $this->user->identity_num ?? '',
            'city' => $this->user->city->name_ar ?? '',
            'relative_relation' => $this->relative_relation,
            'company_name' => $this->company_name,
            'license_number' => $this->license_number,
            'image' => $image,
            'identity_photo' => $identity_photo,
            'students' => StudentResource::collection($this->parentStudents),
        ];
    }
}
