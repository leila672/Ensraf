@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.school.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.schools.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
                <p style="text-align: center ; color: rgb(187, 42, 42) ; font-size: 25px">
                    {{ trans('cruds.user.manager_info') }} </p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                name="name" id="name" value="{{ old('name', '') }}" required>
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
                                name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                            @if ($errors->has('last_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('last_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                name="email" id="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text"
                                name="phone" id="phone" value="{{ old('phone', '') }}" required>
                            @if ($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="required"
                                for="city_manager">{{ trans('cruds.school.fields.city_manager') }}</label>
                            <select class="form-control select2 {{ $errors->has('city_manager') ? 'is-invalid' : '' }}"
                                name="city_manager" id="city_manager" required>
                                @foreach ($cities as $id => $entry)
                                    <option value="{{ $id }}"
                                        {{ old('city_manager') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('city_manager'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city_manager') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.school.fields.city_manager_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required"
                            for="identity_num">{{ trans('cruds.user.fields.identity_num') }}</label>
                        <input class="form-control {{ $errors->has('identity_num') ? 'is-invalid' : '' }}" type="number"
                            name="identity_num" id="identity_num" value="{{ old('identity_num', '') }}" step="1"
                            required>
                        @if ($errors->has('identity_num'))
                            <div class="invalid-feedback">
                                {{ $errors->first('identity_num') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.identity_num_helper') }}</span>
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

                <p style="text-align: center ; color: rgb(187, 42, 42) ; font-size: 25px">
                    {{ trans('cruds.user.school_info') }}</p>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="required" for="city_id">{{ trans('cruds.school.fields.city') }}</label>
                        <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}"
                            name="city_id" id="city_id" required>
                            @foreach ($cities as $id => $entry)
                                <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('city'))
                            <div class="invalid-feedback">
                                {{ $errors->first('city') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.school.fields.city_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required" for="area">{{ trans('cruds.school.fields.area') }}</label>
                        <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="text"
                            name="area" id="area" value="{{ old('area', '') }}" required>
                        @if ($errors->has('area'))
                            <div class="invalid-feedback">
                                {{ $errors->first('area') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.school.fields.area_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required" for="sector">{{ trans('cruds.school.fields.sector') }}</label>
                        <input class="form-control {{ $errors->has('sector') ? 'is-invalid' : '' }}" type="text"
                            name="sector" id="sector" value="{{ old('sector', '') }}" required>
                        @if ($errors->has('sector'))
                            <div class="invalid-feedback">
                                {{ $errors->first('sector') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.school.fields.sector_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required" for="name">{{ trans('cruds.school.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="name" id="name" value="{{ old('name', '') }}" required>
                        @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.school.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required"
                            for="classificaion">{{ trans('cruds.school.fields.classificaion') }}</label>
                        <input class="form-control {{ $errors->has('classificaion') ? 'is-invalid' : '' }}" type="text"
                            name="classificaion" id="classificaion" value="{{ old('classificaion', '') }}" required>
                        @if ($errors->has('classificaion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('classificaion') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.school.fields.classificaion_helper') }}</span>
                    </div> 
                    <div class="form-group col-md-4">
                        <label class="required"
                            for="start_time">{{ trans('cruds.school.fields.start_time') }}</label>
                        <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}"
                            type="text" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                        @if ($errors->has('start_time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('start_time') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.school.fields.start_time_helper') }}</span>
                    </div>

                    <div class="form-group col-md-4">
                        <label class="required" for="end_time">{{ trans('cruds.school.fields.end_time') }}</label>
                        <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}"
                            type="text" name="end_time" id="end_time" value="{{ old('end_time') }}" required>
                        @if ($errors->has('end_time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('end_time') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.school.fields.end_time_helper') }}</span>
                    </div>
                    <div class="form-group col-md-8">
                        <input style="width: 300px" id="pac-input" class="form-control" type="text" placeholder="Search Box" />
                        <div id="map3" class="m-b30 align-self-stretch" style="width: 100%; height: 400px"></div> 
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
        locate();

        let markers = []; 
        let map;

        function locate() {
            navigator.geolocation.getCurrentPosition(myMap3, fail);
        }

        function fail(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                break;
            }
        }

        function myMap3(position) {
            var mapCanvas = document.getElementById("map3");
            var mapOptions = {
                center: new google.maps.LatLng(position.coords.latitude, position.coords.longitude),
                zoom: 14,
                mapTypeId: "roadmap",
            };
            map = new google.maps.Map(mapCanvas, mapOptions);

            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });

            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();

                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }

                    addmarker(place.geometry.location.lat(), place.geometry.location.lng());

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });

            addmarker(position.coords.latitude, position.coords.longitude);

            // Configure the click listener.
            map.addListener("click", (mapsMouseEvent) => { 
                addmarker(mapsMouseEvent.latLng.lat(), mapsMouseEvent.latLng.lng());
            });
        }

        function addmarker(lat, lng, title = '') {
            for (let i = 0; i < markers.length; i++) {
                markers[i].setMap(null); 
            }

            const marker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                map,
                title: title,
            }); 
            $('#latitude').val(lat);
            $('#longitude').val(lng);
            markers.push(marker); 
        }
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
                @if (isset($school->user) && $school->user->photo)
                    var file = {!! json_encode($school->user->photo) !!}
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
                @if (isset($school->user) && $school->user->identity_photo)
                    var files = {!! json_encode($school->user->identity_photo) !!}
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
