<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller; 
use App\Models\User;
use App\Models\City;
use App\Models\Student;
use App\Models\MyParent;
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
        $myParent = MyParent::where('user_id',Auth::id())->first();
        return $this->returnData(new UserResource($myParent), "success"); 
    }

    public function update(Request $request){

        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|unique:users,email,'.Auth::id(),
            'password' => 'required', 
            'phone' => 'required|string',
            'identity_num' => 'required|integer|unique:users,identity_num,'.Auth::id(),
            'city_id' => 'required|integer',
            'relative_relation' => 'required|in:father,brother,driver', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();

        $myParent = MyParent::where('user_id',Auth::id())->first();

        if(!$user)
            return $this->returnError('404',('Not Found !!!')); 

        if(!$myParent)
            return $this->returnError('404',('Not Found !!!')); 

        $user->update([ 
            'name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'city_id' => $request->city_id,
            'email' => $request->email, 
            'phone' => $request->phone,
            'identity_num' => $request->identity_num, 
        ]);

        if (request()->hasFile('photo') && request('photo') != '' && request('photo') != $user->photo){
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

        $myParent->update([ 
            'relative_relation'=>$request->relative_relation,
            'company_name'=>$request->company_name, 
            'license_number'=>$request->license_number, 
        ]);

        return $this->returnData(new UserResource($myParent),__('Profile Updated Successfully'));
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

    public function update_voice(Request $request){ 

        $rules = [
            'student_id' => 'required|integer', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $student = Student::findOrFail($request->student_id); 
        
        if (request()->hasFile('voice') && request('voice') != ''){
            $validator = Validator::make($request->all(), [
                'voice' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->returnError('401', $validator->errors());
            } 

            $student->addMedia(request('voice'))->toMediaCollection('voice'); 
        }

        return $this->returnSuccessMessage(__('Voice Updated Successfully'));
    } 
}
