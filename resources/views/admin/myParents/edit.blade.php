@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.myParent.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.my-parents.update", [$myParent->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="user_id" value="{{ $myParent->user_id }}">
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', $myParent->user->name) }}" required>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                    <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text"
                        name="last_name" id="last_name" value="{{ old('last_name', $myParent->user->last_name) }}" required>
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
                        name="email" id="email" value="{{ old('email',$myParent->user->email) }}" required>
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                        name="password" id="password">
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
                        name="phone" id="phone" value="{{ old('phone', $myParent->user->phone) }}" required>
                    @if ($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required"
                        for="identity_num">{{ trans('cruds.user.fields.identity_num') }}</label>
                    <input class="form-control {{ $errors->has('identity_num') ? 'is-invalid' : '' }}" type="number"
                        name="identity_num" id="identity_num" value="{{ old('identity_num', $myParent->user->identity_num) }}" step="1"
                        required>
                    @if ($errors->has('identity_num'))
                        <div class="invalid-feedback">
                            {{ $errors->first('identity_num') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.identity_num_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="city_id">{{ trans('cruds.user.fields.city') }}</label>
                    <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}"
                        name="city_id" id="city_id" required>
                        @foreach ($cities as $id => $entry)
                            <option value="{{ $id }}" {{ old('city_id',$myParent->user->city_id) == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('city'))
                        <div class="invalid-feedback">
                            {{ $errors->first('city') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.city_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required">{{ trans('cruds.myParent.fields.relative_relation') }}</label>
                    <select class="form-control {{ $errors->has('relative_relation') ? 'is-invalid' : '' }}" name="relative_relation" id="relative_relation" required>
                        <option value disabled {{ old('relative_relation', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\MyParent::RELATIVE_RELATION_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('relative_relation', $myParent->relative_relation) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('relative_relation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('relative_relation') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.myParent.fields.relative_relation_helper') }}</span>
                </div>
                <div class="col-md-12" id="driver-relation" @if($myParent->relative_relation != 'driver') style="display:none" @endif>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="company_name">{{ trans('cruds.myParent.fields.company_name') }}</label>
                            <input class="form-control {{ $errors->has('company_name') ? 'is-invalid' : '' }}" type="text" name="company_name" id="company_name" value="{{ old('company_name', $myParent->company_name) }}">
                            @if($errors->has('company_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('company_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myParent.fields.company_name_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="license_number">{{ trans('cruds.myParent.fields.license_number') }}</label>
                            <input class="form-control {{ $errors->has('license_number') ? 'is-invalid' : '' }}" type="text" name="license_number" id="license_number" value="{{ old('license_number', $myParent->license_number) }}">
                            @if($errors->has('license_number'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('license_number') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.myParent.fields.license_number_helper') }}</span>
                        </div>
                            
                    </div>
                </div>
                <div class="form-group col-md-6">
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
                <div class="form-group col-md-6">
                    <label for="identity_photo">{{ trans('cruds.user.fields.identity_photo') }}</label>
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
        $('#relative_relation').on('change',function(){
            if($('#relative_relation').val() == 'driver'){
                $('#driver-relation').css('display','block');
            }else{
                $('#driver-relation').css('display','none');
            }
            
        });
    </script>
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
                @if (isset($myParent->user) && $myParent->user->photo)
                    var file = {!! json_encode($myParent->user->photo) !!}
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
                @if (isset($myParent->user) && $myParent->user->identity_photo)
                    var files = {!! json_encode($myParent->user->identity_photo) !!}
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
@endsection