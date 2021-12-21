@extends('admin.layout.master')
@section('content')
   <div class="container">
      <div class="mt-5">
        <div class="card text-center">
            <div class="card-header">

            </div>
            <div class="card-body">
                <h3 class="card-title">{{$chapter->name}}</h3>

            </div>
            <div class="card-footer text-muted" style="background-color:rgba(0,0,0,.03);">

            </div>
        </div>
      </div>
   </div>


  {{-- <div class="container">
      <div class="mt-5">
        <div class="card text-center">
            <div class="card-header">

                <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">{{__('Chapters/Unit')}}</h4>
                </div>
                <a type="" style="color: #fff" class="btn btn-primary float-right" data-toggle="modal" data-target="#productCategory">{{__('Add Chapter')}}</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive table-hover table-sales">
                            <table id="table" class="table">
                                <thead>

                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Price')}}</th>
                                <th>{{__('Action')}}</th>

                                </thead>

                                    <tbody>
                                    @foreach($chapters as $chapter)
                                        <tr>
                                            <td>{{$loop->iteration }}</td>
                                            <td>{{$chapter->name}}</td>
                                            <td>{{$chapter->price}}</td>
                                            <td>
                                               <a href="{{route('admin.chapter.show', $chapter->id)}}" class="btn btn-success btn-xs text-white" >
                                                    <i class="fa fa-eye"></i> {{__('Show')}}
                                                </a>

                                                <a href="#" onclick="editChapter('{{$chapter->name}}','{{$chapter->description }}','{{route('admin.course.chapter.update',$chapter->id)}}')" class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateChapter">
                                                    <i class='fa fa-edit'></i>{{__('Edit')}}
                                                </a>
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
   </div> --}}


   <div class="container">
      <div class="mt-5">
        <div class="card text-center">
            <div class="card-header">

                <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">{{__('Lessons')}}</h4>
                </div>
                {{-- @if ($chapter->course->students->count() == 0) --}}
                <a type="button" class="btn btn-primary float-right" href="{{route('admin.course.lesson.create',$chapter->id)}}">
                    Add Lesson
                </a>
                {{-- @endif --}}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive table-hover table-sales">
                            <table id="table" class="table">
                                <thead>

                                <th>#</th>
                                <th>{{__('Topic')}}</th>
                                <th>{{__('Objective')}}</th>
                                <th>{{__('Action')}}</th>

                                </thead>

                                    <tbody>
                                    @foreach($chapter->lessons as $lesson)
                                        <tr>
                                            <td>{{$loop->iteration }}</td>
                                            <td>{{$lesson->topic}}</td>
                                            <td>{{$lesson->objective}}</td>
                                            <td>
                                                <a href="{{ route('admin.lessons.show', $lesson->id) }}" class="btn btn-success btn-xs text-white" >
                                                    <i class="fa fa-eye"></i> {{__('Show')}}
                                                </a>
                                             {{--   <a href="{{ route('admin.lessons.edit', $lesson->id) }}" class="btn btn-primary btn-xs text-white" >
                                                    <i class="fa fa-edit"></i>{{__('Edit')}}
                                                </a>  --}}

                                                <form action="{{route('admin.lessons.edit', $lesson->id)}}" method="get" style="display: inline-block;">

                                                    <input type="hidden" value="" name="course_id">

                                                    <input type="submit" value="{{__('Edit')}}" class="btn btn-primary btn-xs text-white">

                                                </form>
                                                @if ($chapter->course->students->count() == 0)
                                                    @role('admin')
                                                    <button class="btn btn-danger btn-xs" type="submit" onclick="removeProduct('{{$lesson->id}}','{{route('admin.lesson.destroy',$lesson->id)}}')">
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


      <div class="container">
      <div class="mt-5">
        <div class="card text-center">
            <div class="card-header">

                <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">{{__('Unit Questions')}}</h4>
                </div>

                {{-- <a type="button" class="btn btn-sm btn-success mx-1 float-right"  data-toggle="modal" data-target="#getFromBank">
                    {{__("Get From Bank")}}
                </a> --}}

                <a type="button" class="btn btn-sm btn-primary mx-1 float-right" href="{{route('admin.chapter.question.create',$chapter->id)}}">
                    {{__("Add questions")}}
                </a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive table-hover table-sales">
                            <table id="table" class="table">
                                <thead>
                                     <th>#</th>
                                    <th>{{__('Questions')}}</th>
                                    <th>{{__('Answers')}}</th>
                                    <th>{{__('Correct answers')}}</th>
                                    <th>{{__('Actions')}}</th>
                                </thead>
                                <tbody>
                                     @foreach($chapter->questions as $question)
                                        <tr>
                                            <td>{{$loop->iteration }}</td>
                                            <td>{{$question->title}}</td>
                                            <td>

                                              @foreach($question->answers as $answer)
                                                  {{ $answer->answer }} -
                                              @endforeach
                                            </td>
                                            <td>{{$question->correct_answer}}</td>
                                            <td>

                                                <form action="{{route('admin.question.edit', $question->id)}}" method="get" style="display: inline-block;">

                                                    <input type="hidden" value="{{$chapter->id}}" name="chapter_id">

                                                    <input type="submit" value="{{__('Edit')}}" class="btn btn-primary btn-xs text-white">
                                                </form>

                                                @role('admin')
                                                <button class="btn btn-danger btn-xs" type="submit" onclick="removeProduct('{{$question->id}}','{{route('admin.course.question.delete',$question->id)}}')">
                                                    <i class="fas fa-trash"></i> {{__('Delete')}}
                                                </button>
                                                @endrole

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



    <div id="getFromBank" class="modal fade"  role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form  method="POST" action="{{route('admin.question.getFromBank')}}" enctype="multipart/form-data" accept-charset="utf-8" file="true">
                        @csrf
                        <input class="form-control" hidden type="" name="chapter_id" value="{{$chapter->id}}">
                        <div class="table-responsive table-hover table-sales">
                            <table id="tableModal" class="table">
                                <thead>
                                    <th>#</th>
                                    <th>{{__('Title')}}</th>
                                    <th>{{__('Level')}}</th>
                                    <th>{{__('Answers')}}</th>
                                    <th>{{__('Correct answers')}}</th>
                                    {{-- <th>{{__('Actions')}}</th> --}}
                                </thead>
                                <tbody>

                                    @foreach($questions as $question)
                                        <tr>
                                            <td>
                                                <input type="checkbox" id="question" name="questions[]" value="{{$question->id}}">
                                            </td>
                                            <td>{{$question->title}}</td>
                                            <td>{{$question->level->name}}</td>
                                            <td>
                                            @foreach($question->answers as $answer)
                                                {{ $answer->answer }} -
                                            @endforeach
                                            </td>
                                            <td>{{$question->correctAnswer ? $question->correctAnswer->answer : null}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

  {{-- <div class="modal fade" id="productCategory" tabindex="-1" role="dialog" aria-labelledby="productCategory" aria-hidden="true">
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
                       <input type="hidden" name="course_id" value="#">
                           <div class="form-group">
                               <label for="name"> {{__('Name')}}</label>
                               <input type="text" name="name" class="form-control" >
                           </div>
                           <div class="form-group">
                               <label for="description"> {{__('Description')}}</label>
                               <textarea  name="description" class="form-control" ></textarea>
                           </div>
                       <button type="submit" class="btn btn-primary float-right">{{__('Save')}}</button>
                   </form>
               </div>
           </div>
       </div>
   </div>  --}}


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
                       <input type="hidden" name="chapter_id" value="{{$chapter->id}}">

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



    </script>
@stop
