@extends('admin.layout.master')
@section('title','Create Question')
@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.question.update')}}"  enctype="multipart/form-data" accept-charset="utf-8" file="true">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Question</div>
                        </div>
                        <div class="card-body">
                            @if($course)    <input hidden name="course_id" value="{{$course->id}}">@endif
                            <input hidden name="question_id" value="{{$question->id}}">
                            {{-- @if($lesson)    <input hidden name="lesson_id" value="{{$lesson->id}}">@endif --}}


                            {{-- <div class="row">

                                <div class="col-md-4" {{$course ? 'hidden' :null}}>
                                    <div class="form-group">
                                        <label for="category">{{ __('Select Main Category') }}*</label>
                                        <select name="category" id="category"
                                                class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                            <option value="">{{ __('Select') }} {{ __('Category') }}</option>
                                            @foreach($categoriesCourse as $category)
                                                <option {{$course ? $course->parent_cat_id == $category->id ? 'selected':'' :null}} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2" {{$course ? 'hidden' :null}}>
                                    <div class="form-group">
                                        <label for="subCategory">{{ __('Sub Category') }}*</label>
                                        <select name="subCategory" id="subCategory"
                                                class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                            <option value="">{{ __('Select') }} {{ __('SubCategory') }}</option>
                                            @if($course)
                                            @foreach($course->parentCategory->children as $category)
                                                <option {{ $course->sub_cat_id == $category->id ? 'selected':''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2" {{$course ? 'hidden' :null}}>
                                    <div class="form-group">
                                        <label for="subCategory">{{ __('Category') }}*</label>
                                        <select name="category_id" id="category_id"
                                                class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                            <option value="">{{ __('Select') }} {{ __('Category') }}</option>
                                            @if($course)
                                            @foreach($course->subCategory->children as $category)
                                                <option {{ $course->course_cat_id == $category->id ? 'selected':''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                {{-- <div class="col-md-3 mb-2" {{$course ? 'hidden' :null}}>
                                    <div class="form-group">
                                        <label for="">{{ __('Level') }}*</label>
                                        <select name="level" id="" class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                            <option value="">{{ __('Select') }} {{ __('Level') }}</option>
                                            @foreach($levels as $level)
                                                <option {{$course ? $course->level_id == $level->id ? 'selected':'' :null}} value="{{ $level->id }}">{{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label for="">{{ __('Score') }}*</label>
                                       <input type="number" class="form-control" name="score" min="1" value="{{$question->score}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="name  ">Title *</label>
                                        <input type="text" name="title" class="form-control flex-sm-row" value="{{$question->title}}" id="name" placeholder="Enter Question  " required>
                                    </div>
                                </div>
                            </div>


                            <div class="row text">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="desc">Correct Answer</label>
                                        <input type="text" class="form-control" placeholder="Enter Correct Choice" value="{{$correct_answer->answer}}" name="answers[]">
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding-top: 38px;">
                                    <a href="#" class="add_input btn btn-info" ><i class="fa fa-plus"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>


                            <div class=" div_inputs " >
                                @foreach ($question->answers as  $answer)
                                    @if ($answer != $correct_answer)
                                    <div class="row">
                                        <div class="col-md-9" >
                                            <label for="answer">Choice</label>
                                            <input type="text" name="answers[]" class="form-control flex-sm-row" id="answer" placeholder="Enter Choice" value="{{$answer->answer}}">

                                        </div>
                                        <div class="col-md-3" style="padding: 20px;">
                                            <div class="clearfix"></div>
                                            <a href="#" class="remove_input btn btn-danger" ><i class="fa fa-trash"></i></a>

                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="clearfix"></div><br>
                            <div class="card-action">
                                <button type="submit" class="btn btn-success float-right">{{__('Save')}}</button>
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

    $("select").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");

            if(optionValue == 'choice' || optionValue == 'boolean') {
                $('.div_inputs').css('display', 'block');
                $('.add_input').css('display', 'block');
            }
        });
    });


    $('select[name="chapter_id"]').on('change', function () {
            var chapterId = $(this).val();
            //alert($(this).val());
            if (chapterId) {
                let ur = "{{url('/admin/chapters')}}";
                $.ajax({
                    url: ur + '/' + chapterId,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        $('select[name="lesson_id"]').empty();
                       // $('select[name="type"]').empty();
                        $('select[name="lesson_id"]').append('<option value="">{{__('Select Lesson')}}</option>');
                        $.each(data, function (key, value) {
                            $('select[name="lesson_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });

            } else {
                $('select[name="lesson_id"]').empty();
            }
        });


        var x = 1;
        $('.add_input').on('click', function (e) {
            e.preventDefault();
            var max_input = 10;
            if (x <= max_input) {

                $('.div_inputs').append('<div class="row">' +

                            '<div class="col-md-9">' +
                                '<label for="answer">Choice</label>' +
                                 '<input type="text" name="answers[]" class="form-control flex-sm-row" id="answer" placeholder="Enter Choice" value="">' +

                            '</div>' +
                            '<div class="col-md-3" style="padding:20px">' +

                            '<div class="clearfix"></div>' +

                             '<a href="#" class="remove_input btn btn-danger"><i class="fa fa-trash"></i></a>' +
                             '</div>' +
                        '</div>');
                x++;
            }
            return false;
        });

        $(document).on('click', '.remove_input', function (e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            x--;

        });





        $('select[name="category"]').on('change', function () {
            var categoryID = $(this).val();
            // alert($(this).val());
            if (categoryID) {
                let ur = "{{url('/admin/categories/subCategory')}}";
                $.ajax({
                    url: ur + '/' + categoryID,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        $('select[name="subCategory"]').empty();
                        $('select[name="type"]').empty();
                        $('select[name="subCategory"]').append('<option value="">{{__('Select SubCategory')}}</option>');
                        $.each(data, function (key, value) {
                            $('select[name="subCategory"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });

        {{-- let ur2 = "{{url('/admin/categories/attributes')}}";

                $.ajax({
                    url: ur2 + '/' + categoryID,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="selectAttribute"]').empty();
                        $('select[name="selectAttribute"]').append('<option value="">{{__('Select Attribute')}}</option>');
                        $.each(data, function (key, value) {
                            $('select[name="selectAttribute"]').append('<option value="' + value + '">' + value + '</option>');
                        });
                    }
                }); --}}

            } else {
                $('select[name="subCategory"]').empty();
            }
        });
        $('select[name="subCategory"]').on('change', function() {
            var categoryID = $(this).val();
            if(categoryID) {
                let ur =  "{{url('admin/categories/subCategory')}}";
                $.ajax({
                    url: ur+'/'+categoryID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[name="category_id"]').empty();
                        // $('select[name="type"]').empty();
                        $('select[name="category_id"]').append('<option value="">{{__('Select category')}}</option>');
                        $.each(data, function(key, value) {
                            $('select[name="category_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="category_id"]').empty();
            }
        });






});
</script>

@stop


