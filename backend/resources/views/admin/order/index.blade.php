@extends('admin.layout.master')
@section('content')
    <div class="container">

        <div class="row row-card">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <h4 class="card-title">{{__('Free Requests')}}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive table-hover table-sales">
                                    <table id="table" class="table">
                                        <thead>

                                        <th>#</th>
                                        <th>{{__('Student Name')}}</th>
                                        <th>{{__('Student Phone')}}</th>
                                        <th>{{__('Course')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Time')}}</th>
                                        <th>{{__('Teacher')}}</th>

                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        @if($orders->count() > 0)
                                            <tbody>
                                            @foreach($orders as $order)
                                                <tr>
                                                    <td>{{$loop->iteration }}</td>
                                                    <td>{{$order->user->name}}</td>
                                                    <td>{{$order->user->phone}}</td>
                                                    <td style="max-width: 10px">{{$order->product->name}}</td>
                                                    <td>{{$order->date}}</td>
                                                    <td>{{$order->time}}</td>
                                                    <td>{{$order->teacher ? $order->teacher->name : 'None'}}</td>
                                                    <td>{{__($order->status)}}</td>
                                                    <td>

                                                        @role('admin|Supervisor')
                                                        @if($order->status == 'new')
                                                            <a href="{{ route('admin.orders.update', [$order,'completed']) }}" class="btn btn-primary btn-sm text-default" >
                                                                {{__('Complete')}}
                                                            </a>
                                                            <a href="#" onclick="cancelOrder('{{route('admin.orders.update', [$order,'canceled'])}}')" class="btn btn-danger btn-sm text-default" >
                                                            {{__('Cancel')}}
                                                        </a>
                                                        @endif
                                                        @endrole
                                                    </td>
                                                </tr>


                                            @endforeach
                                            </tbody>
                                        @endif
                                    </table>
                                </div>
                            </div>
{{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reviewOrderModal" tabindex="-1" role="dialog"
         aria-labelledby="reviewProductModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewProductModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>

@stop

@section('script')

<script>
    $(document).ready(function() {
        $('#table').dataTable({ "paginate": false});
        $('#reviewOrderModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget),

                href = button.data('href'),
                reject = button.data('reject'),
                name = button.data('name'),
                modal = $(this);
            $.ajax({
                url: href,
                method: 'get',
                success: function (data) {
                    modal.find('.modal-title').text("Review Order");
                    modal.find('.modal-footer form').attr("action", reject);
                    modal.find('.modal-body').html(data);
                }
            });
        });
    });
    function cancelOrder( url, e) {
        swal({
            title: "Are you sure?",
            text: " cancel this order",
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
