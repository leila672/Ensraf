<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Emergency;
use App\Models\User;
use App\Models\City;
use App\Models\Cader;
use Illuminate\Http\Request;
use Auth;
use App\Http\Resources\V1\User\UserResource;
use App\Traits\api_return;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Traits\MediaUploadingTrait; 

class UsersApiController extends Controller
{
    use api_return;  
    use MediaUploadingTrait;

    public function profile()
    {  
        return $this->returnData(new UserResource(Auth::user()), "success"); 
    }

    public function update(Request $request){

        $rules = [
            'email' => 'required|unique:users,email,'.Auth::id(),
            'date_of_birth' =>'date_format:' . config('panel.date_format'),
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();

        if (request()->hasFile('photo') && request('photo') != '' && request('photo') != $user->photo){
            $validator = Validator::make($request->all(), [
                'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            }
            $user->addMedia(request('photo'))->toMediaCollection('photo'); 
        }

        if(!$user)
            return $this->returnError('404',('Not Found !!!'));

        $user->update($request->all());
        
        $cader = Cader::where('user_id',$user->id)->first();
        $cader->description = $request->description;
        $cader->save();

        return $this->returnData(new UserResource($user),__('Profile Updated Successfully'));
    } 

    public function update_password(Request $request){
        $rules = [
            'old_password' => 'required|min:6|max:20',
            'password' => 'required|min:6|max:20|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();
        $hashedPassword = $user->password;
        if(!\Hash::check($request->old_password, $hashedPassword)){
            return $this->returnError('401', 'Old Password Not Correct');
        }else{
            $user->password = bcrypt($request->password);
            $user->save();
            return $this->returnSuccessMessage(__('Changed Successfully'));
        } 
    }

    public function update_fcm_token(Request $request){

        $rules = [
            'fcm_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();

        if(!$user)
            return $this->returnError('404',('Not Found !!!'));

        $user->update($request->all());


        return $this->returnSuccessMessage(__('Token Updated Successfully'));
    } 
}
