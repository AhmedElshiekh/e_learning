@extends('admin.layout.master')
@section('title','Classes')
@section('content')
    <div class="container">
        <div class="row row-card-no-pd">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">{{__('Show Class')}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive table-hover table-sales">
                                    <table class="table" id="table">
                                        <thead>
                                        @if ($class->student)
                                            <th>{{__('Student')}}</th>
                                        @endif
                                        <th>{{__('Teacher')}}</th>
                                        <th>{{__('Course')}}</th>
                                        <th>{{__('Start From')}}</th>
                                        <th>{{__('Weeks')}}</th>
                                        <th>{{__('Created At')}}</th>
                                        {{-- <th>{{__('Free Trail')}}</th> --}}

{{--                                        <th>{{__('Action')}}</th>--}}

                                        </thead>

                                                <tbody>
                                                <tr>

                                                    @if ($class->student)
                                                    <td>{{$class->student->name}}</td>
                                                    @endif
                                                    {{-- <td>{{$class->course->teacher->name}}</td> --}}
                                                    <td>{{$class->course->name}}</td>
                                                    <td>{{$class->start_from}}</td>
                                                    <td>{{$class->weeks}}</td>
                                                    <td>{{$class->created_at}}</td>
                                                    {{-- <td>{{$class->free ? 'Yes' : 'No'}}</td> --}}

{{--                                                    <td>--}}
{{--                                                        @role('admin|Supervisor')--}}
{{--                                                        <a href="{{route('admin.classes.show',$class->id)}}" class="btn btn-info btn-xs">--}}
{{--                                                            <i class='fa fa-edit'></i>{{__('Show')}}--}}
{{--                                                        </a>--}}

{{--                                                        @endrole--}}
{{--                                                    </td>--}}
                                                </tr>

                                                </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row row-card-no-pd">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">{{__('Lessons')}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive table-hover table-sales">
                                    <table class="table" id="table">
                                        <thead>
                                        <th>{{__('Lesson Name')}}</th>
                                        <th>{{__('Day')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Time')}}</th>
                                        <th>{{__('Status')}}</th>


                                        <th>{{__('Action')}}</th>

                                        </thead>

                                                <tbody>
                                                @foreach($class->lessons as $lesson)
                                                <form method="post" action="{{route('admin.class.lesson.update',$lesson)}}">
                                                    @csrf
                                                    <tr>
                                                    <td><input type="text" class="form-control" name="name" value="{{$lesson->name}}" ></td>
                                                    <td><input type="text" class="form-control" name="day" value="{{$lesson->day}}" required></td>
                                                    <td><input type="date" class="form-control" name="date" value="{{$lesson->date}}"required></td>
                                                    <td><input type="time" class="form-control" name="time" value="{{$lesson->time}}" required></td>
                                                    <td>{{$lesson->status}}</td>

                                                    <td>
{{--                                                        @role('admin|Supervisor')--}}
                                                        <button type="submit" class="btn btn-info btn-xs"> <i class='fa fa-edit'></i>{{__('Update')}}</button>
                                                    @if($lesson->status == 'in progress')
                                                        <a href="{{route('admin.class.lesson.status.change',[$lesson->id,'canceled'])}}" class="btn btn-danger btn-xs">
                                                            <i class='fa fa-remove'></i>{{__('Cancel')}}
                                                        </a>
                                                        @endif

                                                        {{--                                                        @endrole--}}
                                                    </td>
                                                </tr>
                                                </form>
                                                @endforeach

                                                </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
@section('script')
    <script>

        function removeProduct(name, url, e) {
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
        $(document).ready(function() {
            $('#table').dataTable({
                "responsive": false,
                "paginate": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order': [['0', 'desc']]
            });
        });
    </script>
@stop
