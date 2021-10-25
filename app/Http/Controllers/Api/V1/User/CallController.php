<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Student;
use App\Events\CallStudent;
use App\Traits\api_return;

class CallController extends Controller
{
    use api_return;

    public function call(){
        $student = Student::where('user_id',Auth::id())->first();

        $first = $student->user->name ?? '';
        $last = $student->user->last_name ?? '';

        $data = [
            'student_id' => $student->id,
            'school_id' => $student->school_id,
            'academic_level' => $student->academic_level,
            'class_number' => $student->class_number,
            'name' => $first . ' ' . $last,
        ];

        event(new CallStudent($data)); 

        return $this->returnSuccessMessage(__('Success Call'));
    }
}
