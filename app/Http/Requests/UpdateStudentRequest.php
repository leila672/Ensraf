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
            'identity_num' => [
                'required',
                'unique:users',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
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
                'integer',
                'unique:users,identity_num,' . request()->user_id,
                'min:-2147483648',
                'max:2147483647',
            ],
            'parent_identity' => [
                'required', 
                'integer', 
                'min:-2147483648',
                'max:2147483647',
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
