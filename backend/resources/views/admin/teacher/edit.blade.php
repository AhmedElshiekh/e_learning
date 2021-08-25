@extends('admin.layout.master')
@section('title' , __('Edit Teacher'))

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <!--Block Styled Form -->
                    <!--===================================================-->
                    <form method="post" action="{{ route('admin.teacher.update',$user) }}" enctype="multipart/form-data" file="true">

                        @csrf
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="img">{{__('Profile Image')}}</label>
                                    <div class="form-group" id="imgPreview" >
                                        <img src="{{ $user->hasMedia('userAvatar') ? asset($user->lastMedia('userAvatar')->getUrl()) : null }}" class="img-fluid" alt="" width="200px" height="200px">
                                    </div>
                                    <div class="form-group">
                                        <input type="file" name="img" class="form-control-file"  id="img">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} "
                                               id="name" name="name" value="{{ $user->name }}" required>
                                        @if($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('Hourly Price') }}</label>
                                        <input type="number" class="form-control {{ $errors->has('teamLink') ? 'is-invalid' : '' }}"
                                               id="hourly_price" name="hourly_price" value="{{$user->hourly_price}}" >
                                        @if($errors->has('hourly_price'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('hourly_price') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('Zoom Link') }}</label>
                                        <input type="text" class="form-control {{ $errors->has('zoom') ? 'is-invalid' : '' }} "
                                               id="zoom" name="zoom" value="{{$user->zoom}}" >
                                        @if($errors->has('zoom'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('zoom') }}
                                            </div>
                                        @endif
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('TeamLink') }}</label>
                                        <input type="text" class="form-control {{ $errors->has('teamLink') ? 'is-invalid' : '' }} "
                                               id="teamLink" name="teamLink" value="{{$user->teamLink}}" >
                                        @if($errors->has('teamLink'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('teamLink') }}
                                            </div>
                                        @endif
                                    </div>
                                </div> --}}
                                {{-- <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">{{ __('Video Link') }}</label>
                                        <input type="text" class="form-control {{ $errors->has('video') ? 'is-invalid' : '' }} "
                                               id="video" name="video" value="{{$user->video}}" >
                                        @if($errors->has('video'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('video') }}
                                            </div>
                                        @endif
                                    </div>
                                </div> --}}

                            </div>

                        </div>
                        <div class="panel-footer text-right">
                            <button class="btn btn-primary my-2" type="submit">{{__('Save')}}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>

        // add profile photo
        $('input[type="file"]').on('change', function (e) {
            let fileName = e.target.files[0].name,
                reader = new FileReader();

            $(e.target).siblings('label').text(fileName);

            reader.onload = function (event) {
                $('#imgPreview img').attr('src', event.target.result);
            };

            reader.readAsDataURL(e.target.files[0]);
            $('#imgPreview').show();
        });

    </script>

@endsection
