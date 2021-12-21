@extends('admin.layout.master')
@section('content')
   <div class="container">
      <div class="mt-5">
        <div class="card text-center">
            <div class="card-header">
                @if($course->hasMedia('Course'))
                    <div class="flag">
                        <img  class="card-img-top" style="width: 300px"  src="{{ asset($course->firstMedia('Course')->getUrl()) }}">
                    </div>
                @endif
            </div>
            <div class="card-body">
                <h3 class="card-title">{{$course->name}}</h3>
              {{--  <h5>{!! $course->sh_desc !!}</h5>
                <p class="card-text">{!! $course->desc!!}</p> --}}
            </div>
            <div class="card-footer text-muted" style="background-color:rgba(0,0,0,.03);">

            </div>
        </div>
      </div>
   </div>


   <div class="container">
      <div class="mt-5">
        <div class="card text-center">
            <div class="card-header">

                <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">{{__('Chapters/Unit')}}</h4>
                </div>
                {{-- @if ($course->students->count() == 0) --}}
                    <a type="" style="color: #fff" class="btn btn-primary float-right" data-toggle="modal" data-target="#productCategory">{{__('Add Chapter')}}</a>
                {{-- @endif --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive table-hover table-sales">
                            <table id="table" class="table">
                                <thead>

                                <th>#</th>
                                <th>{{__('Name EN')}}</th>
                                <th>{{__('Name AR')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Action')}}</th>

                                </thead>

                                    <tbody>
                                    @foreach($chapters as $chapter)
                                        <tr>
                                            <td>{{$loop->iteration }}</td>

                                            {{-- <td>{{$chapter->name}}</td> --}}
                                            @foreach(config('locales') as $lang)
                                               <td> {{$chapter->getTranslation('name',$lang)}}</td>
                                            @endforeach

                                            <td>{{$chapter->description}}</td>
                                            <td>
                                               <a href="{{route('admin.chapter.show', $chapter->id)}}" class="btn btn-success btn-xs text-white" >
                                                    <i class="fa fa-eye"></i> {{__('Lessons')}}
                                                </a>

                                                <a href="#" onclick="editChapter('{{$chapter->name}}','{{$chapter->description }}','{{route('admin.course.chapter.update',$chapter->id)}}')" class="btn btn-info btn-xs text-white" data-toggle="modal" data-target="#updateChapter">
                                                    <i class='fa fa-edit'></i>{{__('Edit')}}
                                                </a>
                                                @if ($chapter->course->students->count() == 0)
                                                @role('admin')
                                                    <button class="btn btn-danger btn-xs" type="submit" onclick="removeUnit('{{$chapter->id}}','{{route('admin.course.chapter.destroy',$chapter->id)}}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endrole
                                                @endif
                                            </td>
                                        </tr>


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


   <div class="modal fade" id="productCategory" tabindex="-1" role="dialog" aria-labelledby="productCategory" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="BlogCategory">{{__('Add Chapter')}}</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <form  method="POST" action="{{route('admin.course.chapter.store')}}" enctype="multipart/form-data" file="true">
                       @csrf
                       <input type="hidden" name="course_id" value="{{$course->id}}">
                            @foreach(config('locales') as $lang)
                                <div class="form-group">
                                    <label for="name"> {{$lang == 'en'? __('Name english'): __('Name arabic')}}</label>
                                    <input type="text" name="name_{{$lang}}" class="form-control" >
                                </div>
                            @endforeach

                            <div class="form-group">
                                <label for="description"> {{__('Description')}}</label>
                                <textarea name="description" class="form-control" ></textarea>
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
                       <input type="hidden" name="course_id" value="{{$course->id}}">
                       @foreach(config('locales') as $lang)
                            <div class="form-group">
                                <label for="name"> {{$lang == 'en'? __('Name english'): __('Name arabic')}}</label>
                                <input type="text" name="name_{{$lang}}"
                                {{-- value="{{$chapter->getTranslation('name',$lang)}}"  --}}
                                class="form-control" >
                            </div>
                        @endforeach
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

        function removeUnit(name, url, e) {
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

        function editChapter(name,description,href) {
            // alert(href);
            let modal = $('#updateChapter');
            modal.find('.modal-body input[name="name"]').val(name);
            modal.find('.modal-body textarea[name="description"]').val(description);


            modal.find('.modal-body form').attr("action",href);

        };

        $(document).ready(function() {
            $('#table').DataTable();
            // $('#tableModal').DataTable();
        });


    </script>
@stop
