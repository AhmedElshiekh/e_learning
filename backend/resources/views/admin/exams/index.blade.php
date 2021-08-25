@extends('admin.layout.master')
@section('content')
   <div class="container">
    <div class="mt-5">
      <div class="card text-center">
          <div class="card-header">

              <div class="card-head-row card-tools-still-right">
                  <h4 class="card-title">{{__('Exams')}}</h4>
              </div>
              <a type="button" class="btn btn-sm btn-success mx-1 float-right"  data-toggle="modal" data-target="#placementTest">
                {{__("Global placement test")}}
             </a>
              <a type="button" class="btn btn-sm btn-primary float-right" href="{{route('admin.exams.create')}}">
                  {{__("Add Exam")}}
              </a>
          </div>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-12">
                      <div class="table-responsive table-hover table-sales">
                          <table id="table" class="table">
                              <thead>
                                  <th>#</th>
                                  <th>{{__('Title')}}</th>
                                  <th>{{__('Placement Test')}}</th>
                                  <th>{{__('Actions')}}</th>

                              </thead>
                              <tbody>
                                  @foreach($exams as $exam)
                                      <tr>
                                          <td>{{$loop->iteration }}</td>
                                          <td>{{$exam->title}}</td>
                                          <td>@if($exam->global == true ) <i class="fa fa-check"</i>@endif</td>

                                          <td>
                                             <a href="{{ route('admin.exams.show', $exam->id) }}" class="btn btn-primary btn-xs text-white" >
                                                  <i class="fa fa-eye"></i>{{__('Details')}}
                                              </a>



                                              @role('admin')
                                              <button class="btn btn-danger btn-xs" type="submit" onclick="removeProduct('{{$exam->id}}','{{route('admin.exam.delete',$exam->id)}}')">
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
          <div id="placementTest" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-body">
                          <form method="post" action="{{route('admin.exam.setPlacementTest')}}">
                            @csrf
                              <div class="container">
                                <div class="row"><div class="col"><div class="form-group">
                                    <label for="my-select">{{__("Select Global Placement Test")}}</label>
                                    <select id="my-select" class="form-control" name="exam">
                                        <option>none</option>
                                        @foreach($exams as $exam)
                                            <option {{$exam->global == true ? 'selected': null}} value='{{$exam->id}}'>{{$exam->title}}</option>
                                        @endforeach
                                    </select>
                                </div></div></div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </div>
                          </form>
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



        $(document).ready(function() {
            $('#table').DataTable();
            // $('#tableModal').DataTable();
        });


    </script>
@stop
