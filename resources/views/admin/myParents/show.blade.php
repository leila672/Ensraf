@extends('layouts.admin')
@section('content')
<div class="row">

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.myParent.title') }}
            </div>

            <div class="card-body">
                <div class="form-group">
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('admin.my-parents.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.myParent.fields.id') }}
                                </th>
                                <td>
                                    {{ $myParent->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.name') }}
                                </th>
                                <td>
                                    {{ $myParent->user->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.last_name') }}
                                </th>
                                <td>
                                    {{ $myParent->user->last_name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                                <td>
                                    {{ $myParent->user->email }}
                                </td>
                            </tr>  
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.phone') }}
                                </th>
                                <td>
                                    {{ $myParent->user->phone }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.photo') }}
                                </th>
                                <td>
                                    @if($myParent->user->photo)
                                        <a href="{{ $myParent->user->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $myParent->user->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.identity_photo') }}
                                </th>
                                <td>
                                    @foreach($myParent->user->identity_photo as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $media->getUrl('thumb') }}">
                                        </a>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.identity_num') }}
                                </th>
                                <td>
                                    {{ $myParent->user->identity_num }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.city') }}
                                </th>
                                <td>
                                    {{ $myParent->user->city->name_ar ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.myParent.fields.relative_relation') }}
                                </th>
                                <td>
                                    {{ App\Models\MyParent::RELATIVE_RELATION_SELECT[$myParent->relative_relation] ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.myParent.fields.company_name') }}
                                </th>
                                <td>
                                    {{ $myParent->company_name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.myParent.fields.license_number') }}
                                </th>
                                <td>
                                    {{ $myParent->license_number }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('admin.my-parents.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                {{ trans('global.relatedData') }}
            </div>
            <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#parent_students" role="tab" data-toggle="tab">
                        {{ trans('cruds.student.title') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="parent_students">
                    @includeIf('admin.myParents.relationships.parentStudents', ['students' => $myParent->parentStudents])
                </div>
            </div>
        </div>
    </div>

</div>

@endsection