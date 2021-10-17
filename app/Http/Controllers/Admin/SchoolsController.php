<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySchoolRequest;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\School;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
Use Alert;

class SchoolsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('school_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schools = School::with(['user'])->get();

        return view('admin.schools.index', compact('schools'));
    }

    public function create()
    {
        abort_if(Gate::denies('school_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.schools.create', compact('users'));
    }

    public function store(StoreSchoolRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'city' => $request->city,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'user_type' => 'school',

        ]);
        $school = School::create([
            'city' => $request->city,
            'area' => $request->area,
            'sector' => $request->sector,
            'name' => $request->name,
            'classificaion' => $request->classificaion,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'end_time' => $request->end_time,
            'start_time' => $request->start_time,
            'user_id'=>$user->id,

        ]);

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));
        return redirect()->route('admin.schools.index');
    }

    public function edit(School $school)
    {
        abort_if(Gate::denies('school_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $school->load('user');

        return view('admin.schools.edit', compact('users', 'school'));
    }

    public function update(UpdateSchoolRequest $request, School $school)
    {
        $school->update([
            'city' => $request->city,
            'area' => $request->area,
            'sector' => $request->sector,
            'name' => $request->name,
            'classificaion' => $request->classificaion,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'end_time' => $request->end_time,
            'start_time' => $request->start_time,

        ]);

        $user = User::find($school->user_id);

        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'city' => $request->city,
            'email' => $request->email,
            'password' => $request->password == null ? $user->password : bcrypt($request->password), 
            'phone' => $request->phone,
            'user_type' => 'school',
        ]);

        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));
        return redirect()->route('admin.schools.index');
    }

    public function show(School $school)
    {
        abort_if(Gate::denies('school_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school->load('user', 'schoolStudents');

        return view('admin.schools.show', compact('school'));
    }

    public function destroy(School $school)
    {
        abort_if(Gate::denies('school_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school->delete();

        Alert::success(trans('global.flash.success'), trans('global.flash.deleted'));
        return back();
    }

    public function massDestroy(MassDestroySchoolRequest $request)
    {
        School::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
