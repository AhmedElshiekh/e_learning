@extends('admin.layout.master')
@section('title','Create Exam')
@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.exams.store')}}"  enctype="multipart/form-data" accept-charset="utf-8" file="true">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Add Exam</div>
                        </div>
                        <div class="card-body">



                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="name  ">Title *</label>
                                        <input type="text" name="title" class="form-control flex-sm-row" id="name" placeholder="Enter Exam Title  " value="{{old('title')}}" required>
                                    </div>

                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <label for="">{{ __('Num of Sections') }}*</label>
                                           <input type="number" class="form-control" name="sections" min="1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <label for="">{{ __('Exam Time / Minute') }}*</label>
                                           <input type="number" class="form-control" name="time" min="1" required>
                                        </div>
                                    </div>
                                </div>

                            </div>







                            <div class="card-action">
                                <button type="submit" class="btn btn-success float-right">{{__('Add')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
@section('script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
<script>

$(document).ready(function(){
















});
</script>

@stop


