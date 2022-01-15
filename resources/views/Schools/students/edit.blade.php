@extends('layouts.schools')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.student.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('schools.students.update', [$student->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <input type="hidden" name="school_id" value="{{ $school->id }}">
                <input type="hidden" name="user_id" value="{{ $student->user_id }}">

                <div class="row">
                    
                    <div class="form-group col-md-4">
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
                    
                    <div class="form-group col-md-4">
                        <label class="required"
                            for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text"
                            name="last_name" id="last_name" value="{{ old('last_name', $student->user->last_name) }}"
                            required>
                        @if ($errors->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
                    </div>
                    
                    
                    <div class="form-group col-md-4">
                        <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                            name="email" id="email" value="{{ old('email', $student->user->email) }}" required>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label class="required"
                            for="password">{{ trans('cruds.user.fields.password') }}</label>
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            type="password" name="password" id="password">
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                    </div>
                    
                    
                    <div class="form-group col-md-4">
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
                    
                    <div class="form-group col-md-4">
                        <label class="required" for="city_id">{{ trans('cruds.user.fields.city') }}</label>
                        <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                            @foreach($cities as $id => $entry)
                                <option value="{{ $id }}" {{ old('city_id',$student->user->city_id) == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('city'))
                            <div class="invalid-feedback">
                                {{ $errors->first('city') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.city_helper') }}</span>
                    </div> 
                    
                    <div class="form-group col-md-4">
                        <label class="required">{{ trans('cruds.student.fields.academic_level') }}</label>
                        <select class="form-control {{ $errors->has('academic_level') ? 'is-invalid' : '' }}"
                            name="academic_level" id="academic_level" required>
                            <option value disabled {{ old('academic_level', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Student::ACADEMIC_LEVEL_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('academic_level', $student->academic_level) === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('academic_level'))
                            <div class="invalid-feedback">
                                {{ $errors->first('academic_level') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.student.fields.academic_level_helper') }}</span>
                    </div> 
                    
                    <div class="form-group col-md-4">
                        <label>{{ trans('cruds.student.fields.class_number') }}</label>
                        <select class="form-control {{ $errors->has('class_number') ? 'is-invalid' : '' }}"
                            name="class_number" id="class_number">
                            <option value disabled {{ old('class_number', null) === null ? 'selected' : '' }}>
                                {{ trans('global.pleaseSelect') }}</option>
                            @foreach (App\Models\Student::CLASS_NUMBER_SELECT as $key => $label)
                                <option value="{{ $key }}"
                                    {{ old('class_number', $student->class_number) === (string) $key ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('class_number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('class_number') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.student.fields.class_number_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required" for="number">{{ trans('cruds.student.fields.number') }}</label>
                        <input class="form-control {{ $errors->has('number') ? 'is-invalid' : '' }}" type="number"
                            name="number" id="number" value="{{ old('number', $student->number) }}" step="1" required>
                        @if ($errors->has('number'))
                            <div class="invalid-feedback">
                                {{ $errors->first('number') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.student.fields.number_helper') }}</span>
                    </div>
                    <div class="form-group col-md-5">
                        <label class="required"
                            for="parent_identity">{{ trans('cruds.student.fields.parent_identity') }}</label>
                        <input class="form-control {{ $errors->has('parent_identity') ? 'is-invalid' : '' }}" type="number"
                            name="parent_identity" id="parent_identity" value="{{ old('parent_identity', $student->parent_identity) }}" required>
                        @if ($errors->has('parent_identity'))
                            <div class="invalid-feedback">
                                {{ $errors->first('parent_identity') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.student.fields.parent_identity_helper') }}</span>
                    </div>
                    <div class="form-group col-md-5">
                        <label class="required"
                            for="identity_num">{{ trans('cruds.user.fields.identity_num') }}</label>
                        <input class="form-control {{ $errors->has('identity_num') ? 'is-invalid' : '' }}" type="number"
                            name="identity_num" id="identity_num" value="{{ old('identity_num', $student->user->identity_num) }}"
                            required>
                        @if ($errors->has('identity_num'))
                            <div class="invalid-feedback">
                                {{ $errors->first('identity_num') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.identity_num_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="photo">{{ trans('cruds.user.fields.photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                            id="photo-dropzone">
                        </div>
                        @if ($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.photo_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required"
                            for="identity_photo">{{ trans('cruds.user.fields.identity_photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('identity_photo') ? 'is-invalid' : '' }}"
                            id="identity_photo-dropzone">
                        </div>
                        @if ($errors->has('identity_photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('identity_photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.identity_photo_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="voice">{{ trans('cruds.student.fields.voice') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('voice') ? 'is-invalid' : '' }}"
                            id="voice-dropzone">
                        </div>
                        @if ($errors->has('voice'))
                            <div class="invalid-feedback">
                                {{ $errors->first('voice') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.student.fields.voice_helper') }}</span>
                    </div>
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
        Dropzone.options.photoDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($student->user) && $student->user->photo)
                    var file = {!! json_encode($student->user->photo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
    <script>
        var uploadedIdentityPhotoMap = {}
        Dropzone.options.identityPhotoDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
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
            success: function(file, response) {
                $('form').append('<input type="hidden" name="identity_photo[]" value="' + response.name + '">')
                uploadedIdentityPhotoMap[file.name] = response.name
            },
            removedfile: function(file) {
                console.log(file)
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedIdentityPhotoMap[file.name]
                }
                $('form').find('input[name="identity_photo[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($student->user) && $student->user->identity_photo)
                    var files = {!! json_encode($student->user->identity_photo) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="identity_photo[]" value="' + file.file_name + '">')
                    }
                @endif
            },
            error: function(file, response) {
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
    <script>
        Dropzone.options.voiceDropzone = {
            url: '{{ route('schools.students.storeMedia') }}',
            maxFilesize: 10, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10
            },
            success: function(file, response) {
                $('form').find('input[name="voice"]').remove()
                $('form').append('<input type="hidden" name="voice" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="voice"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($student) && $student->voice)
                    var file = {!! json_encode($student->voice) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="voice" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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