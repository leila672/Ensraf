<?php

namespace App\Http\Requests;

use App\Models\School;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSchoolRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('school_edit');
    }

    public function rules()
    {
        return [ 
            'area' => [
                'string',
                'required',
            ],
            'sector' => [
                'string',
                'required',
            ], 
            'classificaion' => [
                'string',
                'required',
            ],
            'longitude' => [
                'numeric',
            ],
            'latitude' => [
                'numeric',
            ],
            'end_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            
            'city_id' => [
                'required',
                'integer',
            ],
            'identity_num' => [
                'required',
                'unique:users,identity_num,' . request()->user_id,
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'identity_photo' => [
                'array',
            ],
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
        ];
    }
}
