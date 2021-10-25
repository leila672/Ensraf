<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\UserAlert; 
use App\Models\Cader; 
use Validator;
use Auth;
use App\Http\Resources\V1\User\NotificationsResource;

class NotificationsApiController extends Controller
{
    use api_return;

    public function index(){
        $user = Auth::user();
        $alerts = $user->userUserAlerts()->paginate(10);
        $new = NotificationsResource::collection($alerts);
        return $this->returnPaginationData($new,$alerts,"success"); 
    } 
}
