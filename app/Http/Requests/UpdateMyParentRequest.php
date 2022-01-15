<?php

namespace App\Http\Requests;

use App\Models\MyParent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMyParentRequest extends FormRequest
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
                'unique:users,email,' . request()->user_id,
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
                'unique:users,identity_num,' . request()->user_id,
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'relative_relation' => [
                'required',
            ],
            'company_name' => [
                'string',
                'nullable',
            ],
            'license_number' => [
                'string',
                'nullable',
            ],
        ];
    }
}
