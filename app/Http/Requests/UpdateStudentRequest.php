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
        return Gate::allows('student_edit');
    }

    public function rules()
    {
        return [
            'last_name' => [
                'string',
                'required',
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
            'relative_relation' => [
                'required',
            ],
            'company_name' => [
                'string',
                'nullable',
            ],
            'license_number' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'identity_num' => [
                'string',
                'required',
            ],
            'identitty_photo' => [
                'array',
                'required',
            ],
            'identitty_photo.*' => [
                'required',
            ],
        ];
    }
}
