@extends('admin.layout.master')
@section('content')
    <div class="row row-card-no-pd">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <h4 class="card-title">{{__('Jobs Applications')}}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-hover table-sales">
                                <table id="table" class="table">
                                    <thead>

                                    <th>#</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Phone')}}</th>
                                    <th>{{__('Job Field')}}</th>
                                    <th>{{__('Cv')}}</th>

                                    </thead>
                                    @if($messages->count() > 0)
                                        <tbody>
                                        @foreach($messages as $message)
                                            <tr>
                                                <td>{{$message->id}}</td>
                                                <td>{{$message->name}}</td>
                                                <td>
                                                    {{$message->email}}
                                                </td>
                                                <td>
                                                    {{$message->phone}}
                                                </td>
                                                <td>
                                                    {{$message->job_field}}
                                                </td>
                                                <td>
                                                   @if($message->hasMedia('cv'))
                                                        <a href=" {{ asset($message->firstMedia('cv')->getUrl())}}" class="btn btn-success" download>Cv</a>
                                                    @endif
                                                </td>
                                            </tr>


                                        @endforeach
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')

    <script>
        $(document).ready(function() {
            $('#table').dataTable({ 'order': [['0', 'desc']]});
        });
    </script>

@stop
