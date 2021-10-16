@extends('layouts.Schools')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.student.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("schools.students.update", [$student->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="name" id="name" value="{{ old('name', $student->user->name) }}" required>
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required"
                            for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text"
                            name="last_name" id="last_name" value="{{ old('last_name', $student->user->last_name) }}" required>
                        @if ($errors->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
                    </div>
                </div>
            </div>
            <input type="hidden" name="user_id" value="{{$student->user_id}}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $student->user->email) }}" required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required"
                            for="password">{{ trans('cruds.user.fields.password') }}</label>
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            type="password" name="password" id="password" required>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                    </div>
                </div>
            </div>
<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text"
                            name="phone" id="phone" value="{{ old('phone', $student->user->phone) }}" required>
                        @if ($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="city">{{ trans('cruds.user.fields.city') }}</label>
                        <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text"
                            name="city" id="city" value="{{ old('city', $student->user->city) }}" required>
                        @if ($errors->has('city'))
                            <div class="invalid-feedback">
                                {{ $errors->first('city') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.city_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="number">{{ trans('cruds.student.fields.number') }}</label>
                <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="number"
                 name="number" id="number" value="{{ old('number', $student->number) }}" step="1" required>
                @if($errors->has('number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="school_id">{{ trans('cruds.student.fields.school') }}</label>
                <select class="form-control select2 {{ $errors->has('school') ? 'is-invalid' : '' }}" name="school_id" id="school_id" required>
                    @foreach($schools as $id => $entry)
                        <option value="{{ $id }}" {{ (old('school_id') ? old('school_id') : $student->school->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('school'))
                    <div class="invalid-feedback">
                        {{ $errors->first('school') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.school_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.student.fields.academic_level') }}</label>
                <select class="form-control {{ $errors->has('academic_level') ? 'is-invalid' : '' }}" name="academic_level" id="academic_level" required>
                    <option value disabled {{ old('academic_level', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Student::ACADEMIC_LEVEL_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('academic_level', $student->academic_level) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('academic_level'))
                    <div class="invalid-feedback">
                        {{ $errors->first('academic_level') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.academic_level_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.student.fields.relative_relation') }}</label>
                <select class="form-control {{ $errors->has('relative_relation') ? 'is-invalid' : '' }}" name="relative_relation" id="relative_relation" required>
                    <option value disabled {{ old('relative_relation', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Student::RELATIVE_RELATION_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('relative_relation', $student->relative_relation) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('relative_relation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('relative_relation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.relative_relation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_name">{{ trans('cruds.student.fields.company_name') }}</label>
                <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', $student->company_name) }}">
                @if($errors->has('company_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('company_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.company_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="license_number">{{ trans('cruds.student.fields.license_number') }}</label>
                <input class="form-control {{ $errors->has('license_number') ? 'is-invalid' : '' }}" type="number" name="license_number" id="license_number" value="{{ old('license_number', $student->license_number) }}" step="1">
                @if($errors->has('license_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('license_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.license_number_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="identity_num">{{ trans('cruds.student.fields.identity_num') }}</label>
                <input class="form-control {{ $errors->has('identity_num') ? 'is-invalid' : '' }}" type="text" name="identity_num" id="identity_num" value="{{ old('identity_num', $student->identity_num) }}" required>
                @if($errors->has('identity_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('identity_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.identity_num_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="identitty_photo">{{ trans('cruds.student.fields.identitty_photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('identitty_photo') ? 'is-invalid' : '' }}" id="identitty_photo-dropzone">
                </div>
                @if($errors->has('identitty_photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('identitty_photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.identitty_photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.student.fields.class_number') }}</label>
                <select class="form-control {{ $errors->has('class_number') ? 'is-invalid' : '' }}" name="class_number" id="class_number">
                    <option value disabled {{ old('class_number', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Student::CLASS_NUMBER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('class_number', $student->class_number) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('class_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('class_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.student.fields.class_number_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedIdentittyPhotoMap = {}
Dropzone.options.identittyPhotoDropzone = {
    url: '{{ route('schools.students.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="identitty_photo[]" value="' + response.name + '">')
      uploadedIdentittyPhotoMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedIdentittyPhotoMap[file.name]
      }
      $('form').find('input[name="identitty_photo[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($student) && $student->identitty_photo)
      var files = {!! json_encode($student->identitty_photo) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="identitty_photo[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection