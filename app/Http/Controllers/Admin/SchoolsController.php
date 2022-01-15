<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySchoolRequest;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\City;
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

        $schools = School::with(['user', 'city'])->get();

        return view('admin.schools.index', compact('schools'));
    }

    public function create()
    {
        abort_if(Gate::denies('school_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.schools.create', compact('cities', 'users'));
    }

    public function store(StoreSchoolRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone, 
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'identity_num' => $request->identity_num,
            'city_id' => $request->city_manager,
            'user_type' => 'school',
        ]);

        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        foreach ($request->input('identity_photo', []) as $file) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('identity_photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        $school = School::create([
            'area' => $request->area,
            'sector' => $request->sector,
            'name' => $request->name,
            'classificaion' => $request->classificaion,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'end_time' => $request->end_time,
            'start_time' => $request->start_time,
            'city_id' => $request->city_id,
            'user_id'=>$user->id, 
        ]);

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));
        return redirect()->route('admin.schools.index');
    }

    public function edit(School $school)
    {
        abort_if(Gate::denies('school_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $school->load('user', 'city');

        return view('admin.schools.edit', compact('cities', 'school', 'users'));
    }

    public function update(UpdateSchoolRequest $request, School $school)
    {
        
        $school->update([ 
            'area' => $request->area,
            'sector' => $request->sector,
            'name' => $request->name,
            'classificaion' => $request->classificaion,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'end_time' => $request->end_time,
            'start_time' => $request->start_time,
            'city_id' => $request->city_id,
        ]);

        $user = User::find($request->user_id);

        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone, 
            'email' => $request->email,
            'password' => $request->password == null ? $user->password : bcrypt($request->password), 
            'phone' => $request->phone,
            'city_id' => $request->city_manager,
            'identity_num' => $request->identity_num,
            'user_type' => 'school',
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

        Alert::success(trans('global.flash.success'), trans('global.flash.updated'));
        return redirect()->route('admin.schools.index');
    }

    public function show(School $school)
    {
        abort_if(Gate::denies('school_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $school->load('user', 'city', 'schoolStudents');

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
