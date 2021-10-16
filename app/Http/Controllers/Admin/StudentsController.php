<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyStudentRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
Use Alert;


class StudentsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('student_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Student::with(['school', 'user'])->select(sprintf('%s.*', (new Student())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'student_show';
                $editGate = 'student_edit';
                $deleteGate = 'student_delete';
                $crudRoutePart = 'students';

                return view('partials.datatablesActions', compact(
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
            $table->addColumn('school_name', function ($row) {
                return $row->school ? $row->school->name : '';
            });


            $table->editColumn('academic_level', function ($row) {
                return $row->academic_level ? trans('global.academic_level.'.$row->academic_level ?? '' ): '';
            });
            $table->editColumn('relative_relation', function ($row) {
                return $row->relative_relation ? trans('global.relative_relation.'.$row->relative_relation ?? '' ): '';
            });
            $table->editColumn('license_number', function ($row) {
                return $row->license_number ? $row->license_number : '';
            });
            $table->addColumn('user_email', function ($row) {
                return $row->user ? $row->user->email : '';
            });

            $table->editColumn('class_number', function ($row) {
                return $row->class_number ? trans('global.class_number.'.$row->class_number ?? '' ): '';
            });

            $table->rawColumns(['actions', 'placeholder', 'school', 'user']);

            return $table->make(true);
        }

        return view('admin.students.index');
    }

    public function create()
    {
        abort_if(Gate::denies('student_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schools = School::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.students.create', compact('schools', 'users'));
    }

    public function store(StoreStudentRequest $request)
    {


        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'city' => $request->city,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'user_type' => 'student',
            'role'
        ]);

        $student = Student::create ([
            'number'=>$request->number,
            'school_id'=>$request->school_id,
            'academic_level'=>$request->academic_level,
            'relative_relation'=>$request->relative_relation,
            'company_name'=>$request->company_name,
            'license_number'=>$request->license_number,
            'user_id'=>$user->id,
            'identity_num'=>$request->identity_num,
            'class_number'=>$request->class_number,
        ]);

        foreach ($request->input('identitty_photo', []) as $file) {
            $student->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('identitty_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $student->id]);
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));
        return redirect()->route('admin.students.index');
    }

    public function edit(Student $student)
    {
        abort_if(Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schools = School::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $student->load('school', 'user');

        return view('admin.students.edit', compact('schools', 'users', 'student'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {

        $student->update([
            'number'=>$request->number,
            'school_id'=>$request->school_id,
            'academic_level'=>$request->academic_level,
            'relative_relation'=>$request->relative_relation,
            'company_name'=>$request->company_name,
            'license_number'=>$request->license_number,
            'identity_num'=>$request->identity_num,
            'class_number'=>$request->class_number,
        ]);

        $user = User::find($student->user_id);

        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'city' => $request->city,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'user_type' => 'student',
        ]);



        if (count($student->identitty_photo) > 0) {
            foreach ($student->identitty_photo as $media) {
                if (!in_array($media->file_name, $request->input('identitty_photo', []))) {
                    $media->delete();
                }
            }
        }
        $media = $student->identitty_photo->pluck('file_name')->toArray();
        foreach ($request->input('identitty_photo', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $student->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('identitty_photo');
            }
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));
        return redirect()->route('admin.students.index');
    }

    public function show(Student $student)
    {
        abort_if(Gate::denies('student_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $student->load('school', 'user');

        return view('admin.students.show', compact('student'));
    }

    public function destroy(Student $student)
    {
        abort_if(Gate::denies('student_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
        abort_if(Gate::denies('student_create') && Gate::denies('student_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Student();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
