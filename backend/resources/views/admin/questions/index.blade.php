@extends('admin.layout.master')
@section('content')
   <div class="container">
    <div class="mt-5">
      <div class="card text-center">
        {{-- <form  method="POST" action="{{route('admin.course.question.multiDelete')}}">
          @csrf --}}
          <div class="card-header">

                <div class="card-head-row card-tools-still-right">
                    <h4 class="card-title">{{__('Question Bank')}}</h4>
                </div>

                <a type="button" class="btn btn-sm btn-primary float-right" href="{{route('admin.question.create')}}">
                    Add Question
                </a>
                {{-- <a type="button" class="btn btn-sm btn-success mx-1 float-right"  data-toggle="modal" data-target="#multidelete">
                    {{__("multi delete")}}
                </a> --}}
                {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                @role('admin')
                    <button class="btn btn-danger btn-sm mx-1 float-right" type="submit" onclick="removeMultiDelete('{{route('admin.course.question.multiDelete')}}')">
                        <i class="fas fa-trash"></i>
                    </button>
                @endrole
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                      <div class="table-responsive table-hover table-sales">
                          <table id="table" class="table">
                              <thead>
                                  <th>#</th>
                                  <th>{{__('Title')}}</th>
                                  <th>{{__('Level')}}</th>
                                  <th>{{__('Category')}}</th>

                                  <th>{{__('Answers')}}</th>
                                  <th>{{__('Correct answers')}}</th>
                                  <th>{{__('Actions')}}</th>
                              </thead>
                              <tbody>
                                  @foreach($questions as $question)
                                      <tr class="{{$question->id}}">
                                          {{-- <td>{{$loop->iteration }}</td> --}}
                                          <td>
                                            <input type="checkbox" class="question"  name="questions[]" value="{{$question->id}}">
                                          </td>
                                          <td>{{$question->title}}</td>
                                          <td>{{$question->level->name}}</td>
                                          <td>{{$question->category->name}}</td>
                                          <td>
                                            @foreach($question->answers as $answer)
                                                {{ $answer->answer }} -
                                            @endforeach
                                          </td>
                                          <td>{{$question->correctAnswer ? $question->correctAnswer->answer : null}}</td>
                                          <td>
                                           {{--   <a href="{{ route('admin.question.edit', $question->id) }}" class="btn btn-primary btn-xs text-white" >
                                                  <i class="fa fa-edit"></i>{{__('Edit')}}
                                              </a> --}}

                                              <form action="{{route('admin.question.edit', $question->id)}}" method="get" style="display: inline-block;">

                                                  {{-- <input type="hidden" value="{{$course->id}}" name="course_id"> --}}

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
          {{-- <div class="card-footer text-muted" style="background-color:rgba(0,0,0,.03);">
              <p class="card-text">
                 @role('Marketer')
                 <button class="btn btn-secondary " aria-label="copied" data-clipboard-text="{{url('course/'.$course->slug.'?ref='.auth()->user()->id)}}">{{__('Copy My Link')}}</button>
                 @endrole
              </p>
          </div> --}}
        {{-- </form> --}}
      </div>
    </div>
 </div>


 @stop
 @section('script')
 <script>
     $(document).ready(function() {
        $('#table').DataTable();
    } );
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

     function removeMultiDelete(url, e) {
        swal({
            title: "Are you sure?",
            text: "في حاله تأكيد الحذف, سيتم حذف الاسأله من داخل الامتحانات الموجوده بها",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            $.ajax({
                url: url,
                type: "POST",
                cache:false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('input:checkbox.question').serialize(),
                success: function () {
                    swal("Done!","It was succesfully deleted!","success");
                    console.log($('.question:checked').parent().parent().remove());
                }
            });
        });
     };


 </script>
@endsection
