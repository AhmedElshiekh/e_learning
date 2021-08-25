@extends('admin.layout.master')
@section('title','Create Course')
@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.courses.store')}}"  enctype="multipart/form-data" accept-charset="utf-8" file="true">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{__('Add Course')}}</div>
                            <div class="form-group">
                                <input type="hidden" name="type" value="post">
                            </div>
                        </div>

                        <div class="card-body">

                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="category">{{ __('Select Main Category') }}*</label>
                                            <select name="category" id="category"
                                                    class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                                <option value="">{{ __('Select') }} {{ __('Category') }}</option>
                                                @foreach($categoriesCourse as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <label for="subCategory">{{ __('Sub Category') }}*</label>
                                            <select name="subCategory" id="subCategory"
                                                    class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                                <option value="">{{ __('Select') }} {{ __('SubCategory') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <div class="form-group">
                                            <label for="subCategory">{{ __('Category') }}*</label>
                                            <select name="category_id" id="category_id"
                                                    class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                                <option value="">{{ __('Select') }} {{ __('Category') }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        {{--                                    <div class="form-group">--}}
                                        <label>{{__('Add Category') }}<span
                                                class="d-inline-block d-sm-none">{{ __('Category') }}</span></label>
                                        <button type="button" class="btn btn-block btn-outline-primary"
                                                data-toggle="modal" data-target="#productCategory"><i
                                                class="fa fa-plus"></i></button>
                                        {{--                                    </div>--}}
                                    </div>

                                </div>

                            <div class="row">
                                @foreach(config('locales') as $locale)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                            <input type="text" name="name_{{$locale}}" class="form-control" id="name" placeholder="Enter {{ $locale == 'en'? __('English Name') : __('Arabic Name') }}" required>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="">{{ __('Course Type') }}*</label>
                                            <select name="courseType" class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                                <option value="">{{ __('Select') }} {{ __('Type') }}</option>
                                                    <option value="live">{{ __('Live') }}</option>
                                                    <option value="recorded">{{ __('Recorded') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="teacher">{{ __('Teacher') }}*</label><br>
                                            <select name="teachers[]" class="js-example-basic-single js-states custom-select form-control"  required multiple >
                                                @foreach($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}" >{{ $teacher->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label for="">{{ __('Level Course') }}*</label>
                                            <select name="level" id="" class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                                <option value="">{{ __('Select') }} {{ __('Level') }}</option>
                                                @foreach($levels as $level)
                                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="slider">{{__('Free Course')}}</label>
                                        <input type="checkbox" name="free" value="1">
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="price">{{ __('Price') }}*</label>
                                        <input type="text" name="price" class="form-control" id="price" value="{{old('price')}}" placeholder="Enter price" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="discount">{{ __('Discount Price') }}</label>
                                        <input type="text" name="discount" class="form-control" id="discount" value="{{old('discount')}}" placeholder="Enter discount" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="start_date">{{ __('Discount Start Date') }}</label>
                                        <input type="date" name="start_date" class="form-control" id="start" value="{{old('start_date')}}" placeholder="Enter start_date" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="end_date">{{ __('Discount End Date') }}</label>
                                        <input type="date" name="end_date" class="form-control" id="end_date" value="{{old('end_date')}}" placeholder="Enter end_date" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="my-select">{{__("Select Placement Test")}}</label>
                                        <select class="form-control mt-2" name="placementTest">
                                            <option value="">none</option>
                                            @foreach($exams as $exam)
                                                <option  value='{{$exam->id}}'>{{$exam->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 ">
                                    <div class="form-group">
                                        <label for="my-select">{{__("Select Final Exam")}}</label>
                                        <select class="form-control mt-2" name="exam">
                                            <option value="">none</option>
                                            @foreach($exams as $exam)
                                                <option  value='{{$exam->id}}'>{{$exam->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                @foreach(config('locales') as $locale)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sh_desc_{{$locale}}">{{ $locale == 'en'? __('English Short Description') : __('Arabic Short Description') }}</label>
                                            <textarea rows="6" cols="60" maxlength="60" class="form-control" value="{{old('sh_desc')}}" name="sh_desc_{{$locale}}" id="desc" rows="4" required></textarea>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-md-4 col-lg-6">
                                    <div class="form-group">
                                        <label for="desc">{{ __('Overview') }}</label>
                                        <textarea class="form-control summernote summernote" value="{{old('desc')}}" name="desc" id="desc" rows="6" cols="60" maxlength="60" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-lg-6">
                                    <div class="form-group">
                                        <label for="desc">{{ __('What will students learn in your course?') }}</label>
                                        <textarea class="form-control summernote" id="summernote" value="{{old('contact')}}" name="contact" id="contact" rows="6" cols="60" maxlength="60" ></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-6">
                                    <div class="form-group">
                                        <label for="desc">{{ __('Are there any course requirements or prerequisites?') }}</label>
                                        <textarea class="form-control summernote" id="summernote" value="{{old('prerequisite')}}" name="prerequisite" id="prerequisite" rows="6" cols="60" maxlength="60" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="img">{{__('Upload Image')}}</label>
                                        <input type="file" name="img" class="form-control-file" id="img"  required>
                                    </div>
                                    <div class="form-group" id="imgPreview" >
                                        <img src="" class="img-fluid" alt="" width="300px" height="300px">
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
    <div class="modal fade" id="productCategory" tabindex="-1" role="dialog" aria-labelledby="productCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="BlogCategory">{{__('Add Product Category')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('admin.categoryCourse.store')}}" enctype="multipart/form-data" file="true">
                        @csrf
                        <div class="form-group">
                            <label for="parentCategory">{{ __('parent Category') }}</label>
                            <select class="form-control" name="parentCategory">
                                <option value="">{{__('parent Category')}}</option>
                                @foreach($categoriesCourse->where('parent_id',null) as $categoriesCourse)
                                    <option value="{{$categoriesCourse->id}}" name="parentCategory" >{{$categoriesCourse->name}}</option>
                                    @foreach($categoriesCourse->children as $child)
                                        <option value="{{$child->id}}" name="parentCategory" >  -- {{$child->name}}</option>
                                    @endforeach
                                @endforeach
                            </select>

                        </div>

                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                <input type="text" name="name_{{$locale}}" class="form-control" >
                            </div>
                        @endforeach
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="desc_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                <input type="text" cols="10" rows="5" maxlength="120"  name="desc_{{$locale}}"  class="form-control" >
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label for="img">{{__('Upload Image')}}</label>
                            <input type="file" name="img" class="form-control-file" id="img" >
                        </div>
                        <div class="form-group" id="imgPreview" >
                            <img src="" class="img-fluid" alt="" width="300px" height="300px">
                        </div>

                        <button type="submit" class="btn btn-primary float-right">{{__('Save')}}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')

    <script>
        let  index = 0, indexAttr = 1, values = [], valuesPaired = [];

        $(document).on('change','#img', function (e) {
            let x;
            // console.log($(n));
            for( x = 0 ;x<$(e.target.files).length; x++ ){
                let reader = new FileReader();
                // var name = document.createElement('p');
                let name =e.target.files[x].name;
                // $('#imgPreview').append(name);
                var l = document.getElementsByClassName('img-fluid');
                $(l).remove();
                reader.onload = function (event) {
                    let target = $('#imgPreview');
                    target.append(' <div style="display: inline-block;"><img name='+name+' src='+event.target.result+' width="100px" style="margin: 10px;"  id="image" class="img-fluid">'
                        );
                };
                reader.readAsDataURL(e.target.files[x]);
                $('#imgPreview').show();
            }
        });
        $(document).ready(function() {

            $('.summernote').summernote({
                tabsize: 2,
                height: 150,
                minHeight: null,
                maxHeight: null,
                focus: false,
                lang: '{{ config("app.locale") }}',
                toolbar: [
                    // [groupName, [list of button]]
                    ['font', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['style', 'ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['style', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['insert', [ 'table','hr','video','link']],
                    ['custom', ['picture']],
                    ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                    ['misc', ['fullscreen', 'undo', 'redo', 'help', 'codeview']]
                ],
            });

            $('.js-example-basic-single').select2({
                placeholder: 'Select an option'
            });
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



    </script>
@stop
