@extends('admin.layout.master')
@section('title','Update Course')
@section('content')
    <div class="page-inner">

        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{route('admin.lessons.update',$lesson->id)}}" enctype="multipart/form-data" file="true">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{__('Update Lesson')}}</div>
                        </div>


                        <div class="card-body">

{{--                            <input type="hidden" name="product_id" value="{{$lesson->product_id}}">--}}
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
                                                    ['title' => 'Video files', 'extensions' => 'mp4,gif'],
                                                ],
                                                'dragdrop'=> true,
                                            ],
                                          'multi_selection' => false,
                                    ])
                                    !!}
                                    <a href="{{asset('uploads/'.$lesson->videp)}}" target=”_blank”>{{$lesson->video}}</a>
                                </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name  ">{{  __('Topic') }}*</label>
                                        <input type="text" name="topic" class="form-control" id="name" placeholder="Enter Topic  " value="{{$lesson->topic}}" required>
                                    </div>
                                </div> --}}
                                @foreach (config('locales') as $lang)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name  ">{{ $lang=='en'? __('Topic EN') :__('Topic AR') }}*</label>
                                            <input type="text" name="topic_{{$lang}}" class="form-control" placeholder="Enter Topic  " value="{{$lesson->getTranslation('topic',$lang)}}" required>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name  ">{{  __('Chapter') }}*</label>
                                        <select  name="chapter_id" class="form-control" id="name"  required>
                                            <option value="">{{ __('Select') }} {{ __('Chapter') }}</option>
                                            @foreach($chapters as $chapter)
                                                <option value="{{ $chapter->id }}" {{ $chapter->id == $lesson->chapter_id ? "selected" : '' }}>{{ $chapter->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sh_desc  ">{{ __('Objective ') }}</label>
                                        <textarea rows="6" cols="60" class="form-control"  name="objective" id="desc" rows="4" required>
                                            {{$lesson->objective}}
                                        </textarea>
                                    </div>
                                </div>


                                <div class="col-md-4 col-lg-6">
                                    <div class="form-group">
                                        <label for="desc">{{  __('Summary') }}</label>
                                        <textarea class="form-control summernote" id="summernote" name="summary" id="desc" >{{$lesson->summary}}</textarea>
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
                                            {{-- {{$lesson->material}} --}}
                                            <a href="{{asset('uploads/'.$lesson->material)}}" target=”_blank”>{{$lesson->material}}</a>
                                            {{-- @if ($lesson->material)
                                                <img src="{{asset('uploads/'.$lesson->material)}}" alt="kjasjdndjks">
                                            @endif --}}
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

@stop
@section('script')
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

