@extends('admin.layout.master')
@section('title','categories Product')
@section('content')
    <div class="container">
        <div class="row row-card-no-pd">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">{{__('Categories')}}</h4>
                        </div>

                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#productCategory">
                            {{__('Add Category')}}
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive table-hover table-sales">
                                    <table class="table">
                                        <thead>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Parent')}}</th>
                                        <th>{{__('Description')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        @if($categoriesCourses->count() > 0)
                                            @foreach($categoriesCourses as $categoryCourse)
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        @if($categoryCourse->hasMedia('catCourse'))
                                                            <div class="flag">
                                                                <img width="80" height="80" src="{{ asset($categoryCourse->lastMedia('catCourse')->getUrl()) }}">
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td>{{$categoryCourse->name}}</td>
                                                    <td>
                                                        @if($categoryCourse->parent_id == null)
                                                            {{ __('null') }}
                                                        @else
                                                            {{$categoryCourse->parent->name}}
                                                        @endif
                                                    </td>

                                                    <td>
                                                        {{$categoryCourse->desc}}
                                                    </td>
                                                    <td>
                                                        <a href="#" onclick="editCategory('{{str_replace('\'', '`',$categoryCourse->getTranslation('name','en')) }}','{{$categoryCourse->getTranslation('name','ar') }}','{{$categoryCourse->getTranslation('desc','en') }}','{{$categoryCourse->getTranslation('desc','ar') }}','{{route('admin.categoryCourse.update',$categoryCourse->id)}}',' @if($categoryCourse->hasMedia('catCourse')){{asset($categoryCourse->lastMedia('catCourse')->getUrl())}}@endif','{{$categoryCourse->parent_id}}')" class="btn btn-info btn-xs" data-toggle="modal" data-target="#updateProductCategory">
                                                            <i class='fa fa-edit'></i>{{__('Edit')}}
                                                        </a>
                                                        {{--                                                    <form action="{{route('admin.categoryCourse.destroy',$categoryCourse->id)}}" method="POST">--}}
                                                        {{--                                                        @csrf--}}
                                                        {{--                                                        @method('DELETE')--}}

                                                        <button class="btn btn-danger btn-xs" type="submit" onclick="removeCat('{{$categoryCourse->name}}','{{route('admin.catCourse.destroy',$categoryCourse->id)}}')">
                                                            <i class="fas fa-trash"></i> {{__('Delete')}}
                                                        </button>

                                                        {{--                                                    </form>--}}
                                                    </td>
                                                </tr>

                                                </tbody>
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <!-- model setting-->
    <div class="modal fade" id="catProductSetting" tabindex="-1" role="dialog" aria-labelledby="catProductSetting" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="catProductSetting">{{__('Category Setting')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="{{route('admin.section.setting.update')}}" enctype="multipart/form-data" file="true">
                        @csrf
                        @method('Put')
                        <input type="hidden" name="type" value="catproduct">
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                <input type="text" name="name_{{$locale}}" class="form-control" value="{{$categorySection->getTranslation('name',$locale)}}">
                            </div>
                        @endforeach
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="description_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                <input type="text" name="description_{{$locale}}" class="form-control" value="{{$categorySection->getTranslation('description',$locale)}}">
                            </div>
                        @endforeach

                        <div class="form-group">
                            <label for="backgroungColor">{{__('Section Color')}}</label>
                            <input type="color" name="backgroungColor" value="{{$categorySection->backgroundColor}}">
                        </div>

                        <div class="form-group">
                            <label for="img">{{__('Upload Image')}}</label>
                            <input type="file" name="img"  id="img" multiple >
                        </div>

                        <div class="form-row">
                            <div class="col-md-2   text-center">
                                <div class="form-group" id="imgPreview">
                                    @if($categorySection->hasMedia('catCourse'))
                                        <img src="{{asset($categorySection->firstMedia('catCourse')->getUrl())}}" class="img-fluid"
                                             alt="">
                                    @else
                                        <img src="" class="img-fluid"
                                             alt="no image">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">{{__('Save')}}</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end setting -->
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
                        <div class="form-group">
                            <label for="parentCategory">{{ __('parent Category') }}</label>
                            <select class="form-control" name="parentCategory">
                                <option value="">{{__('parent Category')}}</option>
                                @foreach($categoriesCourses->where('parent_id',null) as $categoryCourse)
                                    <option value="{{$categoryCourse->id}}" name="parentCategory"  >{{$categoryCourse->name}}</option>
                                    @foreach($categoryCourse->children as $child)
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
                                <input type="text" cols="10" rows="5" maxlength="120"  name="desc_{{$locale}}" class="form-control" >
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
    <div class="modal fade" id="updateProductCategory" tabindex="-1" role="dialog" aria-labelledby="updateProductCategory" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateBlogCategory">{{__('update Category')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" action="" enctype="multipart/form-data" file="true">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Category_{{$locale}}">{{ __('Category_'.$locale) }}</label>
                            <select class="form-control" name="parentCategory">
                                <option value="">{{__('parent Category')}}</option>
                                @foreach($categoriesCourses->where('parent_id',null) as $categoryCourse)
                                    <option value="{{$categoryCourse->id}}" name="parentCategory" >{{$categoryCourse->name}}</option>
                                    @foreach($categoryCourse->children as $child)
                                        <option value="{{$child->id}}" name="parentCategory" >  -- {{$child->name}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                        </div>

                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="name_{{$locale}}">{{ $locale == 'en'? __('English Name') : __('Arabic Name') }}</label>
                                <input type="text" name="name_{{$locale}}" class="form-control" value="">
                            </div>
                        @endforeach
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="desc_{{$locale}}">{{ $locale == 'en'? __('English Full Description') : __('Arabic Full Description') }}</label>
                                <input type="text" cols="10" rows="5" maxlength="120" name="desc_{{$locale}}" class="form-control" value=""/>
                            </div>
                        @endforeach
                        <div class="form-group">
                            <label for="img">{{__('Upload Image')}}</label>
                            <input type="file" name="img" class="form-control-file" id="img" >
                        </div>
                        <div class="form-group" id="imgPreview" >
                            <img src="" class="img-fluid" alt="" width="300px" height="300px">
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
        $('input[type="file"]').on('change', function (e) {
            let fileName = e.target.files[0].name,
                reader = new FileReader();

            $(e.target).siblings('label').text(fileName);

            reader.onload = function (event) {
                $('#imgPreview img').attr('src', event.target.result);
            };

            reader.readAsDataURL(e.target.files[0]);
            $('#imgPreview').show();
        });

        function editCategory(name_en,name_ar,desc_en,desc_ar,href,img,parent) {
            // alert(href);
            let modal = $('#updateProductCategory');
            modal.find('.modal-body input[name="name_en"]').val(name_en);
            modal.find('.modal-body input[name="name_ar"]').val(name_ar);
            modal.find('.modal-body input[name="desc_en"]').val(desc_en);
            modal.find('.modal-body input[name="desc_ar"]').val(desc_ar);
            modal.find('.modal-body img').attr('src', img);
            modal.find('.modal-body select[name="parentCategory"]').val(parent);

            modal.find('.modal-body form').attr("action",href);

        };

        function removeCat(name, url, e) {
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
