<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMyParentRequest;
use App\Http\Requests\StoreMyParentRequest;
use App\Http\Requests\UpdateMyParentRequest;
use App\Models\MyParent;
use App\Models\City;
use App\Models\User;
use App\Models\Student;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Alert;
use Spatie\MediaLibrary\Models\Media;

class MyParentsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('my_parent_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myParents = MyParent::with(['user'])->get();

        return view('admin.myParents.index', compact('myParents'));
    }

    public function create()
    {
        abort_if(Gate::denies('my_parent_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.myParents.create', compact('users','cities'));
    }

    public function store(StoreMyParentRequest $request)
    { 
        $students = Student::where('parent_identity',$request->identity_num)->get();

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'city_id' => $request->city_id,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'identity_num' => $request->identity_num,
            'user_type' => 'parent', 
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
        
        $myParent = MyParent::create([
            'relative_relation'=>$request->relative_relation,
            'company_name'=>$request->company_name, 
            'license_number'=>$request->license_number, 
            'user_id'=>$user->id, 
        ]); 

        foreach($students as $student){
            $student->parent_id = $myParent->id;
            $student->save();
        }

        Alert::success(trans('global.flash.success'), trans('global.flash.created'));
        return redirect()->route('admin.my-parents.index');
    }

    public function edit(MyParent $myParent)
    {
        abort_if(Gate::denies('my_parent_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $myParent->load('user');

        return view('admin.myParents.edit', compact('myParent', 'users','cities'));
    }

    public function update(UpdateMyParentRequest $request, MyParent $myParent)
    {

        $myParent->update([
            'relative_relation'=>$request->relative_relation,
            'company_name'=>$request->company_name, 
            'license_number'=>$request->license_number, 
        ]);

        $user = User::find($request->user_id);

        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'city_id' => $request->city_id,
            'email' => $request->email,
            'password' => $request->password == null ? $user->password : bcrypt($request->password), 
            'phone' => $request->phone,
            'identity_num' => $request->identity_num, 
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

        return redirect()->route('admin.my-parents.index');
    }

    public function show(MyParent $myParent)
    {
        abort_if(Gate::denies('my_parent_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myParent->load('user', 'parentStudents');

        return view('admin.myParents.show', compact('myParent'));
    }

    public function destroy(MyParent $myParent)
    {
        abort_if(Gate::denies('my_parent_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myParent->delete();

        return back();
    }

    public function massDestroy(MassDestroyMyParentRequest $request)
    {
        MyParent::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
