@extends('admin.layout.master')
@section('title','Grade')
@section('content')

    <div class="page-inner">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }} </li>
                @endforeach
            </div>
        @endif
        <div class="page-header">
            <h4 class="page-title">{{__('Grads')}}</h4>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button data-toggle="modal" data-target="#addBrandModal" class="btn btn-primary">{{__('Add Grade')}}</button>
                    </div>

                    <div class="card-body">
                        <table id="table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('Grade Name') }}</th>
                                    <th >{{ __('Created') }}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($grades as $grade)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->created_at->format('d/M/Y') }}</td>
                                    <td>
                                        <a href="#" onclick="editBrand('{{$grade->getTranslation('name','en') }}','{{$grade->getTranslation('name','ar') }}','{{ route('admin.grade.update', $grade) }}',event)"  data-toggle="modal" data-target="#editBrandModal" class="btn btn-primary fa fa-edit"></a>
                                        <button onclick="removeBrand('{{ $grade->name }}', '{{ route('admin.grade.destroy', $grade) }}', event)" class="btn btn-danger fa fa-trash"></button>
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
    <div class="modal fade" id="addBrandModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">{{ __('Add Grade') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('admin.grade.store') }}"
                          accept-charset="utf-8">
                        @csrf

                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="catName_{{$locale}}">{{$locale == 'en'?  __('English Name'):__('Arabic Name') }}</label>
                                <input class="form-control" id="catName_{{$locale}}" name="name_{{$locale}}" required>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">{{ __('Edit Grade') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="" method="POST" accept-charset="utf-8">
                        @csrf
                        @method('PUT')
                        @foreach(config('locales') as $locale)
                            <div class="form-group">
                                <label for="catName_{{$locale}}">{{$locale == 'en'?  __('English Name'):__('Arabic Name') }}</label>
                                <input class="form-control" id="catName_{{$locale}}" name="name_{{$locale}}" required>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary float-right">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function removeBrand(name, url, e) {
            if (confirm("Are you sure? ")) {
                window.location = url;
            }
            return false;
        }
        function editBrand(name_en,name_ar,href) {
            let modal = $('#editBrandModal');
            modal.find('.modal-body input[name="name_en"]').val(name_en);
            modal.find('.modal-body input[name="name_ar"]').val(name_ar);
            modal.find('.modal-body form').attr("action",href);

        };
        $(document).ready(function() {
            $('#table').dataTable({
                "responsive": false,
                "paginate": false,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order': [['0', 'desc']]
            });
        });
    </script>
@endsection
