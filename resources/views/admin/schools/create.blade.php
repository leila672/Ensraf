@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.school.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.schools.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.school.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', '') }}" required>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="area">{{ trans('cruds.school.fields.area') }}</label>
                <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="text" name="area" id="area" value="{{ old('area', '') }}" required>
                @if($errors->has('area'))
                    <div class="invalid-feedback">
                        {{ $errors->first('area') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.area_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sector">{{ trans('cruds.school.fields.sector') }}</label>
                <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text" name="sector" id="sector" value="{{ old('sector', '') }}" required>
                @if($errors->has('sector'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sector') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.sector_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.school.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="classificaion">{{ trans('cruds.school.fields.classificaion') }}</label>
                <input class="form-control {{ $errors->has('classificaion') ? 'is-invalid' : '' }}" type="text" name="classificaion" id="classificaion" value="{{ old('classificaion', '') }}" required>
                @if($errors->has('classificaion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('classificaion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.classificaion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.school.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="number" name="longitude" id="longitude" value="{{ old('longitude', '') }}" step="0.01">
                @if($errors->has('longitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('longitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.school.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="number" name="latitude" id="latitude" value="{{ old('latitude', '') }}" step="0.01">
                @if($errors->has('latitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('latitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.school.fields.end_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text" name="end_time" id="end_time" value="{{ old('end_time') }}" required>
                @if($errors->has('end_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.school.fields.start_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.school.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection