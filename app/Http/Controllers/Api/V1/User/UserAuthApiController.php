<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\User;
use App\Models\Student;
use Validator;
use Auth; 


class UserAuthApiController extends Controller
{ 
    use api_return; 

    public function register(Request $request){

        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:20',
            'city_id' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'nationality_id' => 'required',
            'identity_num' => 'required',
            'description' => 'required',
            'specializations' => 'required|array',
            'specializations.*' => 'integer',
            'date_of_birth' =>
                'required|date_format:' . config('panel.date_format'),
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }  

        $validated_requests = $request->all();
        $validated_requests['password'] = bcrypt($request->password);
        $validated_requests['user_type'] = 'cader';
        $validated_requests['approved'] = 0;
        $user = User::create($validated_requests);
        if (request()->hasFile('photo') && request('photo') != ''){
            $validator = Validator::make($request->all(), [
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            } 

            $user->addMedia(request('photo'))->toMediaCollection('photo'); 
        }
        $cader = Cader::create([
            'user_id' => $user->id,
            'description' => $validated_requests['description'],
        ]);

        $cader->specializations()->sync($request->input('specializations', [])); 

        $token = $user->createToken('user_token')->plainTextToken;

        return $this->returnData(
            [
                'user_token' => $token,
                'user_id '=> $user->id
            ]
        );

    }

    // -----------------------------------------------------------------------------------
    // -----------------------------------------------------------------------------------

    public function login(Request $request){

        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if(Auth::user()->user_type == 'student'){
                $token = Auth::user()->createToken('user_token')->plainTextToken; 
                return $this->returnData(
                    [
                        'user_token' => $token,
                        'user_id '=> Auth::id()
                    ]
                );
            }else{
                return $this->returnError('500',__('Not Authenticated to use this app'));
            }
        } else {
            return $this->returnError('500',__('invalid username or password'));
        }
    }
}
