@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.school.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.schools.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.id') }}
                        </th>
                        <td>
                            {{ $school->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.city') }}
                        </th>
                        <td>
                            {{ $school->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.area') }}
                        </th>
                        <td>
                            {{ $school->area }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.sector') }}
                        </th>
                        <td>
                            {{ $school->sector }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.name') }}
                        </th>
                        <td>
                            {{ $school->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.classificaion') }}
                        </th>
                        <td>
                            {{ $school->classificaion }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.longitude') }}
                        </th>
                        <td>
                            {{ $school->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.latitude') }}
                        </th>
                        <td>
                            {{ $school->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.end_time') }}
                        </th>
                        <td>
                            {{ $school->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.school.fields.start_time') }}
                        </th>
                        <td>
                            {{ $school->start_time }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.schools.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#school_students" role="tab" data-toggle="tab">
                {{ trans('cruds.student.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="school_students">
            @includeIf('admin.schools.relationships.schoolStudents', ['students' => $school->schoolStudents])
        </div>
    </div>
</div>

@endsection