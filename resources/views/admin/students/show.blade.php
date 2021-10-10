@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.student.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.students.index') }}">
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
                            {{ trans('cruds.student.fields.last_name') }}
                        </th>
                        <td>
                            {{ $student->last_name }}
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
                            {{ trans('cruds.student.fields.school') }}
                        </th>
                        <td>
                            {{ $student->school->name ?? '' }}
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
                            {{ trans('cruds.student.fields.relative_relation') }}
                        </th>
                        <td>
                            {{ App\Models\Student::RELATIVE_RELATION_SELECT[$student->relative_relation] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.company_name') }}
                        </th>
                        <td>
                            {{ $student->company_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.license_number') }}
                        </th>
                        <td>
                            {{ $student->license_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.user') }}
                        </th>
                        <td>
                            {{ $student->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.identity_num') }}
                        </th>
                        <td>
                            {{ $student->identity_num }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.student.fields.identitty_photo') }}
                        </th>
                        <td>
                            @foreach($student->identitty_photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
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
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.students.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection