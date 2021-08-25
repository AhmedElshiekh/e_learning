@extends('layouts.app')

@section('content')
    <section id="home" style="min-height: 200px" >
        <div class="display-table">
            <div class="display-table-cell">
                <div class="container">

                    <div class="table-responsive">

                        <table class="table table-hover table-bordered" id="table">
                            <thead>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Day')}}</th>
                            @if($user->type == 'teacher')
                                <th>{{__('Student')}}</th>
                            @else
                                <th>{{__('Teacher')}}</th>
                            @endif
                            <th>{{__('Time')}}</th>
                            <th>{{__('Status')}}</th>


                            <th>{{__('Action')}}</th>
                            @if($user->type == 'teacher')
                                <th>{{__('Complete')}}</th>
                            @endif

                            </thead>

                            <tbody>
                            @foreach($lessons as $lesson)
                                <tr>
                                    <td>{{$lesson->date}}</td>
                                    <td>{{$lesson->day}}</td>
                                    @if($user->type == 'teacher')
                                        <td>{{$lesson->course->student->name}}</td>
                                    @else
                                        <td>{{$lesson->course->teacher->name}}</td>
                                    @endif
                                    <td>{{$lesson->time}}</td>
                                    <td>{{$lesson->status}}</td>

                                    <td>
                                        {{--                                                        @role('admin|Supervisor')--}}
                                        {{--                                            <button type="submit" class="btn btn-info btn-xs"> <i class='fa fa-edit'></i>{{__('Update')}}</button>--}}
                                        @if($lesson->status == 'in progress')


                                            @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->subHours(2) >= \Carbon\Carbon::now()->format('Y-m-d H:i:s') )
                                                <a href="{{route('admin.lesson.status.change',[$lesson->id,'canceled'])}}" class="btn btn-danger btn-xs">
                                                    <i class='fa fa-remove'></i>{{__('Cancel')}}
                                                </a>
                                            @endif
                                            @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->subHours(1) >= \Carbon\Carbon::now()->format('Y-m-d H:i:s') )
                                                <a href="{{$lesson->course->application == 'zoom'? $lesson->course->teacher->zoom: $lesson->course->teacher->teamLink }}" target="_blank" class="btn btn-primary btn-xs">
                                                    {{__('Go')}}
                                                </a>
                                            @endif

                                        @endif
                                        {{--                                                        @endrole--}}
                                    </td>
                                    <td>
                                        @if($user->type == 'teacher' && $lesson->status == 'in progress')
                                            <form method="post" action="{{route('class.complete',$lesson->id)}}">
                                                @csrf

                                                <textarea name= "comment" class="form-control" required placeholder="Teacher Must Add Note "></textarea>
                                                {{--                                                @dd(  \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}
                                                {{--                                                @if( \Carbon\Carbon::create($lesson->date .''.$lesson->time)->format('Y-m-d H:i:s') > \Carbon\Carbon::now()->format('Y-m-d H:i:s') )--}}

                                                <button type="submit" class="btn btn-success btn-xs">{{__('Complete')}}</button>
                                                {{--                                                @endif--}}
                                            </form>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
