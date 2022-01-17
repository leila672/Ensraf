@extends('layouts.schools')
@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.student.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('schools.students.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $student->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.number') }}
                                    </th>
                                    <td>
                                        {{ $student->number }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.academic_level') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Student::ACADEMIC_LEVEL_SELECT[$student->academic_level] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.class_number') }}
                                    </th>
                                    <td>
                                        {{ App\Models\Student::CLASS_NUMBER_SELECT[$student->class_number] ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.name') }}
                                    </th>
                                    <td>
                                        {{ $student->user->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.last_name') }}
                                    </th>
                                    <td>
                                        {{ $student->user->last_name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.email') }}
                                    </th>
                                    <td>
                                        {{ $student->user->email ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.phone') }}
                                    </th>
                                    <td>
                                        {{ $student->user->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.city') }}
                                    </th>
                                    <td>
                                        {{ $student->user->city->name_ar ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.identity_num') }}
                                    </th>
                                    <td>
                                        {{ $student->user->identity_num }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.parent_identity') }}
                                    </th>
                                    <td>
                                        {{ $student->parent_identity }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.photo') }}
                                    </th>
                                    <td>
                                        @if ($student->user && $student->user->photo)
                                            <a href="{{ $student->user->photo->getUrl() }}" target="_blank"
                                                style="display: inline-block">
                                                <img src="{{ $student->user->photo->getUrl('thumb') }}">
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.user.fields.identity_photo') }}
                                    </th>
                                    <td>
                                        @foreach ($student->user->identity_photo as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank"
                                                style="display: inline-block">
                                                <img src="{{ $media->getUrl('thumb') }}">
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.student.fields.voice') }}
                                    </th>
                                    <td>
                                        @if ($student->voice)
                                            <a href="{{ $student->voice->getUrl() }}" target="_blank">
                                                {{ trans('global.view_file') }}
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('schools.students.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    بيانات ولي الأمر
                </div>

                <div class="card-body">
                    <div class="form-group">
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
                                        @if ($myParent->user->photo)
                                            <a href="{{ $myParent->user->photo->getUrl() }}" target="_blank"
                                                style="display: inline-block">
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
                                        @foreach ($myParent->user->identity_photo as $key => $media)
                                            <a href="{{ $media->getUrl() }}" target="_blank"
                                                style="display: inline-block">
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
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
