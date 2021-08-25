@extends('admin.layout.master')
@section('content')
    <div class="container">
        <div class="mt-5">
            <div class="card text-center">
                <div class="card-header">
{{--                    @dd($section)--}}
                    <h3 class="card-title">{{$section->exam->title .'/'.$section->name }}</h3>

                </div>
                <div class="card-body">

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
                        <h4 class="card-title">{{__('questions')}}</h4>
                    </div>


                    <a type="button" class="btn btn-sm btn-success mx-1 float-right"  data-toggle="modal" data-target="#getFromBank">
                        {{__("Get From Bank")}}
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
                                    @foreach($section->questions as $question)
                                        <tr>
                                            <td>{{$loop->iteration }}</td>
                                            <td>{{$question->title}}</td>
                                            <td>
                                                @foreach($question->answers as $answer)
                                                    {{ $answer->answer }} -
                                                @endforeach
                                            </td>
                                            <td>{{$question->correctAnswer->answer??null}}</td>
                                            <td>


                                                @role('admin')
                                                <button class="btn btn-danger btn-xs" type="submit" onclick="removeProduct('{{$question->id}}','{{route('admin.section.question.delete',[$section->id,$question->id])}}')">
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
                                <form  method="POST" action="{{route('admin.section.question.getFromBank',$section->id)}}" enctype="multipart/form-data" accept-charset="utf-8" file="true">
                                    @csrf
                                   {{-- <input class="form-control" hidden type="" name="course_id" value="{{$section->id}}"> --}}
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
                                                        <input type="checkbox" id="question"  name="questions[]" value="{{$question->id}}">
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
                        <input type="hidden" name="course_id" value="{{$section->id}}">
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
                        <input type="hidden" name="course_id" value="{{$section->id}}">

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
