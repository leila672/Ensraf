<?php

namespace App\Http\Requests;

use App\Models\Student;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStudentRequest extends FormRequest
{
    public function authorize()
    {
        return true ;
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
            ], 
            'phone' => [
                'string',
                'required',
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
                'unique:users,identity_num', 
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
