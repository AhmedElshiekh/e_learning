@extends('admin.layout.master')
@section('content')
   <div class="container">
      <div class="mt-5">
        <div class="card text-center">
            <div class="card-header">

            </div>
            <div class="card-body">
                <h3 class="card-title">{{$exam->title}}</h3>
                 <h4>Time : {!! $exam->time !!} /Minutes</h4>
                {{-- <p class="card-text">{!! $course->desc!!}</p> --}}
            </div>
            <div class="card-footer text-muted" style="background-color:rgba(0,0,0,.03);">

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
                        <h4 class="card-title">{{__('Exam Sections')}}</h4>
                    </div>
                    <a type="" style="color: #fff" class="btn btn-primary float-right" data-toggle="modal" data-target="#productCategory">{{__('Add Section')}}</a>

                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table class="table" id="table">
                                    <thead>
                                    <th>{{__('Section Name')}}</th>

                                    <th>{{__('Action')}}</th>

                                    </thead>

                                            <tbody>
                                            @foreach($exam->sections as $section)
                                            <form method="post" action="{{route('admin.exam.section.update',$section)}}">
                                                @csrf
                                                <tr>
                                                    <input type="hidden" name="exam_id" value="{{$exam->id}}">

                                                <td><input type="text" class="form-control" name="name" value="{{$section->name}}" ></td>
                                                <td>
                                                    <button type="submit" class="btn btn-info btn-xs"> <i class='fa fa-edit'></i>{{__('Update')}}</button>

                                                    <a href="{{route('admin.exam.section.show',$section)}}" class="btn btn-success btn-xs">
                                                        <i class='fa fa-eye'></i>{{__('Questions')}}
                                                    </a>


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

   <div class="modal fade" id="productCategory" tabindex="-1" role="dialog" aria-labelledby="productCategory" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="BlogCategory">{{__('Add Section')}}</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <form  method="POST" action="{{route('admin.exam.section.store')}}" enctype="multipart/form-data" file="true">
                       @csrf
                       <input type="hidden" name="exam_id" value="{{$exam->id}}">
                           <div class="form-group">
                               <label for="name"> {{__('Name')}}</label>
                               <input type="text" name="name" class="form-control" >
                           </div>

                       <button type="submit" class="btn btn-primary float-right">{{__('Save')}}</button>
                   </form>
               </div>
           </div>
       </div>
   </div>


   <div class="modal fade" id="updateChapter" tabindex="-1" role="dialog" aria-labelledby="updateChapter" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="updateBlogCategory">{{__('Edit Chapter')}}</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <form  method="POST" action="" enctype="multipart/form-data" file="true">
                       @csrf
                       @method('PUT')
                       {{-- <input type="hidden" name="course_id" value="{{$course->id}}"> --}}

                       <div class="form-group">
                           <label for="name"> {{__('Name')}}</label>
                           <input type="text" name="name" class="form-control" >
                       </div>
                       <div class="form-group">
                           <label for="description"> {{__('Description')}}</label>
                           <textarea name="description" class="form-control" ></textarea>
                       </div>
                       <button type="submit" class="btn btn-primary float-right">Save</button>
                   </form>
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

        function editChapter(name,price,href) {
            // alert(href);
            let modal = $('#updateChapter');
            modal.find('.modal-body input[name="name"]').val(name);
            modal.find('.modal-body textarea[name="description"]').val(description);


            modal.find('.modal-body form').attr("action",href);

        };


    </script>
@stop
