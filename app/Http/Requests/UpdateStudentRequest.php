<?php

namespace App\Http\Requests;

use App\Models\Student;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true ;
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'unique:users,email,' . request()->user_id,
            ], 
            'name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],  
            'phone' => [
                'string',
                'required',
            ],
            'identity_photo' => [
                'array',
            ], 
            'city_id' => [
                'required',
                'integer',
            ],
            'number' => [
                'required',
                'integer',
            ],
            'school_id' => [
                'required',
                'integer',
            ],
            'academic_level' => [
                'required',
            ], 
            'identity_num' => [
                'required', 
                'unique:users,identity_num,' . request()->user_id, 
            ],
            'parent_identity' => [
                'required', 
            ],
            'identity_photo' => [
                'array',
                'required',
            ],
            'identity_photo.*' => [
                'required',
            ],
        ];
    }
}
