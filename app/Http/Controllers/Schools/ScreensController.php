<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use Auth;

class ScreensController extends Controller
{
    public function index(){
        $school = School::where('user_id',Auth::id())->first();

        return view('schools.screens.screen',compact('school'));
    }
}
