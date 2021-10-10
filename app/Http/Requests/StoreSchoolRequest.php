<?php

namespace App\Http\Requests;

use App\Models\School;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSchoolRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('school_create');
    }

    public function rules()
    {
        return [
            'city' => [
                'string',
                'required',
            ],
            'area' => [
                'string',
                'required',
            ],
            'sector' => [
                'string',
                'required',
            ],
            'name' => [
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
        ];
    }
}
