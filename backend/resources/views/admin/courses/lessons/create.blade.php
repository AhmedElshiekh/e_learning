@extends('admin.layout.master')
@section('title','Create Course')
@section('content')
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.lessons.store')}}"  enctype="multipart/form-data" accept-charset="utf-8" file="true">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{__('Add Lesson')}}</div>

                        </div>

                        <div class="card-body">

                            <input type="hidden" name="chapter_id" value="{{$chapter->id}}">
                            <input type="hidden" name="course_id" value="{{$chapter->course_id}}">
                            <div class="row">
                                <div class="col-md-6 ">
                                <div class="form-group">
                                    <label for="img">{{__('Upload Video')}}</label>
                                    {!! plupload('video', route('admin.lessons.upload'))->setAutoStart(true)->setOptions([
                                          'filters' =>  [
                                                'runtimes' =>'html5,flash,silverlight,html4',

                                                'chunk_size' => '50kb',
                                                'max_file_size' => '2Gb',
                                                'mime_types' => [
                                                    ['title' => 'Video files', 'extensions' => 'mp4,gif,mkv,flv'],
                                                ],
                                                'dragdrop'=> true,
                                            ],
                                          'multi_selection' => true,
                                    ])
                                    !!}
                                </div>
                            </div>
                            </div>
                            <div class="row">
                                @foreach (config('locales') as $lang)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name  ">{{ $lang=='en'? __('Topic EN') :__('Topic AR') }}*</label>
                                            <input type="text" name="topic_{{$lang}}" class="form-control" id="_{{$lang}}" placeholder="Enter Topic  " value="{{old('topic_'.$lang)}}" required>
                                        </div>
                                    </div>
                                @endforeach
                              {{--  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name  ">{{  __('Chapter') }}*</label>
                                        <select  name="chapter_id" class="form-control" id="name"  required>
                                            <option value="">{{ __('Select') }} {{ __('Chapter') }}</option>
                                            @foreach($course->chapters as $chapter)
                                                <option value="{{ $chapter->id }}">{{ $chapter->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                                <label for="sh_desc  ">{{ __('Objective ') }}</label>
                                                <textarea rows="6" cols="60" class="form-control" value="{{old('objective')}}" name="objective" id="desc" rows="4" required></textarea>
                                            </div>
                                    </div>


                                <div class="col-md-4 col-lg-6">
                                    <div class="form-group">
                                        <label for="desc">{{  __('Summary') }}</label>
                                        <textarea class="form-control summernote" id="summernote" value="{{old('summary')}}" name="summary" id="desc" ></textarea>
                                    </div>
                                </div>

                                <div class="col-md-4 col-lg-6">
                                    <div class="form-group">
                                        <label for="material">{{ __('Material') }}</label>
                                        <div class="form-group">
                                            <label for="img">{{__('Upload Attachment')}}</label>
                                            {!! plupload('material', route('admin.lessons.upload'))->setAutoStart(true)->setOptions([
                                                  'filters' =>  [
                                                        'runtimes' =>'html5,flash,silverlight,html4',

                                                        'chunk_size' => '50kb',
                                                        'max_file_size' => '2Gb',
                                                        'mime_types' => [
                                                            ['title' => 'Material files', 'extensions' => 'pdf,docx,xlsx,pptx3,jpg,png'],
                                                        ],
                                                        'dragdrop'=> true,
                                                    ],
                                                  'multi_selection' => true,
                                            ])
                                            !!}
                                        </div>
                                        {{-- <textarea class="form-control summernote" id="summernote" value="{{old('material')}}" name="material" id="material" ></textarea> --}}
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
{{--    <script src="{{asset('vendor/plupload/plupload.dev.js')}}"></script>--}}
    <script src="{{asset('vendor/plupload/plupload.full.min.js')}}"></script>
    <script src="{{asset('vendor/plupload/jquery.plupload.queue.js')}}"></script>
    <script src="{{asset('vendor/plupload/upload.js')}}"></script>

    <script>


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
        });

        $(function () {
            createUploader('video'); // The Id that you used to create with the builder
            createUploader('material'); // The Id that you used to create with the builder
        });


    </script>
@stop
