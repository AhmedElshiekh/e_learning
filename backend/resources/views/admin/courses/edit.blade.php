@extends('admin.layout.master')
@section('title','Update Course')
@section('content')
    <div class="page-inner">

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.courses.update',$course->id)}}" enctype="multipart/form-data" file="true">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{__('Update Course')}}</div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="category">{{ __('Select Category') }}*</label>
                                        <select name="category" id="category"
                                                class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                            <option value="">{{ __('Select') }} {{ __('Category') }}</option>
                                            @foreach($categoriesCourse as $category)
                                                <option {{$course->parent_cat_id == $category->id ? 'selected':''}} value="{{ $category->id }}">{{ $category->name }}</option>
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

                                                @foreach($course->parentCategory->children as $category)
                                                    <option {{$course->sub_cat_id == $category->id ? 'selected':''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <div class="form-group">
                                        <label for="subCategory">{{ __('Category') }}*</label>
                                        <select name="category_id" id="category_id"
                                                class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                            <option value="">{{ __('Select') }} {{ __('Category') }}</option>
                                            @foreach($course->subCategory->children as $category)
                                            <option {{$course->course_cat_id == $category->id ? 'selected':''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label>{{__('Add Category') }}<span
                                                class="d-inline-block d-sm-none">{{ __('Category') }}</span></label>
                                        <button type="button" class="btn btn-block btn-outline-primary"
                                                data-toggle="modal" data-target="#productCategory"><i
                                                class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-md-3"> --}}
                                @foreach(config('locales') as $locale)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                            <input type="text" name="name_{{$locale}}" value="{{$course->getTranslation('name',$locale)}}" class="form-control" id="name" placeholder="Enter {{ $locale == 'en'? __('English Name') : __('Arabic Name') }}" required>
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
                                                <option value="live" {{$course->type == 'live'?'selected':''}}>{{ __('Live') }}</option>
                                                <option value="recorded" {{$course->type == 'recorded'?'selected':''}}>{{ __('Recorded') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label for="teacher">{{ __('Teacher') }}*</label><br>
                                        <select name="teachers[]" class="js-example-basic-single js-states form-control" data-live-search="true" multiple required>
                                        {{-- <select name="teachers[]" class="js-example-basic-single js-states form-control"  required multiple > --}}
                                            @foreach($teachers as $teacher)
                                                <option value="{{ $teacher->id }}" {{$course->teachers->contains($teacher) ? 'selected' :null}}>{{ $teacher->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="form-group">
                                        <label for="">{{ __('Level Course') }}*</label>
                                        <select name="level" id="" class="custom-select form-control auto-save" required data-parsley-group="order" data-parsley-required>
                                            @foreach($levels as $level)
                                                <option {{$course->level_id == $level->id ? 'selected':''}} value="{{ $level->id }}">{{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="slider">{{__('Free Course')}}</label>
                                        <input type="checkbox" name="free" value="1" {{$course->free ? 'checked':null}}>
                                      </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="price">{{ __('Price') }}*</label>
                                        <input type="text" name="price" class="form-control" id="price" value="{{$course->price}}" placeholder="Enter price" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="discount">{{ __('Discount Price') }}</label>
                                        <input type="text" name="discount" class="form-control" id="discount" value="{{$course->discount}}" placeholder="Enter discount" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="start_date">{{ __('Discount Start Date') }}</label>
                                        <input type="date" name="start_date" class="form-control" id="start" value="{{$course->start_date}}" placeholder="Enter start_date" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="end_date">{{ __('Discount End Date') }}</label>
                                        <input type="date" name="end_date" class="form-control" id="end_date" value="{{$course->end_date}}" placeholder="Enter end_date" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="my-select">{{__("Select Placement Test")}}</label>
                                        <select id="my-select" class="form-control" name="placementTest">
                                            <option value="" >none</option>
                                            @foreach($exams as $exam)
                                                <option {{$exam->id == $course->placementTest_id ? 'selected' :null}} value='{{$exam->id}}'>{{$exam->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 ">
                                    <div class="form-group">
                                        <label for="my-select">{{__("Select Final Exam")}}</label>
                                        <select id="my-select" class="form-control" name="exam">
                                            <option value="" >none</option>
                                            @foreach($exams as $exam)
                                                <option {{$exam->id == $course->exam_id ? 'selected' :null}} value='{{$exam->id}}'>{{$exam->title}}</option>
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
                                            <textarea rows="6" cols="60" maxlength="60" class="form-control" name="sh_desc_{{$locale}}" id="desc" rows="4" required>{{$course->getTranslation('sh_desc',$locale)}}</textarea>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-md-4 col-lg-6">
                                    <div class="form-group">
                                        <label for="desc">{{ __('Overview') }}</label>
                                        <textarea class="form-control summernote" id="summernote"  name="desc" id="desc" rows="6" cols="60" maxlength="60" >{{$course->desc}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-lg-6">
                                    <div class="form-group">
                                        <label for="desc">{{ __('What will students learn in your course?') }}</label>
                                        <textarea class="form-control summernote"  name="contact" id="contact" rows="6" cols="60" maxlength="60" >{{$course->contact}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-6">
                                    <div class="form-group">
                                        <label for="desc">{{ __('Are there any course requirements or prerequisites?') }}</label>
                                        <textarea class="form-control summernote" name="prerequisite" id="prerequisite" rows="6" cols="60" maxlength="60" >{{$course->prerequisite}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="img">{{__('Upload Image')}}</label>
                                        <input type="file" name="img"  id="img" >
                                    </div>
                                    <div class="form-group" id="imgPreview" >

                                    </div>
                                    <div class="form-group" id="imgPreview2" >
                                        @if($course->hasMedia('product'))

                                        {{-- @foreach($course->getMedia('product') as $image) --}}
                                                <div style="display: inline-block;">
                                                    <img  src="{{asset($course->lastMedia('product')->getUrl()) }}" width="100px" style="margin: 10px;"  id="image" >
                                                {{-- <a href="{{route('admin.product.deleteImage',$image->id)}}"><i class="fa fa-trash "></i></a> --}}
                                                </div>
                                        {{-- @endforeach --}}
                                        @endif
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="card-action">
                            <button type="submit" class="btn btn-success float-right">{{__('Update')}}</button>

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
                    <h5 class="modal-title" id="BlogCategory">{{__('Add Category')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('admin.categoryCourse.store')}}" enctype="multipart/form-data" file="true">
                        @csrf


                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                <input type="text" name="name_{{$locale}}" class="form-control" >
                            </div>
                        @endforeach
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="desc_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                <input type="text" cols="10" rows="5" maxlength="120"  name="desc_{{$locale}}" required class="form-control" >
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label for="img">{{__('Upload Image')}}</label>
                            <input type="file" name="img" class="form-control-file" id="img" required>
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

        let  index = 10, indexAttr = 1, values = [], valuesPaired = [];

        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: 'Select an option'
            });

            $('.summernote').summernote({
                tabsize: 2,
                height: 300,
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
            $('select[name="category"]').on('change', function () {
                var categoryID = $(this).val();
                if (categoryID) {
                    let ur = '{{url('/admin/categories/subCategory')}}';
                    $.ajax({
                        url: ur + '/' + categoryID,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="subCategory"]').empty();
                            $('select[name="type"]').empty();
                            $('select[name="subCategory"]').append('<option value="">{{__('Select SubCategory')}}</option>');
                            $.each(data, function (key, value) {
                                $('select[name="subCategory"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        }
                    });
                    let ur2 = '{{url('/admin/categories/attributes')}}';

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
                    });

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
            $('.attributes').each( function () {
                $(this).selectize({
                    persist: true,
                    createOnBlur: true,
                    create: true
                });
            });
        });
        function removeItem(item) {
            let parent = $(item.target.parentElement);
            let val =$(item.target.parentElement).children('img').attr('name');

            var input=$('input[type = "file"]')[0];
            for (let i = 0 ; i < $('input[type = "file"]')[0].files.length;i++ ) {
                const dt = new DataTransfer()
                for (let file of input.files)
                {
                    console.log(file['name']);
                    if (file['name'] !== val) {
                        dt.items.add(file);
                    }
                }
                input.files = dt.files;
            }
            // console.log( input.files);
            parent.remove();
        }
        $(document).on('change','#img', function (e) {
            let x;

            // console.log($(n));
            var i = document.getElementsByClassName('delete');
            $(i).remove();
            for( x = 0 ;x<$(e.target.files).length; x++ ){
                let reader = new FileReader();


                // var name = document.createElement('p');
                let name =e.target.files[x].name;
                // $('#imgPreview').append(name);
                var l = document.getElementsByClassName('img-fluid');
                $(l).remove();
                reader.onload = function (event) {

                    let target = $('#imgPreview');

                    target.append(' <div style="display: inline-block;"><img name='+name+' src='+event.target.result+' width="100px" style="margin: 10px;"  id="image" class="img-fluid">' +
                        '<i class="fa fa-trash delete" onclick="removeItem(event);" ></i>');
                };
                reader.readAsDataURL(e.target.files[x]);
                $('#imgPreview').show();
            }
        });
        function checkVal(sel) {
            if (sel.value === "new") {
                $('.addNewAttribute').removeAttr('disabled');
            } else if (sel.value === "select") {
                $('.addNewAttribute').attr('disabled', 'disabled');
            } else {

            }
        }
        $('#selectAttribute').change(function () {

            $('#selectAttribute option:selected').hide();
            let atrrName = $('#selectAttribute').val();
            console.log(atrrName);
            if (atrrName) {
                atrrName = atrrName.replace(' ', '');
                $('#attributes tbody').append('<tr><td><input type="text" class="form-control" name="attributes[' + index + '][key]" value="' + atrrName + '" readonly></td><td><input name="attributes[' + index + '][values]" type="text" class="form-control attributesSelect selectize-' + index + '"></td><td><button type="button" class="btn btn-link" onclick="removeAttr(this);">' + "{{ __('Delete') }}" + '</button></td></tr>');

                $('.selectize-' + index).selectize({
                    persist: false,
                    createOnBlur: true,
                    create: true
                });
                index++;
            }
        });
        function removeAttr(el) {

            if (confirm("Are you sure?")) {
                $(el).parents('tr').remove();
            }
            return false;
        }
        function removeVar(el) {

            if (confirm("Are you sure?")) {
                if (($(el).parents('tr').parents('tbody').children().length) <= 3) {
                    let $quantity = $('#quantity');
                    $quantity.removeAttr("disabled");
                    $quantity.attr("required", true);
                }
                ;
                $(el).parents('tr').remove();
            }
            return false;
        }
        function updateValues() {
            valuesPaired = $('input.attributesSelect').map(function () {
                let str = $(this).val().split(','),
                    parentValue = $(this).parents('tr').children('td:first').find('input').val();
                parentValue = parentValue.replace(' ', '');
                return $.map(str, function (item) {
                    if (item.toString().trim() === "") return true;
                    return {value: parentValue + ":" + item};
                });
            }).toArray();
        }
        function addAttrRow() {
            updateValues();

            $('#varPrice').show();
            $('table#variations tbody').append('<tr><td>' + indexAttr + '</td><td><input name="variations[' + indexAttr + '][\'name\']" type="text" value="" class="form-control selectizeAttr-' + indexAttr + '"></td>' +
                '<td ><input type="number" name="variations[' + indexAttr + '][\'quantity\']" value="" class="form-control" ></td>' +
                '<td><button type="button" class="btn btn-link" onclick="removeVar(this);">' + "{{ __('Delete') }}" + '</button></td><tr>');


            $('.selectizeAttr-' + indexAttr).selectize({
                maxItems: null,
                valueField: 'value',
                labelField: 'value',
                searchField: 'value',
                options: valuesPaired,
                create: false
            });
            indexAttr++;
            let $quantity = $('#quantity');
            $quantity.removeAttr("required");
            $quantity.attr("disabled", true);

        }
        function autoCreateVariation() {
            updateValues();
            let array = new Array(),
                x = 0;

            $('input.attributesSelect').each(function () {
                let str = $(this).val(),
                    parentValue = $(this).parents('tr').children('td:first').find('input').val();
                parentValue = parentValue.replace(' ', '');
                $('table#variations tbody').html('');

                if (str === undefined || str.length == 0) return true;

                str = str.split(',');

                array[x] = $(str).map(function () {
                    return parentValue + ":" + this;
                }).toArray();
                x++;
            });

            if (array === undefined || array.length == 0) return;

            values = cartesian(array);

            $.each(values, function (i, item) {
                $('.selectizeAttr-' + indexAttr).selectize({
                    maxItems: null,
                    valueField: 'value',
                    labelField: 'value',
                    searchField: 'value',
                    options: valuesPaired,
                    create: false
                });
                $('#varPrice').show();
                $('table#variations tbody').append('<tr><td>' + indexAttr + '</td><td><input name="variations[' + indexAttr + '][name]" type="text" value="' + item + '" class="form-control selectizeAttr-' + indexAttr + '" readonly></td>' +
                    '<td><input type="number" name="variations[' + indexAttr + '][stock]" value="" class="form-control"></td>' +
                    '<td><input type="number" name="variations[' + indexAttr + '][price]" value="0" class="form-control"></td>' +
                    '<td><button type="button" class="btn btn-link" onclick="removeVar(this);">' + "{{ __('Delete') }}" + '</button></td><tr>');


                indexAttr++;
            })

            let $quantity = $('#quantity');
            $quantity.removeAttr("required");
            $quantity.attr("disabled", true);
            // $quantity.hide();
        }
        function cartesian(arg) {
            let r = [],
                max = arg.length - 1;

            function helper(arr, i) {
                for (let j = 0, l = arg[i].length; j < l; j++) {
                    let a = arr.slice(0); // clone arr
                    a.push(arg[i][j]);
                    if (i === max)
                        r.push(a);
                    else
                        helper(a, i + 1);
                }
            }

            helper([], 0);
            return r;
        }
    </script>
@stop

