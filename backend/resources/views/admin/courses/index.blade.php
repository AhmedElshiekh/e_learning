@extends('admin.layout.master')
@section('title','Course')
@section('content')
    <div class="container">
        <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('All Courses')}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table" id="table">
                                    <thead>
                                    <th>{{__('Image')}}</th>
{{--                                    <th>{{__('Provider')}}</th>--}}
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Short Description')}}</th>
                                    @role('admin|Supervisor')
                                    <th>{{__('Active')}}</th>
                                    @endrole
                                    <th>{{__('Action')}}</th>

                                    </thead>
                                   @if($courses->count() > 0)
                                       @foreach($courses as $course)
                                    <tbody>
                                    <tr>
                                        <td>
                                            @if($course->hasMedia('Course'))
                                            <div class="flag">
                                                <img width="80" height="80" src="{{ asset($course->lastMedia('Course')->getUrl()) }}">
                                            </div>
                                            @endif
                                        </td>
{{--                                        <td>{{$course->provider->name}}</td>--}}
                                        <td>{{$course->name}}</td>
                                        <td>
                                          {!! $course->sh_desc !!}
                                        </td>

                                        @role('admin|Supervisor')
                                        <td>
                                            <label class="colorinput switch switch-label switch-pill switch-success switch-md float-left">
                                                <input class="switch-input status colorinput-input"  type="checkbox" {{$course->status ? "checked":''}} name="status" value="secondary">
                                                <span class="switch-slider colorinput-color bg-secondary" style=" " data-href="{{route('admin.course.status', $course) }}"  data-checked="{{ __('on') }}" data-unchecked="{{ __('off') }}"></span>
                                            </label>

                                        </td>
                                        @endrole
                                        <td>
                                        @role('admin|Supervisor')
                                            <a href="{{route('admin.courses.show',$course->id)}}" class="btn btn-success btn-xs">
                                                <i class='fa fa-eye'></i>{{__('Units')}}
                                            </a>
                                            <a href="{{route('admin.courses.edit',$course->id)}}" class="btn btn-info btn-xs">
                                                <i class='fa fa-edit'></i>
                                            </a>

                                        @endrole
                                        @role('admin')
                                            <button class="btn btn-danger btn-xs" type="submit" onclick="removeCourse('{{$course->id}}','{{route('admin.course.destroy',$course->id)}}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endrole
{{--                                            @dd($course->slug)--}}

{{--                                            <a href="{{route('admin.courses.show',$course->id)}}" class="btn btn-success btn-xs">--}}
{{--                                                <i class='fa fa-eye'></i>{{__('Show')}}--}}
{{--                                            </a>--}}

                                        </td>
                                    </tr>

                                    </tbody>
                                     @endforeach
                                   @endif
                                </table>
                            </div>
                        </div>
                        {{ $courses->links() }}
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

        function removeCourse(name, url, e) {
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
