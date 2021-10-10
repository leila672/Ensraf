<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySchoolRequest;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\School;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SchoolsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('school_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schools = School::all();

        return view('admin.schools.index', compact('schools'));
    }

    public function create()
    {
        abort_if(Gate::denies('school_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.schools.create');
    }

    public function store(StoreSchoolRequest $request)
    {
        $school = School::create($request->all());

        return redirect()->route('admin.schools.index');
    }

    public function edit(School $school)
    {
        abort_if(Gate::denies('school_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.schools.edit', compact('school'));
    }

    public function update(UpdateSchoolRequest $request, School $school)
    {
        $school->update($request->all());

        return redirect()->route('admin.schools.index');
    }

    public function show(School $school)
    {
        abort_if(Gate::denies('school_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school->load('schoolStudents');

        return view('admin.schools.show', compact('school'));
    }

    public function destroy(School $school)
    {
        abort_if(Gate::denies('school_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school->delete();

        return back();
    }

    public function massDestroy(MassDestroySchoolRequest $request)
    {
        School::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
