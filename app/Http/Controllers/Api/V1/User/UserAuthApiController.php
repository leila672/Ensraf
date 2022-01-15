<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\User;
use App\Models\Student;
use App\Models\MyParent;
use Validator;
use Auth;  
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Traits\MediaUploadingTrait; 


class UserAuthApiController extends Controller
{ 
    use api_return;  
    use MediaUploadingTrait;

    public function register(Request $request){

        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required', 
            'phone' => 'required|string',
            'identity_num' => 'required|integer|unique:users',
            'city_id' => 'required|integer',
            'relative_relation' => 'required|in:father,brother,driver', 
        ];   
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }  

        $user = User::create([
            'name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'city_id' => $request->city_id,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'identity_num' => $request->identity_num,
            'user_type' => 'parent', 
        ]);

        if (request()->hasFile('photo') && request('photo') != ''){
            $validator = Validator::make($request->all(), [
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            } 

            $user->addMedia(request('photo'))->toMediaCollection('photo'); 
        }
        
        if (request()->hasFile('identity_photo') && request('identity_photo') != ''){
            $validator = Validator::make($request->all(), [
                'identity_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            } 

            $user->addMedia(request('identity_photo'))->toMediaCollection('identity_photo'); 
        }

        $myParent = MyParent::create([
            'relative_relation'=>$request->relative_relation,
            'company_name'=>$request->company_name, 
            'license_number'=>$request->license_number, 
            'user_id'=>$user->id, 
        ]);
        

        $students = Student::where('parent_identity',$request->identity_num)->get();

        foreach($students as $student){
            $student->parent_id = $myParent->id;
            $student->save();
        }

        $token = $user->createToken('user_token')->plainTextToken;

        return $this->returnData(
            [
                'user_token' => $token,
                'user_id '=> $user->id
            ]
        );

    } 

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
            if(Auth::user()->user_type == 'parent'){
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
