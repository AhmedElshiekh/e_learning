@extends('admin.layout.master')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Requests')}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table id="table" class="table">
                                    <thead>

                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Phone')}}</th>
                                    <th>{{__('Teacher')}}</th>
                                    <th>{{__('Course Name')}}</th>
                                    <th>{{__('Start Date')}}</th>
                                    <th>{{__('Note')}}</th>
                                    <th>{{__('Action')}}</th>

                                    </thead>
                                    @if($requests->count() > 0)
                                        <tbody>
                                        @foreach($requests as $request)
                                            <tr>
                                                <td>{{$request->user->name ??null}}</td>
                                                <td>
                                                    {{$request->user->phone ??null}}
                                                </td>
                                                <td>
                                                    {{$request->teacher ? $request->teacher->name :null}}
                                                </td>
                                                <td>
                                                    {{$request->course ? $request->course->name :null}}
                                                </td>
                                                <td>
                                                    {{$request->start_date}}
                                                </td>

                                                <td>
                                                    {{$request->note}}
                                                </td>
                                                <td>
                                                    <a href="{{route('admin.class.createFReq',$request->id)}}" class="btn btn-info btn-xs">
                                                        {{__('create')}}
                                                    </a>
                                                    @role('admin')
                                                        <button class="btn btn-danger btn-xs" type="submit" onclick="removeReq('{{$request->id}}','{{route('admin.request.destroy',$request->id)}}')">
                                                            <i class="fas fa-trash"></i>
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
@stop

@section('script')

    <script>
        $(document).ready(function() {
            $('#table').dataTable();
        });

        function removeReq(name, url, e) {
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
