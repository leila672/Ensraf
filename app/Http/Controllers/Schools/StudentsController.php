<?php

namespace App\Http\Controllers\Schools;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStudentRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use App\Models\City;
use App\Models\MyParent;
use Gate;
use Auth;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Alert ;

class StudentsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {

        $school = School::where('user_id',Auth::id())->first();

        if ($request->ajax()) {
            $query = Student::with(['school', 'user'])->where('school_id',$school->id)->select(sprintf('%s.*', (new Student())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'student_show';
                $editGate = 'student_edit';
                $deleteGate = 'student_delete';
                $crudRoutePart = 'students';

                return view('partials.datatablesActionsSchools', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('number', function ($row) {
                return $row->number ? $row->number : '';
            }); 

            $table->editColumn('academic_level', function ($row) {
                return $row->academic_level ? trans('global.academic_level.'.$row->academic_level ?? '' ): '';
            }); 
            $table->addColumn('user_email', function ($row) {
                return $row->user ? $row->user->email : '';
            });

            $table->editColumn('class_number', function ($row) {
                return $row->class_number ? trans('global.class_number.'.$row->class_number ?? '' ): '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('schools.students.index');
    }

    public function create()
    { 
        $school = School::where('user_id',Auth::id())->first(); 

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('schools.students.create', compact( 'users','school','cities'));
    }

    public function store(StoreStudentRequest $request)
    { 
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'city_id' => $request->city_id,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'identity_num' => $request->identity_num,
            'user_type' => 'student', 
        ]);

        $student = Student::create ([
            'number'=>$request->number,
            'academic_level'=>$request->academic_level, 
            'class_number'=>$request->class_number,
            'parent_identity'=>$request->parent_identity, 
            'school_id'=>$request->school_id,
            'user_id'=>$user->id, 
        ]);

        $user = User::where('identity_num',$request->parent_identity)->first();

        if($user){ 
            $myParent = MyParent::where('user_id',$user->id)->first();
            if($myParent){
                $student->parent_id = $myParent->id;
                $student->save();
            }
        }

        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        foreach ($request->input('identity_photo', []) as $file) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('identity_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        if ($request->input('voice', false)) {
            $student->addMedia(storage_path('tmp/uploads/' . basename($request->input('voice'))))->toMediaCollection('voice');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $student->id]);
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));
        return redirect()->route('schools.students.index');
    }

    public function edit(Student $student)
    {


        $school = School::where('user_id',Auth::id())->first();

        $schools = School::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $student->load('school', 'user');

        return view('schools.students.edit', compact('schools', 'users','cities', 'student','school'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {

        $student->update([
            'number'=>$request->number, 
            'academic_level'=>$request->academic_level,
            'class_number'=>$request->class_number,
            'parent_identity'=>$request->parent_identity, 
            'school_id'=>$request->school_id,
        ]);

        $user = User::find($student->user_id);

        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'city_id' => $request->city_id,
            'email' => $request->email,
            'password' => $request->password == null ? $user->password : bcrypt($request->password), 
            'phone' => $request->phone,
            'identity_num' => $request->identity_num,
            'user_type' => 'student',
        ]);



        if ($request->input('photo', false)) {
            if (!$user->photo || $request->input('photo') !== $user->photo->file_name) {
                if ($user->photo) {
                    $user->photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($user->photo) {
            $user->photo->delete();
        }

        if (count($user->identity_photo) > 0) {
            foreach ($user->identity_photo as $media) {
                if (!in_array($media->file_name, $request->input('identity_photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $user->identity_photo->pluck('file_name')->toArray();
        foreach ($request->input('identity_photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('identity_photo');
            }
        }

        if ($request->input('voice', false)) {
            if (!$student->voice || $request->input('voice') !== $student->voice->file_name) {
                if ($student->voice) {
                    $student->voice->delete();
                }
                $student->addMedia(storage_path('tmp/uploads/' . basename($request->input('voice'))))->toMediaCollection('voice');
            }
        } elseif ($student->voice) {
            $student->voice->delete();
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));
        return redirect()->route('schools.students.index');
    }

    public function show(Student $student)
    {


        $student->load('school', 'user');

        return view('schools.students.show', compact('student'));
    }

    public function destroy(Student $student)
    {


        $student->delete();

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));
        return back();
    }

    public function massDestroy(MassDestroyStudentRequest $request)
    {
        Student::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {

        $model         = new Student();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
