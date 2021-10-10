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
            $table->editColumn('last_name', function ($row) {
                return $row->last_name ? $row->last_name : '';
            });
            $table->editColumn('number', function ($row) {
                return $row->number ? $row->number : '';
            });
            $table->addColumn('school_name', function ($row) {
                return $row->school ? $row->school->name : '';
            });

            $table->editColumn('academic_level', function ($row) {
                return $row->academic_level ? Student::ACADEMIC_LEVEL_SELECT[$row->academic_level] : '';
            });
            $table->editColumn('relative_relation', function ($row) {
                return $row->relative_relation ? Student::RELATIVE_RELATION_SELECT[$row->relative_relation] : '';
            });
            $table->editColumn('license_number', function ($row) {
                return $row->license_number ? $row->license_number : '';
            });
            $table->addColumn('user_email', function ($row) {
                return $row->user ? $row->user->email : '';
            });

            $table->editColumn('class_number', function ($row) {
                return $row->class_number ? Student::CLASS_NUMBER_SELECT[$row->class_number] : '';
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
        $student = Student::create($request->all());

        foreach ($request->input('identitty_photo', []) as $file) {
            $student->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('identitty_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $student->id]);
        }

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
        $student->update($request->all());

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
