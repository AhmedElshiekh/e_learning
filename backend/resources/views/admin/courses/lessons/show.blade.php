@extends('admin.layout.master')
@section('content')
   <div class="container">
      <div class="mt-5">
        <div class="card text-center">
            <div class="card-header">

                    <div class="flag">
                        <video  width="500" height="500" controls >

                            <source src="{{ asset('uploads/'.$lesson->video) }}" type="video/mp4">
                            </video>

                            {{-- <embed src="{{ asset('uploads/'.$lesson->material) }}" width="400px" height="600px" /> --}}
                        </div>

                    </div>
            <div class="card-body">
                <h3 class="card-title">{{$lesson->topic}}</h3>
                <h5>{!! $lesson->objective !!}</h5>
                <p class="card-text">{!! $lesson->summary !!}</p>
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
                       <h4 class="card-title">{{__('Lesson Questions')}}</h4>
                   </div>




                   <a type="button" class="btn btn-sm btn-primary mx-1 float-right" href="{{route('admin.lesson.question.create',$lesson->id)}}">
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
                                   @foreach($lesson->questions as $question)
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

                                                   <input type="hidden" value="{{$lesson->id}}" name="lesson_id">

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
           </div>
       </div>
   </div>

@stop
@section('script')
    <script>
        var clipboard = new ClipboardJS('.btn');
        clipboard.on('success', function(e) {
            // swal(''e.trigger,'Copied!');
            swal({
                title: "Copied!",
                icon: "success",
                buttons: {
                    confirm : {
                        className: 'btn btn-success'
                    }
                }
            })
        });

        $(document).ready(function() {
            $('#table').dataTable({ "paginate": false});
            $('#reviewOrderModal').on('show.bs.modal', function (event) {
                let button = $(event.relatedTarget),

                    href = button.data('href'),
                    reject = button.data('reject'),
                    name = button.data('name'),
                    modal = $(this);
                $.ajax({
                    url: href,
                    method: 'get',
                    success: function (data) {
                        modal.find('.modal-title').text("Review Order");
                        modal.find('.modal-footer form').attr("action", reject);
                        modal.find('.modal-body').html(data);
                    }
                });
            });
        });
        function cancelOrder( url, e) {
            swal({
                title: "Are you sure?",
                text: " cancel this order",
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
