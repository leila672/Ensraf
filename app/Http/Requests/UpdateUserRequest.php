<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
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
                'unique:users,email,' . request()->route('user')->id,
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'required',
                'array',
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
        ];
    }
}