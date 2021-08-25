@extends('admin.layout.master')
@section('title','Teacher')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Teachers')}}</h4>
                    </div>

                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addTeacher">
                        {{__('Add Teacher')}}
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table" id="table">
                                    <thead>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
{{--                                    <th>{{__('Country')}}</th>--}}
                                    <th>{{__('phone')}}</th>
                                    <th>{{__('Qualifications')}}</th>
                                    <th>{{__('Balance')}}</th>
                                    <th>{{__('Action')}}</th>
                                    </thead>
                                   @if($users->count() > 0)
                                        <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
{{--                                        <td>{{$user->country}}</td>--}}
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->qualifications}}</td>
                                        <td>{{$user->remaining}}</td>
                                        <td>
                                            <a href="{{route('admin.teacher.edit',$user->id)}}" class="btn btn-info btn-xs">
                                                <i class='fa fa-edit'></i>{{__('Edit')}}
                                            </a>
                                            {{-- <a class="btn btn-success btn-xs"  href="{{route('admin.teacher.show',$user)}}">{{__('Profile')}}</a> --}}
                                            @if($user->approved ==0)
                                                <a class="btn btn-success btn-xs"  href="{{route('admin.approve.review',$user)}}">{{__('Active')}}</a>
                                            @endif
                                            @if($user->showHome ==0)
                                                <a class="btn btn-info btn-xs"  href="{{route('admin.showHome.show',$user)}}">{{__('show home')}}</a>
                                            @else
                                                <a class="btn btn-danger btn-xs"  href="{{route('admin.showHome.show',$user)}}">{{__('Hide')}}</a>
                                            @endif
                                            @if($user->remaining > 0)
                                                <a class="btn btn-primary btn-xs"  href="{{route('admin.teacher.paid',$user)}}">{{__('Paid')}}</a>
                                            @endif
                                            @role('admin')
                                            <button class="btn btn-danger btn-xs" type="submit" onclick="removeUser('{{$user->id}}','{{route('admin.site.user.delete',$user->id)}}')">
                                                <i class="fas fa-trash"></i> {{__('Delete')}}
                                            </button>
                                            @endrole
                                        </td>
                                    </tr>

                                        @endforeach
                                        </tbody>
                                   @endif
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addTeacher" tabindex="-1" role="dialog" aria-labelledby="productCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="BlogCategory">{{__('Add Teacher')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('admin.teacher.store')}}" enctype="multipart/form-data" file="true">
                        @csrf

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }} "
                                           id="name" name="name" value="{{old('name')}}" required>
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">{{ __('Email') }}</label>
                                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }} "
                                           id="email" name="email" value="{{old('email')}}" required>
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">{{ __('Zoom Link') }}</label>
                                    <input type="text" class="form-control {{ $errors->has('zoom') ? 'is-invalid' : '' }} "
                                           id="zoom" name="zoom" value="{{old('zoom')}}" >
                                    @if($errors->has('zoom'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('zoom') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">{{ __('Video Link') }}</label>
                                    <input type="text" class="form-control {{ $errors->has('video') ? 'is-invalid' : '' }} "
                                           id="video" name="video" value="{{old('video')}}" >
                                    @if($errors->has('video'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('video') }}
                                        </div>
                                    @endif
                                </div>
                            </div> --}}

                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                 <div class="form-group">
                                <label for="phone">{{ __('Phone') }}</label>
                                <input type="text" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }} "
                                       id="phone" name="phone" value="{{old('phone')}}" >
                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">{{ __('Hourly Price') }}</label>
                                    <input type="number" class="form-control {{ $errors->has('teamLink') ? 'is-invalid' : '' }}"
                                           id="hourly_price" name="hourly_price" value="{{old('hourly_price')}}" >
                                    @if($errors->has('hourly_price'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('hourly_price') }}
                                        </div>
                                    @endif
                                </div>
                            </div>


                        </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }} "
                                       id="password" name="password" value="" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password-confirm" >{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" required>
                            </div>

                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary float-right">{{__('Save')}}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@section('script')
    <script>
        $(document).ready(function() {
            $('#table').dataTable();
        });
        function removeUser(name, url, e) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = url;
                    }
                });
        };

    </script>
@stop
