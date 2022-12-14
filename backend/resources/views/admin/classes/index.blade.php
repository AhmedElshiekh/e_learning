@extends('admin.layout.master')
@section('title','Classes')
@section('content')
    <div class="container">
        <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('All Classes')}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table" id="table">
                                    <thead>
                                    <th>{{__('Student')}}</th>
                                    <th>{{__('Teachers')}}</th>
                                    <th>{{__('Course')}}</th>
                                    <th>{{__('Start From')}}</th>
                                    <th>{{__('Weeks')}}</th>
                                    <th>{{__('Created At')}}</th>

                                    <th>{{__('Action')}}</th>

                                    </thead>
                                   @if($classes->count() > 0)
                                       @foreach($classes as $class)
                                    <tbody>
                                    <tr>
                                        @if ($class->student)
                                        <td>{{$class->student->name}}</td>
                                        @else
                                        <td>#</td>
                                        @endif
                                        <td>
                                            @foreach($class->course->teachers as $teacher)
                                                {{ $teacher->name ." / "}}
                                            @endforeach
                                        </td>
                                        <td>{{$class->course->name}}</td>
                                        <td>{{$class->start_from}}</td>
                                        <td>{{$class->weeks}}</td>
                                        <td>{{$class->created_at}}</td>

                                        <td>
                                        @role('admin|Supervisor')
                                            <a href="{{route('admin.classes.show',$class->id)}}" class="btn btn-info btn-xs">
                                                <i class='fa fa-edit'></i>{{__('Show')}}
                                            </a>

                                        @endrole
                                        </td>
                                    </tr>

                                    </tbody>
                                     @endforeach
                                   @endif
                                </table>
                            </div>
                        </div>
                        {{ $classes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop
@section('script')
    <script>
        $('.status').change(function () {
            let status = $(this).prop('checked');
            // console.log(status);
            let href = $(this).next().attr('data-href');
            if(status){status = 1}else{status = 0}
            $.ajax({
                url: href,
                method: 'post',
                data: {'status': status, '_token': "{{ csrf_token() }}"},
                success: function (data) {
                    // window.location.reload();
                }
            });
        });
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
