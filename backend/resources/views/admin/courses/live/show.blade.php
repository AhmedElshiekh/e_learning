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
                <h5>{!! $course->sh_desc !!}</h5>
                <p class="card-text">{!! $course->desc!!}</p>
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
                    <h4 class="card-title">{{__('Classes')}}</h4>
                </div>
                {{-- <a type="" style="color: #fff" class="btn btn-primary float-right" data-toggle="modal" data-target="#productCategory">{{__('Add Class')}}</a> --}}
                @if(count($classes) == 0)
                    <button type="button" class="btn float-right btn-outline-primary" data-toggle="modal" data-target="#AddLesson"><i class="fa fa-plus"></i></button>
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive table-hover table-sales">
                            <table id="table" class="table">
                                <thead>

                                <th>#</th>
                                {{-- <th></th> --}}
                                <th>{{__('Start From')}}</th>
                                <th>{{__('Num Of Week')}}</th>
                                <th>{{__('Session Time / Minute')}}</th>
                                <th>{{__('Created At')}}</th>
                                <th>{{__('Action')}}</th>

                                </thead>

                                    <tbody>
                                    @foreach($classes as $class)
                                        <tr>
                                            <td>{{$loop->iteration }}</td>
                                            {{-- <td>
                                                @if ($class->private == true)
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-users" aria-hidden="true"></i>
                                                @endif
                                            </td> --}}
                                            <td>{{$class->start_from}}</td>
                                            <td>{{$class->weeks}}</td>
                                            <td>{{$class->session_time}}</td>
                                            <td>{{$class->created_at}}</td>
                                            <td>
                                               <a href="{{route('admin.classes.show', $class->id)}}" class="btn btn-success btn-xs text-white" >
                                                    <i class="fa fa-eye"></i> {{__('Show')}}
                                                </a>

                                                {{-- <a href="#" onclick="editChapter('{{$chapter->name}}','{{$chapter->price }}','{{route('admin.course.chapter.update',$chapter->id)}}')" class="btn btn-info btn-xs text-white" data-toggle="modal" data-target="#updateChapter">
                                                    <i class='fa fa-edit'></i>{{__('Edit')}}
                                                </a> --}}
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



   <div class="modal fade" id="AddLesson" tabindex="-1" role="dialog" aria-labelledby="AddLesson" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >{{__('Add lessons')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('admin.classes.store')}}"  enctype="multipart/form-data" accept-charset="utf-8" file="true">
                    @csrf
                    <input class="form-control" hidden value="{{$course->id}}" type="text" name="course_id">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weeks">{{__('Start From') }}*</label>
                                    <input type="date" name="start_from" class="form-control" id="weeks" placeholder="Enter "  required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weeks">{{__('Num Of Week') }}*</label>
                                    <input type="number" name="weeks" class="form-control" id="weeks" placeholder="Enter " value="1" min="1" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weeks">{{__('Session Time / Minute') }}*</label>
                                    <input type="number" name="session_time" class="form-control" id="weeks"  required>
                                </div>
                            </div>

                        </div><hr>


                        <h3>{{__('Days')}} <small></small></h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__('Sunday')}} <small></small></label>
                                    <input name="days[sunday]" type="time"  value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__('Monday')}} <small></small></label>
                                    <input name="days[monday]" type="time"   value="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__('Tuesday')}} <small></small></label>
                                    <input name="days[tuesday]" type="time"   value="" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__('Wednesday')}} <small>*</small></label>
                                    <input name="days[wednesday]" type="time"   value="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__('Thursday')}} <small></small></label>
                                    <input name="days[thursday]" type="time"   value="" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__('Friday')}} <small></small></label>
                                    <input name="days[friday]" type="time"   value="" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__('Saturday')}} <small></small></label>
                                    <input name="days[saturday]" type="time"   value="" class="form-control">
                                </div>
                            </div>
                        </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success float-right">{{__('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   </div>
</div>


{{-- <div class="container">
    <div class="mt-5">
      <div class="card text-center">
          <div class="card-header">

              <div class="card-head-row card-tools-still-right">
                  <h4 class="card-title">{{__('questions')}}</h4>
              </div>


              <a type="button" class="btn btn-sm btn-success mx-1 float-right"  data-toggle="modal" data-target="#getFromBank">
                  {{__("Get From Bank")}}
              </a>

              <a type="button" class="btn btn-sm btn-primary mx-1 float-right" href="{{route('admin.course.question.create',$course->id)}}">
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
                                  @foreach($course->questions as $question)
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

                                                  <input type="hidden" value="{{$course->id}}" name="course_id">

                                                  <input type="submit" value="{{__('Edit')}}" class="btn btn-primary btn-xs text-white">
                                              </form>

                                              @role('admin')
                                              <button class="btn btn-danger btn-xs" type="submit" onclick="removeProduct('{{$question->id}}','{{route('admin.course.question.delete',$question->id)}}')">
                                                  <i class="fas fa-trash"></i>
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
          <div id="getFromBank" class="modal fade"  role="dialog" >
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-body">
                          <form  method="POST" action="{{route('admin.question.getFromBank')}}" enctype="multipart/form-data" accept-charset="utf-8" file="true">
                              @csrf
                              <input class="form-control" hidden type="" name="course_id" value="{{$course->id}}">
                              <div class="table-responsive table-hover table-sales">
                                  <table id="tableModal" class="table">
                                      <thead>
                                          <th>#</th>
                                          <th>{{__('Title')}}</th>
                                          <th>{{__('Level')}}</th>
                                          <th>{{__('Answers')}}</th>
                                          <th>{{__('Correct answers')}}</th>
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
      </div>
    </div>
</div> --}}



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
                           <div class="form-group">
                               <label for="name"> {{__('Name')}}</label>
                               <input type="text" name="name" class="form-control" >
                           </div>
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
